<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

use DateTime;
use DateInterval;
use Jyotish\Panchanga\Panchanga;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Astro;
use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Panchanga\Yoga\Yoga;
use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Panchanga\Karana\Karana;
use Jyotish\Graha\Graha;
use Jyotish\Ganita\Method\AbstractGanita as Ganita;

/**
 * Class for calculating of Panchanga.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class AngaDefiner {
    /**
     * Ganita data.
     * 
     * @var Ganita
     */
    private $ganitaData = null;

    /**
     * Calculated tithi.
     * 
     * @var array
     */
    private $tithi = null;
    
    /**
     * Intermediate date
     * 
     * @var string
     */
    private $date = null;

    /**
     * Constructor
     * 
     * @param array|Ganita $ganitaData
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($ganitaData)
    {
        if($ganitaData instanceof Ganita){
            $this->ganitaData = $ganitaData;
            $this->ganitaData->calcParams();
        }elseif(is_array($ganitaData)){
            $this->ganitaData = $ganitaData;
        }else{
            throw new Exception\InvalidArgumentException(
                'Ganita data must be a Ganita object or a ganita array.'
            );
        }
    }

    /**
     * Clone Ganita object.
     */
    public function __clone()
    {
        $this->ganitaData = clone $this->ganitaData;
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
        $unit = 12;

        $lngCh = $this->getData()['graha'][Graha::KEY_CH]['longitude'];
        $lngSy = $this->getData()['graha'][Graha::KEY_SY]['longitude'];		

        if($lngCh < $lngSy) $lngCh = $lngCh + 360;

        $tithiUnits = Math::partsToUnits(($lngCh - $lngSy), $unit);
        $tithiObject = Tithi::getInstance($tithiUnits['units']);

        $tithi['anga'] = Panchanga::ANGA_TITHI;
        $tithi['key'] = $tithiUnits['units'];
        $tithi['name'] = Tithi::$tithi[$tithi['key']];
        $tithi['paksha'] = $tithiObject->tithiPaksha;
        $tithi['left'] = ($unit - $tithiUnits['parts']) * 100 / $unit;

        if($withLimit){
            $limit = $this->limitAnga($tithi, __FUNCTION__);
            $tithi['end'] = $limit;
        }

        $this->tithi = $tithi;

        return $this->tithi;
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
        $unit = 360/27;

        if(array_key_exists($grahaKey, Graha::$graha)){
            $lngGraha = $this->getData()['graha'][$grahaKey]['longitude'];
        }else{
            if(!isset($this->getData()['extra'][$grahaKey]['longitude'])){
                throw new Exception\InvalidArgumentException(
                    "Longitude value for the key '$grahaKey' is not defined."
                );
            }else{
                $lngGraha = $this->getData()['extra'][$grahaKey]['longitude'];
            }
        }
        
        $nakshatraUnits = Math::partsToUnits($lngGraha, $unit);

        $nakshatra['anga'] = Panchanga::ANGA_NAKSHATRA;
        if($withAbhijit){
            if($nakshatraUnits['units'] == 21 or $nakshatraUnits['units'] == 22){
                $Abhijit = Nakshatra::getInstance(28);
                $abhijitStart = Math::dmsToDecimal($Abhijit->nakshatraStart);
                $abhijitEnd   = Math::dmsToDecimal($Abhijit->nakshatraEnd);

                if($lngGraha < $abhijitStart){
                    $nakshatra['key'] = 21;
                    $N = Nakshatra::getInstance($nakshatra['key']);
                    $nStart = Math::dmsToDecimal($N->nakshatraStart);
                    $unit = $abhijitStart - $nStart;
                    $left = $abhijitStart - $lngGraha;
                }elseif($lngGraha >= $abhijitStart and $lngGraha < $abhijitEnd){
                    $nakshatra['key'] = 28;
                    $unit = $abhijitEnd - $abhijitStart;
                    $left = $abhijitEnd - $lngGraha;
                }else{
                    $nakshatra['key'] = 22;
                    $N = Nakshatra::getInstance($nakshatra['key']);
                    $nEnd = Math::dmsToDecimal($N->nakshatraEnd);
                    $unit = $nEnd - $abhijitEnd;
                    $left = $nEnd - $lngGraha;
                }
                $nakshatra['ratio'] = $unit / Math::dmsToDecimal(Nakshatra::$arc);
            }else{
                $nakshatra['key'] = $nakshatraUnits['units'];
                $nakshatra['ratio'] = 1;
                $left = $unit - $nakshatraUnits['parts'];
            }
            $nakshatra['abhijit'] = true;
        }else{
            $nakshatra['key'] = $nakshatraUnits['units'];
            $nakshatra['ratio'] = 1;
            $nakshatra['abhijit'] = false;
            $left = $unit - $nakshatraUnits['parts'];
        }

        $nakshatra['left'] = $left * 100 / $unit;
        $nakshatra['name'] = Nakshatra::$nakshatra[$nakshatra['key']];
        
        if($nakshatra['left'] < 100 and $nakshatra['left'] >= 75){
            $nakshatra['pada'] = 1;
        }elseif($nakshatra['left'] < 75 and $nakshatra['left'] >= 50){
            $nakshatra['pada'] = 2;
        }elseif($nakshatra['left'] < 50 and $nakshatra['left'] >= 25){
            $nakshatra['pada'] = 3;
        }else{
            $nakshatra['pada'] = 4;
        }

        if($withLimit){
			$limit = $this->limitAnga($nakshatra, __FUNCTION__);
            $nakshatra['end'] = $limit;
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
        $unit = 360/27;

        $lngCh  = $this->getData()['graha'][Graha::KEY_CH]['longitude'];
        $lngSy  = $this->getData()['graha'][Graha::KEY_SY]['longitude'];
        $lngSum = $lngCh + $lngSy;

        if($lngSum > 360) {
            $lngSum = $lngSum - 360;
        }

        $yogaUnits = Math::partsToUnits($lngSum, $unit);

        $yoga['anga'] = Panchanga::ANGA_YOGA;
        $yoga['key'] = $yogaUnits['units'];
        $yoga['name'] = Yoga::$yoga[$yoga['key']];
        $yoga['left'] = ($unit - $yogaUnits['parts']) * 100 / $unit;

        if($withLimit){
            $limit = $this->limitAnga($yoga, __FUNCTION__);
            $yoga['end'] = $limit;
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
        if(!isset($this->getData()['rising'])){
            $this->ganitaData->calcRising();
        }
        
        $dateUser = new DateTime($this->getData()['user']['date'].' '.$this->getData()['user']['time']);
        $dateUserU = $dateUser->format('U');
        $weekNumber = $dateUser->format('w');
        $dataRising = $this->getData()['rising'][Graha::KEY_SY];
        
        foreach ($dataRising as $i => $data){
            $dateRising[$i] = new DateTime($data['rising']);
            $dateRisingU[$i] = $dateRising[$i]->format('U');
        }
        
        if($dateUser < $dateRising[1]){
            $varaNumber = $weekNumber != 0 ? $weekNumber - 1 : 6;
            $risingIndex = 1;
        }else{
            $varaNumber = $weekNumber;
            $risingIndex = 2;
        }
        
        $duration = $dateRisingU[2] - $dateRisingU[1];

        $vara['anga'] = Panchanga::ANGA_VARA;
        $vara['left'] = ($dateRisingU[$risingIndex] - $dateUserU) * 100 / $duration;
        $vara['key'] = array_keys(Vara::$vara)[$varaNumber];
        $vara['week'] = $weekNumber;
        $vara['name'] = array_values(Vara::$vara)[$varaNumber];
        
        if($withLimit){
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
        $this->getTithi(true);
        
        if($this->tithi['left'] < 50){
            $number = 2;
            $left = $this->tithi['left'];
            if($withLimit)
                $karana['end'] = $this->tithi['end'];
        } else {
            $number = 1;
            $left = $this->tithi['left'] - 50;
            if($withLimit){
                $dateUser = new DateTime($this->getData()['user']['date'].' '.$this->getData()['user']['time']);
                $tithiEnd = new DateTime($this->tithi['end']);
                $dateUserU = $dateUser->format('U');
                $tithiEndU = $tithiEnd->format('U');
                $timeHalfU = round(($tithiEndU - $dateUserU) * 50 / $this->tithi['left']);
                $karana['end'] = $tithiEnd->sub(new DateInterval('PT'.$timeHalfU.'S'))->format(Time::FORMAT_DATETIME);
            }
        }

        $tithiObject = Tithi::getInstance($this->tithi['key']);
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
     * Set user data.
     * 
     * @param array $userData
     */
    public function setData(array $userData, $anga = null)
    {
        $this->ganitaData->setData($userData);
        $this->ganitaData->calcParams();

        if($anga == Panchanga::ANGA_VARA or $this->date < $this->getData()['user']['date']){
            $this->ganitaData->calcRising();
        }
        $this->date = $this->getData()['user']['date'];
    }
    
    /**
     * Get data.
     * 
     * @return array
     */
    public function getData()
    {
        if(is_object($this->ganitaData)){
            return $this->ganitaData->getData();
        }else{
            return $this->ganitaData;
        }
    }

    /**
     * Calculate Anga limits.
     * 
     * @param array $anga
     * @param string $function
     * @return array
     * @throws Exception\RuntimeException
     */
    private function limitAnga($anga, $function = 'getTithi')
    {
        if(!is_object($this->ganitaData)){
            throw new Exception\RuntimeException(
                'For calculation of the end angas must be used Ganita object.'
            );
        }

        if($function == 'getTithi'){
            $durMonth = Astro::DURATION_MONTH_SYNODIC * 86400;
            $nAnga = 30;
            $anga['ratio'] = 1;
        }elseif($function == 'getYoga'){
            $durMonth = Astro::DURATION_MONTH_SYNODIC * 86400;
            $nAnga = 27;
            $anga['ratio'] = 1;
        }elseif($function == 'getNakshatra'){
            $durMonth = Astro::DURATION_MONTH_SIDEREAL * 86400;
            $nAnga = 27;
        }else{
            $anga['ratio'] = 1;
        }

        $dateUser  = new DateTime($this->getData()['user']['date'].' '.$this->getData()['user']['time']);
        $durAnga   = $durMonth * $anga['ratio'] / $nAnga;
        $Panchanga = clone $this;

        $timeLeft = round($durAnga * ($anga['left'] / 100) / 2);

        // End time
        do {
            $timeEndObject = $dateUser->add(new DateInterval('PT'.$timeLeft.'S'));

            $Panchanga->setData([
                'date' => $timeEndObject->format(Time::FORMAT_DATA_DATE), 
                'time' => $timeEndObject->format(Time::FORMAT_DATA_TIME)
            ], $anga['anga']);

            if($function == 'getNakshatra'){
                $angaTemp = $Panchanga->$function(false, $anga['abhijit']);
            }else{
                $angaTemp = $Panchanga->$function();
            }

            $timeLeft = round($durAnga * ($angaTemp['left'] / 100) / 2 );
        } while($angaTemp['left'] > .2);

        $result = $timeEndObject->format(Time::FORMAT_DATETIME);

        unset($Panchanga);
        
        return $result;
    }
}