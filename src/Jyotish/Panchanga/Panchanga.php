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
    /**
     * Tithi anga
     */
    const ANGA_TITHI     = 'tithi';
    /**
     * Nakshatra anga
     */
    const ANGA_NAKSHATRA = 'nakshatra';
    /**
     * Yoga anga
     */
    const ANGA_YOGA      = 'yoga';
    /**
     * Vara anga
     */
    const ANGA_VARA      = 'vara';
    /**
     * Karana anga
     */
    const ANGA_KARANA    = 'karana';
    
    /**
     * List of angas.
     * 
     * @var array
     */
    static public $anga = [
        self::ANGA_TITHI,
        self::ANGA_NAKSHATRA,
        self::ANGA_YOGA,
        self::ANGA_VARA,
        self::ANGA_KARANA
    ];

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

        $tithi['anga'] = self::ANGA_TITHI;
        $tithi['key'] = $tithiUnits['units'];
        $tithi['name'] = Tithi::$tithi[$tithi['key']];
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

        if(array_key_exists($grahaKey, Graha::$graha)){
            $lngGraha = $this->ganitaData['graha'][$grahaKey]['longitude'];
        }else{
            if(!isset($this->ganitaData['extra'][$grahaKey]['longitude'])){
                throw new Exception\InvalidArgumentException(
                    "Longitude value for the key '$grahaKey' is not defined."
                );
            }else{
                $lngGraha = $this->ganitaData['extra'][$grahaKey]['longitude'];
            }
        }
        
        $nakshatraUnits = Math::partsToUnits($lngGraha, $unit);

        $nakshatra['anga'] = self::ANGA_NAKSHATRA;
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
                $nakshatra['ratio'] = $unit / Math::dmsToDecimal(Nakshatra::$nakshatraArc);
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

        $yoga['anga'] = self::ANGA_YOGA;
        $yoga['key'] = $yogaUnits['units'];
        $yoga['name'] = Yoga::$yoga[$yoga['key']];
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
     * @param bool $withLimit Time limit
     * @return array
     */
    public function getVara($withLimit = false)
    {
        $this->ganitaData['rising'] = $this->ganitaObject->getRisings();
        
        $dateUser = new DateTime($this->ganitaData['user']['date'].' '.$this->ganitaData['user']['time']);
        $dateUserU = $dateUser->format('U');
        $varaNumber = $dateUser->format('w');
        
        for($i = 1; $i <= 4; $i++){
            $dateRising[$i] = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][$i]['rising']);
            $dateRisingU[$i] = $dateRising[$i]->format('U');
        }
        
        if($dateUser >= $dateRising[2]){
            $index = 1;
        }else{
            $index = 0;
            $varaNumber = $varaNumber != 0 ? $varaNumber - 1 : 6;
        }
        
        $duration = $dateRisingU[2 + $index] - $dateRisingU[1 + $index];

        $vara['anga'] = self::ANGA_VARA;
        $vara['left'] = ($dateRisingU[2 + $index] - $dateUserU) * 100 / $duration;
        $vara['key'] = array_keys(Vara::$vara)[$varaNumber];
        $vara['name'] = array_values(Vara::$vara)[$varaNumber];
        
        if($withLimit){
            $vara['start'] = $this->ganitaData['rising'][Graha::KEY_SY][1 + $index]['rising'];
            $vara['end'] = $this->ganitaData['rising'][Graha::KEY_SY][2 + $index]['rising'];
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
                $dateUser = new DateTime($this->ganitaData['user']['date'].' '.$this->ganitaData['user']['time']);
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

        $karana['anga'] = self::ANGA_KARANA;
        $karana['key'] = $karanaNumber;
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
    public function setData(array $userData = null)
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
            $durMonth = Masa::DUR_SIDEREAL * 86400;
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
