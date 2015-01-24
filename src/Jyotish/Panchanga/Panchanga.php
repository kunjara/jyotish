<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

use DateTime;
use DateInterval;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Panchanga\Yoga\Yoga;
use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Panchanga\Karana\Karana;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Kala\Masa;

/**
 * Class to calculate the Panchanga.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Panchanga {
    const ANGA_TITHI     = 'tithi';
    const ANGA_NAKSHATRA = 'nakshatra';
    const ANGA_YOGA      = 'yoga';
    const ANGA_VARA      = 'vara';
    const ANGA_KARANA    = 'karana';
    
    /**
     * Ganita object.
     * 
     * @var Ganita
     */
    private $ganitaObject = null;
    
    /**
     * Ganita data.
     * 
     * @var array
     */
    private $ganitaData = array();

    /**
     * Calculated tithi.
     * 
     * @var array
     */
    private $tithi = null;

    /**
     * Constructor
     * 
     * @param array|Ganita $ganitaData
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($ganitaData)
    {
        if($ganitaData instanceof \Jyotish\Ganita\Method\AbstractGanita){
            $this->ganitaObject = $ganitaData;
            $this->setData();
            $this->ganitaData['rising'] = $this->ganitaObject->getRisings();
        }elseif(is_array($ganitaData)){
            $this->ganitaData = $ganitaData;
        }else{
            throw new Exception\InvalidArgumentException(
                'Ganita data must be a Ganita object or an array of ganita params.'
            );
        }
    }

    /**
     * Clone Ganita object.
     */
    public function __clone()
    {
        $this->ganitaObject = clone $this->ganitaObject;
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

        $lngCh = $this->ganitaData['graha'][Graha::KEY_CH]['longitude'];
        $lngSy = $this->ganitaData['graha'][Graha::KEY_SY]['longitude'];		

        if($lngCh < $lngSy) $lngCh = $lngCh + 360;

        $tithiUnits = Math::partsToUnits(($lngCh - $lngSy), $unit);
        $tithiObject = Tithi::getInstance($tithiUnits['units']);

        $tithi['number'] = $tithiUnits['units'];
        $tithi['name'] = Tithi::$tithi[$tithi['number']];
        $tithi['paksha'] = $tithiObject->tithiPaksha;
        $tithi['left'] = ($unit - $tithiUnits['parts']) * 100 / $unit;

        if($withLimit){
            $limits = $this->limitAnga($tithi, __FUNCTION__);
            $tithi['end'] = $limits['end'];
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

        $lngGraha = $this->ganitaData['graha'][$grahaKey]['longitude'];
        $nakshatraUnits = Math::partsToUnits($lngGraha, $unit);

        if($withAbhijit){
            if($nakshatraUnits['units'] == 21 or $nakshatraUnits['units'] == 22){
                $Abhijit = Nakshatra::getInstance(28);
                $abhijitStart = Math::dmsToDecimal($Abhijit->nakshatraStart);
                $abhijitEnd   = Math::dmsToDecimal($Abhijit->nakshatraEnd);

                if($lngGraha < $abhijitStart){
                    $nakshatra['number'] = 21;
                    $N = Nakshatra::getInstance($nakshatra['number']);
                    $nStart = Math::dmsToDecimal($N->nakshatraStart);
                    $unit = $abhijitStart - $nStart;
                    $left = $abhijitStart - $lngGraha;
                }elseif($lngGraha >= $abhijitStart and $lngGraha < $abhijitEnd){
                    $nakshatra['number'] = 28;
                    $unit = $abhijitEnd - $abhijitStart;
                    $left = $abhijitEnd - $lngGraha;
                }else{
                    $nakshatra['number'] = 22;
                    $N = Nakshatra::getInstance($nakshatra['number']);
                    $nEnd = Math::dmsToDecimal($N->nakshatraEnd);
                    $unit = $nEnd - $abhijitEnd;
                    $left = $nEnd - $lngGraha;
                }
                $nakshatra['ratio'] = $unit / Math::dmsToDecimal(Nakshatra::$nakshatraArc);
            }else{
                $nakshatra['number'] = $nakshatraUnits['units'];
                $nakshatra['ratio'] = 1;
                $left = $unit - $nakshatraUnits['parts'];
            }
            $nakshatra['abhijit'] = true;
        }else{
            $nakshatra['number'] = $nakshatraUnits['units'];
            $nakshatra['ratio'] = 1;
            $nakshatra['abhijit'] = false;
            $left = $unit - $nakshatraUnits['parts'];
        }

        $nakshatra['left'] = $left * 100 / $unit;
        $nakshatra['name'] = Nakshatra::$nakshatra[$nakshatra['number']];

        if($withLimit){
            $limits = $this->limitAnga($nakshatra, __FUNCTION__);
            $nakshatra['end'] = $limits['end'];
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

        $lngCh  = $this->ganitaData['graha'][Graha::KEY_CH]['longitude'];
        $lngSy  = $this->ganitaData['graha'][Graha::KEY_SY]['longitude'];
        $lngSum = $lngCh + $lngSy;

        if($lngSum > 360) {
            $lngSum = $lngSum - 360;
        }

        $yogaUnits = Math::partsToUnits($lngSum, $unit);

        $yoga['number'] = $yogaUnits['units'];
        $yoga['name'] = Yoga::$yoga[$yoga['number']];
        $yoga['left'] = ($unit - $yogaUnits['parts']) * 100 / $unit;

        if($withLimit){
            $limits = $this->limitAnga($yoga, __FUNCTION__);
            $yoga['end'] = $limits['end'];
        }

        return $yoga;
    }

    /**
     * Get Varana. The seven weekdays.
     * 
     * @return array
     */
    public function getVara()
    {
        $dateUser = new DateTime($this->ganitaData['user']['date'].' '.$this->ganitaData['user']['time']);
        $dateUserU = $dateUser->format('U');
        $dateRising[2] = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][2]['rising']);
        $dateRisingU[2] = $dateRising[2]->format('U');
        $dateRising[3] = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][3]['rising']);
        $dateRisingU[3] = $dateRising[3]->format('U');

        if($dateUser >= $dateRising[3]) {
            $index = 1;
            $dateRising[4] = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][4]['rising']);
            $dateRisingU[4] = $dateRising[4]->format('U');
        }else{
            $index = 0;
            $dateRising[1] = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][1]['rising']);
            $dateRisingU[1] = $dateRising[1]->format('U');
        }

        $varaNumber = $dateUser->format('w');

        if($dateUser >= $dateRising[2 + $index]) {
            $vara['number'] = $varaNumber + 1;

            $duration = $dateRisingU[3 + $index] - $dateRisingU[2 + $index];
            $vara['left'] = ($dateRisingU[3 + $index] - $dateUserU) * 100 / $duration;
            $vara['start'] = $this->ganitaData['rising'][Graha::KEY_SY][2 + $index]['rising'];
            $vara['end'] = $this->ganitaData['rising'][Graha::KEY_SY][3 + $index]['rising'];
        } else {
            $varaNumber != 0 ? $vara['number'] = $varaNumber : $vara['number'] = 7;

            $duration = $dateRisingU[2 + $index] - $dateRisingU[1 + $index];
            $vara['left'] = ($dateRisingU[2 + $index] - $dateUserU) * 100 / $duration;
            $vara['start'] = $this->ganitaData['rising'][Graha::KEY_SY][1 + $index]['rising'];
            $vara['end'] = $this->ganitaData['rising'][Graha::KEY_SY][2 + $index]['rising'];
        }

        $vara['name'] = Vara::$VARA[$vara['number']];

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
        if($this->tithi['left'] < 50){
            $number = 2;
            $left = $this->tithi['left'];
            if($withLimit)
                $karana['end'] = $this->tithi['end'];
        } else {
            $number = 1;
            $left = $this->tithi['left'] - 50;
            if($withLimit){
                $dateUser = new DateTime($this->ganitaData['user']['date'].' '.$this->ganitaData['user']['time']);
                $tithiEnd = new DateTime($this->tithi['end']);
                $dateUserU = $dateUser->format('U');
                $tithiEndU = $tithiEnd->format('U');
                $timeHalfU = round(($tithiEndU - $dateUserU) * 50 / $this->tithi['left']);
                $karana['end'] = $tithiEnd->sub(new DateInterval('PT'.$timeHalfU.'S'))->format(Time::FORMAT_DATETIME);
            }
        }

        $tithiObject = Tithi::getInstance($this->tithi['number']);
        $karanaArray = $tithiObject->tithiKarana;
        $karanaName = $karanaArray[$number];
        $karanaNumber = array_search($karanaName, Karana::$KARANA);

        $karana['number'] = $karanaNumber;
        $karana['name'] = $karanaName;
        $karana['left'] = $left * 2;

        return $karana;
    }

    /**
     * Get data.
     * 
     * @return array
     */
    public function getData()
    {
        return $this->ganitaData;
    }

    /**
     * Set data for Panchanga.
     * 
     * @param array $userData
     */
    private function setData(array $userData = null)
    {
        if(!is_null($userData)) $this->ganitaObject->setData($userData);

        $this->ganitaData['user'] = $this->ganitaObject->getData();
        $this->ganitaData = array_merge($this->ganitaData, $this->ganitaObject->getParams());
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
        if(is_null($this->ganitaObject)){
            throw new Exception\RuntimeException(
                'For calculation of the end angas must be used Ganita object.'
            );
        }

        if($function == 'getTithi'){
            $durMonth = Masa::DUR_SYNODIC * 86400;
            $nAnga = 30;
            $anga['ratio'] = 1;
        }elseif($function == 'getYoga'){
            $durMonth = Masa::DUR_SYNODIC * 86400;
            $nAnga = 27;
            $anga['ratio'] = 1;
        }elseif($function == 'getNakshatra'){
            $durMonth = Masa::DUR_SIDERIAL * 86400;
            $nAnga = 27;
        }else{
            $anga['ratio'] = 1;
        }

        $dateUser  = new DateTime($this->ganitaData['user']['date'].' '.$this->ganitaData['user']['time']);
        $durAnga   = $durMonth * $anga['ratio'] / $nAnga;
        $Panchanga = clone $this;

        $timeLeft = round($durAnga * ($anga['left'] / 100) / 2);

        // End time
        do {
            $timeEndObject = $dateUser->add(new DateInterval('PT'.$timeLeft.'S'));

            $Panchanga->setData([
                'date' => $timeEndObject->format(Time::FORMAT_DATA_DATE), 
                'time' => $timeEndObject->format(Time::FORMAT_DATA_TIME)
            ]);

            if($function == 'getNakshatra'){
                $angaEnd = $Panchanga->$function(false, $anga['abhijit']);
            }else{
                $angaEnd = $Panchanga->$function();
            }

            $timeLeft = round($durAnga * ($angaEnd['left'] / 100) / 2 );
        } while($angaEnd['left'] > .2);

        $result = array(
            'end' => $timeEndObject->format(Time::FORMAT_DATETIME),
        );

        unset($Panchanga);
        return $result;
    }
}