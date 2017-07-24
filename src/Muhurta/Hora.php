<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Math;
use Jyotish\Panchanga\Vara\Vara;
use DateTime;

/**
 * Hora class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Hora
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * Yama hora
     */
    const TYPE_YAMA = 'yama';
    /**
     * Kala hora
     */
    const TYPE_KALA = 'kala';

    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);
    }
    
    /**
     * Get hora. The Vedic system of time division divides each day (from one 
     * sunrise to another) into 24 horas.
     * 
     * @param string $type Type of hora (optional)
     * @return array
     */
    public function getHora($type = self::TYPE_KALA)
    {        
        switch ($type) {
            case self::TYPE_YAMA:
                // For Polar circle
                if (abs($this->Data->getLocality()->getLatitude() >= 65)) {
                    $hora = $this->getHoraKala();
                    break;
                }
                $hora = $this->getHoraYama();
                break;
            case self::TYPE_KALA:
            default:
                $hora = $this->getHoraKala();
        }
        return $hora;
    }

    /**
     * Get yama hora.
     * 
     * @return array
     */
    public function getHoraYama()
    {
        $this->checkData(__FUNCTION__);
        
        $DateTime = $this->Data->getDateTime();
        $TimeZone = $DateTime->getTimezone();
        
        $RisingToday = new DateTime($this->getData()['rising'][Graha::KEY_SY][1]['rising'], $TimeZone);
        $RisingTomorrow = new DateTime($this->getData()['rising'][Graha::KEY_SY][2]['rising'], $TimeZone);
        $SettingYesterday = new DateTime($this->getData()['rising'][Graha::KEY_SY][0]['setting'], $TimeZone);
        $SettingToday = new DateTime($this->getData()['rising'][Graha::KEY_SY][1]['setting'], $TimeZone);
        
        if ($DateTime > $RisingToday && $DateTime < $SettingToday) {
            $Rising = $RisingToday;
            $Setting = $SettingToday;
            
            $intervalHora = ($Setting->format('U') - $Rising->format('U')) / 12;
            $intervalTime = $DateTime->format('U') - $Rising->format('U');
            $isDay = true;
        } else {
            // before midnight
            if ($DateTime > $RisingToday) {
                $Rising = $RisingTomorrow;
                $Setting = $SettingToday;
            // after midnight
            } else {
                $Rising = $RisingToday;
                $Setting = $SettingYesterday;
            }
            $intervalHora = ($Rising->format('U') - $Setting->format('U')) / 12;
            $intervalTime = $DateTime->format('U') - $Setting->format('U');
            $isDay = false;
        }
        
        $number = (int) ceil($intervalTime / $intervalHora);
        $vara = $this->getData()['panchanga']['vara'];
        
        $horaNumber = $isDay ? $number : $number + 12;
        $riseSet = $isDay ? clone($Rising) : clone($Setting);
        $intervalModify = round($intervalHora * $number);
        $horaEnd = $riseSet->modify("+{$intervalModify} seconds")->format(Time::FORMAT_DATETIME);
        
        $hora = [
            'number' => $horaNumber,
            'key' => self::getLord($horaNumber, $vara['key']),
            'interval' => $intervalHora,
            'left' => fmod($intervalTime, $intervalHora) * 100 / $intervalHora,
            'type' => self::TYPE_YAMA,
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
        $DateTime = $this->Data->getDateTime();
        $hours = (int) $DateTime->format('G');
        $horaNumber = Math::distanceInCycle(6, $hours, 24);
        $weekNumber = $DateTime->format('w');
        
        $intervalHora = 3600;
        $intervalStart = (int) $DateTime->format('i') * 60 + (int) $DateTime->format('s');
        $intervalEnd = $intervalHora - $intervalStart;
        
        if ($hours >= 6) {
            $varaNumber = $weekNumber;
        } else {
            $varaNumber = $weekNumber != 0 ? $weekNumber - 1 : 6;
        }
        
        $varaKey = array_keys(Vara::$vara)[$varaNumber];
        
        $hora = [
            'number' => $horaNumber,
            'key' => self::getLord($horaNumber, $varaKey),
            'interval' => $intervalHora,
            'left' => fmod($intervalStart, $intervalHora) * 100 / $intervalHora,
            'type' => self::TYPE_KALA,
            'end' => $DateTime->modify("+{$intervalEnd} seconds")->format(Time::FORMAT_DATETIME),
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
    public static function getLord($horaNumber, $varaKey)
    {
        $lords = Math::shiftArray(Graha::listGraha(Graha::LIST_CHESHTA), $varaKey);
        
        $lordsKeys = array_keys($lords);
        $numLord = Math::numberInCycle(1, $horaNumber, 7) - 1;
        
        return $lordsKeys[$numLord];
    }
    
    /**
     * Check data.
     * 
     * @param null|string $function Function name
     * @return void
     */
    private function checkData($function = null)
    {
        if ($function == 'getHoraYama' && !isset($this->getData()['panchanga']['vara'])) {
            $this->Data->calcPanchanga(['vara']);
        }
    }
}