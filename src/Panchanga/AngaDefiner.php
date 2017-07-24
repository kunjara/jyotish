<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Astro;
use Jyotish\Panchanga\Panchanga;
use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Panchanga\Yoga\Yoga;
use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Panchanga\Karana\Karana;
use Jyotish\Graha\Graha;
use DateTime;
use DateInterval;

/**
 * Class for calculating of Panchanga.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class AngaDefiner
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * Information about angas.
     * 
     * @var array
     */
    private $angaInfo = [];
    
    /**
     * Clone of this object.
     * 
     * @var null|AngaDefiner
     */
    private $AngaDefiner = null;

    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);
        $this->setAngaInfo();
    }
    
    /**
     * Clone
     */
    public function __clone()
    {
        $this->Data = clone $this->Data;
    }

    /**
     * Get Tithi. Ending Moment of elongation of the Moon, the lunar day, the 
     * angular relationship between Sun and Moon (Apparent Moon minus Apparent Sun).
     * 
     * @param bool $withLimit Time limit
     * @return array
     */
    public function getTithi($withLimit = false)
    {
        $this->checkData(__FUNCTION__);
        $unit = 12;

        $lngCh = $this->getData()['graha'][Graha::KEY_CH]['longitude'];
        $lngSy = $this->getData()['graha'][Graha::KEY_SY]['longitude'];		

        if ($lngCh < $lngSy) $lngCh = $lngCh + 360;

        $tithiUnits = Math::partsToUnits(($lngCh - $lngSy), $unit);
        $tithiObject = Tithi::getInstance($tithiUnits['units']);

        $tithi = [];
        $tithi['anga'] = Panchanga::ANGA_TITHI;
        $tithi['key'] = $tithiUnits['units'];
        $tithi['name'] = Tithi::$tithi[$tithi['key']];
        $tithi['paksha'] = $tithiObject->tithiPaksha;
        $tithi['left'] = ($unit - $tithiUnits['parts']) * 100 / $unit;

        if ($withLimit) {
            $this->AngaDefiner = clone $this;
            $limit = $this->getAngaLimit($tithi);
            $tithi['end'] = $limit;
            $this->AngaDefiner = null;
        }

        $this->temp['tithi'] = $tithi;
        
        return $this->temp['tithi'];
    }

    /**
     * Get Nakshatra. Ending Moment of asterism of the day, that is, the stellar 
     * mansion in which graha is located for an observer at the center of the Earth. 
     * 
     * @param bool $withLimit Time limit
     * @param bool $withAbhijit Take into account the Abhijit nakshatra
     * @param string $grahaKey Graha key (default: Ch)
     * @return array
     */
    public function getNakshatra($withLimit = false, $withAbhijit = false, $grahaKey = Graha::KEY_CH)
    {
        $this->checkData(__FUNCTION__);
        $unit = 360/27;

        if (array_key_exists($grahaKey, Graha::$graha)) {
            $lngGraha = $this->getData()['graha'][$grahaKey]['longitude'];
        } else {
            if (!isset($this->getData()['lagna'][$grahaKey]['longitude'])) {
                throw new Exception\InvalidArgumentException(
                    "Longitude value for the key '$grahaKey' is not defined."
                );
            } else {
                $lngGraha = $this->getData()['lagna'][$grahaKey]['longitude'];
            }
        }
        
        $nakshatraUnits = Math::partsToUnits($lngGraha, $unit);

        $nakshatra = [];
        $nakshatra['anga'] = Panchanga::ANGA_NAKSHATRA;
        if ($withAbhijit) {
            if ($nakshatraUnits['units'] == 21 || $nakshatraUnits['units'] == 22) {
                $Abhijit = Nakshatra::getInstance(28);
                $abhijitStart = Math::dmsToDecimal($Abhijit->nakshatraStart);
                $abhijitEnd   = Math::dmsToDecimal($Abhijit->nakshatraEnd);

                if ($lngGraha < $abhijitStart) {
                    $nakshatra['key'] = 21;
                    $N = Nakshatra::getInstance($nakshatra['key']);
                    $nStart = Math::dmsToDecimal($N->nakshatraStart);
                    $unit = $abhijitStart - $nStart;
                    $left = $abhijitStart - $lngGraha;
                } elseif ($lngGraha >= $abhijitStart && $lngGraha < $abhijitEnd) {
                    $nakshatra['key'] = 28;
                    $unit = $abhijitEnd - $abhijitStart;
                    $left = $abhijitEnd - $lngGraha;
                } else {
                    $nakshatra['key'] = 22;
                    $N = Nakshatra::getInstance($nakshatra['key']);
                    $nEnd = Math::dmsToDecimal($N->nakshatraEnd);
                    $unit = $nEnd - $abhijitEnd;
                    $left = $nEnd - $lngGraha;
                }
                $nakshatra['ratio'] = $unit / Math::dmsToDecimal(Nakshatra::$arc);
            } else {
                $nakshatra['key'] = $nakshatraUnits['units'];
                $nakshatra['ratio'] = 1;
                $left = $unit - $nakshatraUnits['parts'];
            }
            $nakshatra['abhijit'] = true;
        } else {
            $nakshatra['key'] = $nakshatraUnits['units'];
            $nakshatra['ratio'] = 1;
            $nakshatra['abhijit'] = false;
            $left = $unit - $nakshatraUnits['parts'];
        }

        $nakshatra['left'] = $left * 100 / $unit;
        $nakshatra['name'] = Nakshatra::$nakshatra[$nakshatra['key']];
        
        if ($nakshatra['left'] < 100 && $nakshatra['left'] >= 75) {
            $nakshatra['pada'] = 1;
        } elseif ($nakshatra['left'] < 75 && $nakshatra['left'] >= 50) {
            $nakshatra['pada'] = 2;
        } elseif ($nakshatra['left'] < 50 && $nakshatra['left'] >= 25) {
            $nakshatra['pada'] = 3;
        } else {
            $nakshatra['pada'] = 4;
        }

        if ($withLimit) {
            $this->AngaDefiner = clone $this;
			$limit = $this->getAngaLimit($nakshatra);
            $nakshatra['end'] = $limit;
            $this->AngaDefiner = null;
        }

        return $nakshatra;
    }

    /**
     * Get Yoga. Ending Moment of the angular relationship between Sun and Moon 
     * (Apparent Moon plus Apparent Sun).
     * 
     * @param bool $withLimit Time limit
     * @return array
     */
    public function getYoga($withLimit = false)
    {
        $this->checkData(__FUNCTION__);
        $unit = 360/27;

        $lngCh  = $this->getData()['graha'][Graha::KEY_CH]['longitude'];
        $lngSy  = $this->getData()['graha'][Graha::KEY_SY]['longitude'];
        $lngSum = $lngCh + $lngSy;

        if ($lngSum > 360) {
            $lngSum = $lngSum - 360;
        }

        $yogaUnits = Math::partsToUnits($lngSum, $unit);

        $yoga = [];
        $yoga['anga'] = Panchanga::ANGA_YOGA;
        $yoga['key'] = $yogaUnits['units'];
        $yoga['name'] = Yoga::$yoga[$yoga['key']];
        $yoga['left'] = ($unit - $yogaUnits['parts']) * 100 / $unit;

        if ($withLimit) {
            $this->AngaDefiner = clone $this;
            $limit = $this->getAngaLimit($yoga);
            $yoga['end'] = $limit;
            $this->AngaDefiner = null;
        }

        return $yoga;
    }

    /**
     * Get Varana. The seven weekdays.
     * 
     * @param bool $withLimit Time limit
     * @return array
     */
    public function getVara($withLimit = false)
    {
        $this->checkData(__FUNCTION__);
        
        $DateTime = $this->Data->getDateTime();
        $TimeZone = $DateTime->getTimezone();
        
        $dateTimeU = $DateTime->format('U');
        $weekNumber = $DateTime->format('w');
        $dataRising = $this->getData()['rising'][Graha::KEY_SY];
        
        $DateRising = [];
        $dateRisingU = [];
        foreach ($dataRising as $i => $data) {
            $DateRising[$i] = new DateTime($data['rising'], $TimeZone);
            $dateRisingU[$i] = $DateRising[$i]->format('U');
        }
        
        if ($DateTime < $DateRising[1]) {
            $varaNumber = $weekNumber != 0 ? $weekNumber - 1 : 6;
            $risingIndex = 1;
        } else {
            $varaNumber = $weekNumber;
            $risingIndex = 2;
        }
        
        $duration = $dateRisingU[2] - $dateRisingU[1];

        $vara = [];
        $vara['anga'] = Panchanga::ANGA_VARA;
        $vara['left'] = ($dateRisingU[$risingIndex] - $dateTimeU) * 100 / $duration;
        $vara['key'] = array_keys(Vara::$vara)[$varaNumber];
        $vara['week'] = $weekNumber;
        $vara['name'] = array_values(Vara::$vara)[$varaNumber];
        
        if ($withLimit) {
            $vara['start'] = $this->getData()['rising'][Graha::KEY_SY][$risingIndex - 1]['rising'];
            $vara['end'] = $this->getData()['rising'][Graha::KEY_SY][$risingIndex]['rising'];
        }
        
        return $vara;
    }

    /**
     * Get Karana. Ending Moment of half of a Tithi.
     * 
     * @param bool $withLimit Time limit
     * @return array
     */
    public function getKarana($withLimit = false)
    {
        if (!isset($this->temp['tithi'])) {
            $this->getTithi($withLimit);
        }
        
        $karana = [];
        if ($this->temp['tithi']['left'] < 50) {
            $number = 2;
            $left = $this->temp['tithi']['left'];
            if ($withLimit)
                $karana['end'] = $this->temp['tithi']['end'];
        } else {
            $number = 1;
            $left = $this->temp['tithi']['left'] - 50;
            if ($withLimit) {
                $DateTime = $this->Data->getDateTime();
                $TithiEnd = new DateTime($this->temp['tithi']['end']);
                $dateUserU = $DateTime->format('U');
                $tithiEndU = $TithiEnd->format('U');
                $timeHalfU = round(($tithiEndU - $dateUserU) * 50 / $this->temp['tithi']['left']);
                $karana['end'] = $TithiEnd->sub(new DateInterval('PT'.$timeHalfU.'S'))->format(Time::FORMAT_DATETIME);
            }
        }

        $tithiObject = Tithi::getInstance($this->temp['tithi']['key']);
        $karanaArray = $tithiObject->tithiKarana;
        $karanaName = $karanaArray[$number];
        $karanaNumber = array_search($karanaName, Karana::$karana);

        $karana['anga'] = Panchanga::ANGA_KARANA;
        $karana['key'] = $karanaNumber;
        $karana['name'] = $karanaName;
        $karana['left'] = $left * 2;

        return $karana;
    }
    
    /**
     * Generation of angas.
     * 
     * @param null|array $angas Array of angas
     * @throws Exception\InvalidArgumentException
     */
    public function generateAnga(array $angas = null, $withLimit = false)
    {
        if (is_null($angas)) {
            $angas = Panchanga::$anga;
        }
        
        foreach ($angas as $anga) {
            if (!in_array($anga, Panchanga::$anga)) {
                throw new Exception\InvalidArgumentException("Anga with the name '$anga' does not exist.");
            }
            
            $getAnga = 'get'.$anga;
            yield $anga => $this->$getAnga($withLimit);
        }
    }

    /**
     * Set information about angas.
     * 
     * @return void
     */
    private function setAngaInfo()
    {
        $this->angaInfo = [
            Panchanga::ANGA_TITHI => [
                'duration' => Astro::DURATION_MONTH_SYNODIC * 86400,
                'parts' => 30,
            ],
            Panchanga::ANGA_NAKSHATRA => [
                'duration' => Astro::DURATION_MONTH_SIDEREAL * 86400,
                'parts' => 27,
            ],
            Panchanga::ANGA_YOGA => [
                'duration' => Astro::DURATION_MONTH_SYNODIC * 86400,
                'parts' => 27,
            ],
        ];
    }

    /**
     * Recursively calculate end time of anga.
     * 
     * @param array $anga
     * @param string $modify
     * @return string
     */
    private function getAngaLimit($anga, $modify = 'add')
    {
        $TimeEnd = $this->AngaDefiner->Data->getDateTime();
        
        $ratio = $anga['anga'] == Panchanga::ANGA_NAKSHATRA ? $anga['ratio'] : 1;
        $duration  = $this->angaInfo[$anga['anga']]['duration'] * $ratio / $this->angaInfo[$anga['anga']]['parts'];
        $left = $modify == 'add' ? $anga['left'] : 100 - $anga['left'];
        $timeLeft = round($duration * ($left / 100));
        $TimeEnd->{$modify}(new DateInterval('PT'.$timeLeft.'S'));

        // End time
        if ($left > .1) {
            $this->AngaDefiner->Data->setDateTime($TimeEnd);

            $function = 'get' . ucfirst($anga['anga']);
            if ($anga['anga'] == Panchanga::ANGA_NAKSHATRA) {
                $angaTemp = $this->AngaDefiner->$function(false, $anga['abhijit']);
            } else {
                $angaTemp = $this->AngaDefiner->$function();
            }
            
            if ($anga['key'] != $angaTemp['key']) {
                $modify = $modify == 'add' ? 'sub' : 'add';
            }

            return $this->getAngaLimit($angaTemp, $modify);
        }

        $result = $TimeEnd->format(Time::FORMAT_DATETIME);
        
        return $result;
    }
    
    /**
     * Check data.
     * 
     * @param null|string $function Function name
     * @return void
     */
    private function checkData($function = null)
    {
        if (!isset($this->getData()['graha'])) {
            $this->Data->calcParams();
        }

        if ($function == 'getVara' && !isset($this->getData()['rising'])) {
            $this->Data->calcRising();
        }
    }
}