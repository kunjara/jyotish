<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use Jyotish\Ganita\Math;
use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * Class for working with date and time.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Time
{
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
    public static function createDateTime(array $data)
    {
        $TimeZone = isset($data['timezone']) ? new DateTimeZone($data['timezone']) : null;
        $DateTime = new DateTime($data['datetime'], $TimeZone);
        
        return $DateTime;
    }
    
    /**
     * Create new DateTime object from user data in UTC timezone.
     * 
     * @param array $data User data
     * @return DateTime
     */
    public static function createDateTimeUtc(array $data)
    {
        $DateTime = self::createDateTime($data);

        if ($data['timezone'] != 'UTC') {
            $DateTime->setTimezone(new DateTimeZone('UTC'));
        }
        
        $offsetSystem = self::getTimeZoneOffset($DateTime);
        $offsetUser = $data['offset'] != $offsetSystem ? $data['offset'] : false;
        
        if ($offsetUser) {
            $offsetTotal = $offsetSystem - $offsetUser;

            if ($offsetTotal > 0) {
                $DateTime->add(new DateInterval('PT'.$offsetTotal.'S'));
            } elseif ($offsetTotal < 0) {
                $DateTime->sub(new DateInterval('PT'.abs($offsetTotal).'S'));
            }
        }

        return $DateTime;
    }
    
    /**
     * Get Julian Day Number.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return int
     */
    public static function getJDN(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
            $DateTime = new DateTime('now');
        }
        
        $year = $DateTime->format('Y');
        $month = $DateTime->format('n');
        $day = $DateTime->format('j');
        
        $JDN = gregoriantojd($month, $day, $year);
        
        return (int)$JDN;
    }
    
    /**
     * Get Julian Day.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    public static function getJD(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
            $DateTime = new DateTime('now');
        }
        
        $JDN = self::getJDN($DateTime);
        $hour = $DateTime->format('G');
        $minute = $DateTime->format('i');
        $second = $DateTime->format('s');
        
        $JD = $JDN + ($hour - 12) / 24 + $minute / 1440 + $second / 86400;
        
        return $JD;
    }
    
    /**
     * Get Reduced Julian Day.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    public static function getRJD(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
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
    public static function getMJD(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $MJD = $JD - 2400000.5;
        
        return $MJD;
    }
    
    /**
     * Get Julian Centuries elapsed from J2000.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    public static function getJC(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $JC = ($JD - 2451545) / 36525;
        
        return $JC;
    }
    
    /**
     * Get Julian Millenia elapsed from J2000.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float
     */
    public static function getJM(DateTime $DateTime = null)
    {
        if (is_null($DateTime)) {
            $DateTime = new DateTime('now');
        }
        
        $JD = self::getJD($DateTime);
        $JM = ($JD - 2451545) / 365250;
        
        return $JM;
    }

    /**
     * Get timezone offset.
     * 
     * @param DateTime $DateTime
     * @param bool $flagFormat
     * @return int|string
     */
    public static function getTimeZoneOffset(DateTime $DateTime, $flagFormat = false) 
    {
        $TimeZone = $DateTime->getTimezone();

        $offset = $TimeZone->getOffset($DateTime);
        $result = $flagFormat ? self::formatOffset($offset) : $offset;

        return $result;
    }

    /**
     * Format offset.
     * 
     * @param int $offsetSecond Offset in seconds
     * @param string $format Offset format
     * @return string
     */
    public static function formatOffset($offsetSecond, $format = self::FORMAT_OFFSET_TIME) 
    {
        $offsetInterval = new DateInterval('PT'.abs($offsetSecond).'S');

        $seconds = $offsetInterval->s;
        $offsetInterval->h = (int)floor($seconds/60/60);
        $seconds -= $offsetInterval->h * 3600;
        $offsetInterval->i = (int)floor($seconds/60);
        $seconds -= $offsetInterval->i * 60;
        $offsetInterval->s = (int)$seconds;

        $offsetFormat = $offsetInterval->format($format);
        $result = Math::sign($offsetSecond, false) . $offsetFormat;

        return $result;
    }

    /**
     * Format string representation of the offset to seconds.
     * 
     * @param string $offsetString String offset
     * @param string $delimiter Delimiter 
     * @return int
     */
    public static function disformatOffset($offsetString, $delimiter = ':')
    {
        $offsetArray = explode($delimiter, $offsetString);
        $result = $offsetArray[0] * 3600 + $offsetArray[1] * 60;
        
        return (int)$result;
    }
}