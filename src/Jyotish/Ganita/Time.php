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
 * Class for working with time and date.
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
        $timeZone = !is_null($data['timezone']) ? new DateTimeZone($data['timezone']) : null;
        
        $dateTimeObject = new DateTime($dateTime, $timeZone);
        
        return $dateTimeObject;
    }
    
    /**
     * Create new DateTime object from user data in UTC timezone.
     * 
     * @param array $data User data
     * @return DateTime
     */
    static public function createDateTimeUtc(array $data)
    {
        $dateTimeObject = self::createDateTime($data);

        if ($data['timezone'] != 'UTC') {
            $dateTimeObject->setTimezone(new DateTimeZone('UTC'));
        }
        
        $offsetSystem = self::getTimeZoneOffset($data['timezone'], $data['date'] . ' ' . $data['time']);
        $offsetUser = $data['offset'] != $offsetSystem ? $data['offset'] : false;
        
        if($offsetUser) {
            $offsetTotal = $offsetSystem - $offsetUser;

            if($offsetTotal > 0) {
                $dateTimeObject->add(new DateInterval('PT'.$offsetTotal.'S'));
            } elseif($offsetTotal < 0) {
                $dateTimeObject->sub(new DateInterval('PT'.abs($offsetTotal).'S'));
            }
        }

        return $dateTimeObject;
    }

    /**
     * Convert time from 'Y-m-d H:i:s' to $format
     * 
     * @param string $format
     * @param string $dateTime
     * @return string
     */
    static public function convertToFormat($format, $dateTime)
    {
        $dateTimeObject = DateTime::createFromFormat(self::FORMAT_DATETIME, $dateTime);
        $timeFormat = $dateTimeObject->format($format);

        return $timeFormat;
    }

    static public function getTimeZoneOffset($timeZone, $dateTime, $flagFormat = false) 
    {
        $timeZoneObject = new DateTimeZone($timeZone);
        $dateTimeObject = new DateTime($dateTime, $timeZoneObject);

        $offset = $timeZoneObject->getOffset($dateTimeObject);
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
        $timeZoneObject = new DateTimeZone($timeZone);
        $location = $timeZoneObject->getLocation();

        return $location;
    }

    static public function getTimeZoneTransitions($timeZone) {
        $timeZoneObject = new DateTimeZone($timeZone);
        $transitions = $timeZoneObject->getTransitions();

        return $transitions;
    }
}