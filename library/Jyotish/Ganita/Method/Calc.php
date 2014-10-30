<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use DateTime;
use Jyotish\Ganita\Math;

/**
 * Class to calculate the positions of the planets.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Calc {
    /**
     * Get contra longitude value.
     * 
     * @param float $longitude
     * @return float
     */
    static public function contraLon($longitude)
    {
        $lonContra = $longitude + 180;
        $lonResult = $lonContra >= 360 ? $lonContra - 360 : $lonContra;

        return $lonResult;
    }

    /**
     * Equation of time.
     * 
     * @param string $date
     * @return float
     */
    static public function eot($date)
    {
        $dateObject = new DateTime($date);
        $day = $dateObject->format('z') + 1;

        $B = 360 * ($day - 81) / 365;
        $E = 7.53 * cos($B) + 1.5 * sin($B) - 9.87 * sin(2 * $B);

        return $E;
    }

    /**
     * Get sunrise time.
     * 
     * @param array $data
     * @param array $grahaData
     * @return type
     */
    static public function getRise($data, $grahaData)
    {
        $hourAngle = acos((cos(Math::dmsToDecimal(array('d' => 90, 'm' => 51))) - sin($data['latitude']) * sin($grahaData['declination'])) / cos($data['latitude']) * cos($grahaData['declination']));
        $eot = self::eot($data['date']);

        $time = 12 - $hourAngle + $eot;

        return $time;
    }
}
