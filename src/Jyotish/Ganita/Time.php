<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * Class for working with date and time.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Time {
    const FORMAT_DATE           = 'Y-m-d';
    const FORMAT_DATETIME       = 'Y-m-d H:i:s';
    const FORMAT_DATA_DATE      = 'd.m.Y';
    const FORMAT_DATA_TIME      = 'H:i:s';
    const FORMAT_OFFSET_TIME    = '%H:%I';
    
    /**
     * Create new DateTime object from user data.
     * 
     * @param array $data User data
     * @return DateTime
     */
    static public function createDateTime(array $data)
    {
        $dateTime = $data['date'] . ' ' . $data['time'];
        $TimeZone = isset($data['timezone']) ? new DateTimeZone($data['timezone']) : null;
        
        $DateTime = new DateTime($dateTime, $TimeZone);
        
        return $DateTime;
    }
    
    /**
     * Create new DateTime object from user data in UTC timezone.
     * 
     * @param array $data User data
     * @return DateTime
     */
    static public function createDateTimeUtc(array $data)
    {
        $DateTime = self::createDateTime($data);

        if ($data['timezone'] != 'UTC') {
            $DateTime->setTimezone(new DateTimeZone('UTC'));
        }
        
        $offsetSystem = self::getTimeZoneOffset($data['timezone'], $data['date'] . ' ' . $data['time']);
        $offsetUser = $data['offset'] != $offsetSystem ? $data['offset'] : false;
        
        if($offsetUser) {
            $offsetTotal = $offsetSystem - $offsetUser;

            if($offsetTotal > 0) {
                $DateTime->add(new DateInterval('PT'.$offsetTotal.'S'));
            } elseif($offsetTotal < 0) {
                $DateTime->sub(new DateInterval('PT'.abs($offsetTotal).'S'));
            }
        }

        return $DateTime;
    }
    
    /**
     * Get Julian Day Number.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    static public function getJDN(DateTime $DateTime = null)
    {
        if(is_null($DateTime)){
            $DateTime = new DateTime('now');
        }
        
        $year = $DateTime->format('Y');
        $month = $DateTime->format('n');
        $day = $DateTime->format('j');
        
        $a = floor((14 - $month) / 12);
        $y = $year + 4800 - $a;
        $m = $month + 12 * $a - 3;
        
        $JDN = $day + floor((153 * $m + 2) / 5) + 365 * $y + floor($y / 4) - floor($y / 100) + floor($y / 400) - 32045;
        
        return $JDN;
    }
    
    /**
     * Get Julian Day.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    static public function getJD(DateTime $DateTime = null)
    {
        if(is_null($DateTime)){
            $DateTime = new DateTime('now');
        }
        
        $hour = $DateTime->format('G');
        $minute = $DateTime->format('i');
        $second = $DateTime->format('s');
        $JDN = self::getJDN($DateTime);
        
        $JD = $JDN + ($hour - 12) / 24 + $minute / 1440 + $second / 86400;
        
        return $JD;
    }
    
    /**
     * Get Reduced Julian Day.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    static public function getRJD(DateTime $DateTime = null)
    {
        if(is_null($DateTime)){
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $RJD = $JD - 2400000;
        
        return $RJD;
    }
    
    /**
     * Get Modified Julian Day.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    static public function getMJD(DateTime $DateTime = null)
    {
        if(is_null($DateTime)){
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $MJD = $JD - 2400000.5;
        
        return $MJD;
    }
    
    /**
     * Get Julian Centuries.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    static public function getJC(DateTime $DateTime = null)
    {
        if(is_null($DateTime)){
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $JC = ($JD - 2451545) / 36525;
        
        return $JC;
    }

    static public function getTimeZoneOffset($timeZone, $dateTime, $flagFormat = false) 
    {
        $TimeZone = new DateTimeZone($timeZone);
        $DateTime = new DateTime($dateTime, $TimeZone);

        $offset = $TimeZone->getOffset($DateTime);
        $offsetResult = $flagFormat ? self::formatOffset($offset) : $offset;

        return $offsetResult;
    }

    static public function formatOffset($offset, $format = self::FORMAT_OFFSET_TIME) 
    {
        $offsetInterval = new DateInterval('PT'.abs($offset).'S');

        $seconds = $offsetInterval->s;
        $offsetInterval->h = floor($seconds/60/60);
        $seconds -= $offsetInterval->h * 3600;
        $offsetInterval->i = floor($seconds/60);
        $seconds -= $offsetInterval->i * 60;
        $offsetInterval->s = $seconds;

        $offsetFormat = $offsetInterval->format($format);
        $offsetResult = $offset < 0 ? '-' . $offsetFormat : $offsetFormat;

        return $offsetResult;
    }

    static public function disFormatOffset($offset, $delimiter = ':')
    {
        $offsetArray = explode($delimiter, $offset);
        $result = $offsetArray[0] * 3600 + $offsetArray[1] * 60;
        return $result;
    }

    static public function getTimeZoneLocation($timeZone) {
        $TimeZone = new DateTimeZone($timeZone);
        $location = $TimeZone->getLocation();

        return $location;
    }

    static public function getTimeZoneTransitions($timeZone) {
        $TimeZone = new DateTimeZone($timeZone);
        $transitions = $TimeZone->getTransitions();

        return $transitions;
    }
}