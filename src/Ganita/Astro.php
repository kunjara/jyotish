<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use Jyotish\Base\Locality;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Ayanamsha;
use DateTime;

/**
 * Formulas for various astronomical calculations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Astro
{
    /**
     * Approximate duration of precession in years.
     */
    const DURATION_PRECESSION = 25880;
    
    /**
     * Duration of the year in Gregorian calendar in days. 
     */
    const DURATION_YEAR_GREGORIAN = 365.2425;
    /**
     * Duration of the year in Julian calendar in days. 
     */
    const DURATION_YEAR_JULIAN = 365.25;
    /**
     * Duration of sidereal year in days.
     */
    const DURATION_YEAR_SIDEREAL = 365.2564;
    
    /**
     * Duration of the sidereal month in days.
     */
    const DURATION_MONTH_SIDEREAL = 27.3216610;
    /**
     * Duration of the synodic month in days.
     */
    const DURATION_MONTH_SYNODIC = 29.5305882;
    
    /**
     * Get sunrise time.
     * 
     * @param array $userData
     * @param array $sunData
     * @return float
     */
    public static function getSunRise($userData, $sunData)
    {
        $hourAngle = acos((cos(Math::dmsToDecimal(['d' => 90, 'm' => 51])) - sin($userData['latitude']) * sin($sunData['declination'])) / cos($userData['latitude']) * cos($sunData['declination']));
        $eot = self::getEot($userData['date']);

        $time = 12 - $hourAngle + $eot;

        return $time;
    }
    
    /**
     * Get equation of time.
     * 
     * @param string $date A date/time string
     * @return float Number of minutes
     * @link https://en.wikipedia.org/wiki/Equation_of_time Equation of time
     */
    public static function getEot($date)
    {
        $dateObject = new DateTime($date);
        $day = $dateObject->format('z') + 1;

        $B = 2 * M_PI * ($day - 81) / 365;
        $e = 7.53 * cos($B) + 1.5 * sin($B) - 9.87 * sin(2 * $B);

        return $e;
    }
    
    /**
     * Get tiithi using the Harvey formula.
     * 
     * @param ind $day
     * @param int $month
     * @param int $year
     * @return int
     */
    public static function getTithiByHarvey($day, $month, $year)
    {
        if ($month <= 2) {
            $monthH	= $month + 12;
            $yearH = $year - 1;
        } else {
            $monthH = $month;
            $yearH = $year;
        }

        $eq  = floor($yearH/100);
        $eq1 = floor($eq/3) + floor($eq/4) + 6 - $eq;
        $eq2 = (round(($yearH/$eq - floor($yearH/$eq)) * 209) + $monthH + $eq1 + $day)/30;

        $tithi = round(($eq2 - floor($eq2))*30 + 1);

        return $tithi;
    }
    
    /**
     * Get zodiac sign in Western astrology.
     * 
     * @param int $day
     * @param int $month
     * @return int
     */
    public static function getSign($day, $month)
    {
        $signs = [10, 11, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        
        $signStart = [
            1 => 21, 2 => 20, 3 => 21, 
            4 => 21, 5 => 22, 6 => 22, 
            7 => 23, 8 => 22, 9 => 24, 
            10 => 24, 11 => 23, 12 => 23
        ];
        
        return $day < $signStart[$month] ? $signs[$month-1] : $signs[$month];
    }
    
    /**
     * Get angular speed of earth precession.
     * 
     * @param int $duration Approximate duration of precession in years
     * @return float
     */
    public static function getPrecessionSpeed($duration = self::DURATION_PRECESSION)
    {
        $arcsec = 360 / $duration * 3600;
        
        return $arcsec;
    }
    
    /**
     * Get Local Sidereal Time.
     * 
     * @param DateTime $DateTime Date
     * @param Locality $Locality Locality
     * @return float In hours
     */
    public static function getLST(DateTime $DateTime, Locality $Locality)
    {
        $hour = $DateTime->format('G');
        $minute = $DateTime->format('i');
        $second = $DateTime->format('s');
        
        $jc = Time::getJC($DateTime);
        $gst = 24110.54841 + 8640184.812866 * $jc + 0.093104 * $jc ** 2 - 0.0000062 * $jc ** 3;
        
        $units = Math::partsToUnits($gst, 86400);
        
        $hourS0     = $units['parts'] / 3600;
        $hourLng    = $Locality->getLongitude() / 15;
        $hourOffset = $DateTime->getOffset() / 3600;
        $hourUT     = $hour + $minute / 60 + $second / 3600 - $hourOffset;
        
        $lst = $hourS0 + $hourLng + $hourUT * 1.002737909350795;
        
        $result = $lst >= 24 ? $lst -= 24 : $lst;
        
        return $result;
    }
    
    /**
     * Get Right Ascension of the Medium Coeli (Midheaven).
     * 
     * @param DateTime $DateTime Date
     * @param Locality $Locality Locality
     * @return float In degree
     */
    public static function getRAMC(DateTime $DateTime, Locality $Locality)
    {
        $lst = self::getLST($DateTime, $Locality);
        $ramc = $lst * 15;
        
        return $ramc;
    }
    
    /**
     * Get obliquity of the ecliptic.
     * 
     * @param null|DateTime $DateTime Date (optional)
     * @return float In degree
     */
    public static function getEclipticObliquity(DateTime $DateTime = null)
    {
        $jc = Time::getJC($DateTime);
        
        $k = Math::dmsToDecimal(['d' => 23, 'm' => 26, 's' => 21.448]);
        $k1 = Math::dmsToDecimal(['d' => 0, 'm' => 0, 's' => 46.815]);
        $k2 = Math::dmsToDecimal(['d' => 0, 'm' => 0, 's' => 0.00059]);
        $k3 = Math::dmsToDecimal(['d' => 0, 'm' => 0, 's' => 0.001813]);
        
        $e = $k - $k1 * $jc - $k2 * $jc ** 2 + $k3 * $jc ** 3;
        
        return $e;
    }
    
    /**
     * Get ascendant.
     * 
     * @param DateTime $DateTime Date
     * @param Locality $Locality Locality
     * @param bool $ayanamsha Take into account the ayanamsha (optional)
     * @return float
     */
    public static function getAsc(DateTime $DateTime, Locality $Locality, $ayanamsha = false)
    {
        $e = self::getEclipticObliquity($DateTime) * Math::M_RAD;
        $ayanamshaValue = $ayanamsha ? Ayanamsha::calcAyanamsha($DateTime) : 0;
        
        $ramc = self::getRAMC($DateTime, $Locality) * Math::M_RAD;
                
        $asc = atan2(cos($ramc), (-sin($ramc) * cos($e) - tan($Locality->getLatitude() * Math::M_RAD) * sin($e)));
        $ascDeg = $asc / Math::M_RAD;
        $ascDeg -= $ayanamshaValue;
        
        return $ascDeg < 0 ? 360 + $ascDeg : $ascDeg;
    }
    
    /**
     * Get Medium Coeli (Midheaven).
     * 
     * @param DateTime $DateTime Date
     * @param Locality $Locality Locality
     * @param bool $ayanamsha Take into account the ayanamsha (optional)
     * @return float In degree
     */
    public static function getMC(DateTime $DateTime, Locality $Locality, $ayanamsha = false)
    {
        $e = self::getEclipticObliquity($DateTime) * Math::M_RAD;
        $ayanamshaValue = $ayanamsha ? Ayanamsha::calcAyanamsha($DateTime) : 0;
        
        $ramcDeg = self::getRAMC($DateTime, $Locality);
        $ramc = $ramcDeg * Math::M_RAD;
        
        $mc = atan2(tan($ramc), cos($e));
        $mcDeg = $mc / Math::M_RAD;
        
        if ($ramcDeg >= 0 && $ramcDeg < 90) {
            $mcDeg = $mcDeg;
        } elseif ($ramcDeg > 90 && $ramcDeg < 270) {
            $mcDeg += 180;
        } else {
            $mcDeg += 360;
        }
        $mcDeg -= $ayanamshaValue;
        
        return $mcDeg < 0 ? $mcDeg + 360 : $mcDeg;
    }
}
