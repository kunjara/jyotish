<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Math;
use Jyotish\Base\Utils;
use Jyotish\Panchanga\AngaDefiner;
use Jyotish\Panchanga\Vara\Vara;
use DateTime;
use DateTimeZone;

/**
 * Hora class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Hora {
    /**
     * Yama hora
     */
    const TYPE_YAMA = 'yama';
    /**
     * Kala hora
     */
    const TYPE_KALA = 'kala';
    
    protected $AngaDefiner = null;
    
    protected $ganitaData = null;
    
    protected $userDateTime = null;
    
    protected $userTimeZone = null;

    /**
     * Constructor
     * 
     * @param \Jyotish\Panchanga\AngaDefiner $AngaDefiner
     */
    public function __construct(AngaDefiner $AngaDefiner)
    {
        $this->AngaDefiner = $AngaDefiner;
        $this->ganitaData = $this->AngaDefiner->getData();
        
        $this->userDateTime = Time::createDateTime($this->ganitaData['user']);
        $this->userTimeZone = new DateTimeZone($this->ganitaData['user']['timezone']);
    }

    /**
     * Get yama hora.
     * 
     * @return array
     */
    public function getHoraYama()
    {
        $risingToday = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][1]['rising'], $this->userTimeZone);
        $risingTomorrow = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][2]['rising'], $this->userTimeZone);
        $settingYesterday = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][0]['setting'], $this->userTimeZone);
        $settingToday = new DateTime($this->ganitaData['rising'][Graha::KEY_SY][1]['setting'], $this->userTimeZone);
        
        if($this->userDateTime > $risingToday and $this->userDateTime < $settingToday){
            $rising = $risingToday;
            $setting = $settingToday;
            
            $intervalHora = ($setting->format('U') - $rising->format('U')) / 12;
            $intervalTime = $this->userDateTime->format('U') - $rising->format('U');
            $isDay = true;
        }else{
            // before midnight
            if($this->userDateTime > $risingToday){
                $rising = $risingTomorrow;
                $setting = $settingToday;
            // after midnight
            }else{
                $rising = $risingToday;
                $setting = $settingYesterday;
            }
            $intervalHora = ($rising->format('U') - $setting->format('U')) / 12;
            $intervalTime = $this->userDateTime->format('U') - $setting->format('U');
            $isDay = false;
        }
        
        $number = (int)ceil($intervalTime / $intervalHora);
        $vara = $this->AngaDefiner->getVara();
        
        $horaNumber = $isDay ? $number : $number + 12;
        $riseSet = $isDay ? clone($rising) : clone($setting);
        $intervalModify = round($intervalHora * $number);
        $horaEnd = $riseSet->modify("+{$intervalModify} seconds")->format(Time::FORMAT_DATETIME);
        
        $hora = [
            'number' => $horaNumber,
            'key' => self::getLord($horaNumber, $vara['key']),
            'interval' => $intervalHora,
            'left' => fmod($intervalTime, $intervalHora) * 100 / $intervalHora,
            'end' => $horaEnd,
        ];
        
        return $hora;
    }
    
    /**
     * Get kala hora.
     * 
     * @return array
     */
    public function getHoraKala()
    {
        $hours = (int)$this->userDateTime->format('G');
        $horaNumber = Math::distanceInCycle(6, $hours, 24);
        $weekNumber = $this->userDateTime->format('w');
        
        $intervalHora = 3600;
        $intervalStart = (int)$this->userDateTime->format('i') * 60 + (int)$this->userDateTime->format('s');
        $intervalEnd = $intervalHora - $intervalStart;
        
        if($hours >= 6){
            $varaNumber = $weekNumber;
        }else{
            $varaNumber = $weekNumber != 0 ? $weekNumber - 1 : 6;
        }
        
        $varaKey = array_keys(Vara::$vara)[$varaNumber];
        
        $hora = [
            'number' => $horaNumber,
            'key' => self::getLord($horaNumber, $varaKey),
            'interval' => $intervalHora,
            'left' => fmod($intervalStart, $intervalHora) * 100 / $intervalHora,
            'end' => $this->userDateTime->modify("+{$intervalEnd} seconds")->format(Time::FORMAT_DATETIME),
        ];
        
        return $hora;
    }
    
    /**
     * Get lord of hora.
     * 
     * @param int $horaNumber Number of hora
     * @param int $varaKey Key of vara
     * @return string
     */
    static public function getLord($horaNumber, $varaKey)
    {
        $lords = Utils::shiftArray(Graha::listGraha(Graha::LIST_CHESHTA), $varaKey);
        
        $lordsKeys = array_keys($lords);
        $numLord = Math::numberInCycle(1, $horaNumber, 7) - 1;
        
        return $lordsKeys[$numLord];
    }
}