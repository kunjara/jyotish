<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

/**
 * Mathematical constants and functions for Jyotish 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Math
{
    const M_RAD = M_PI / 180;

    /**
     * Conversion of angular degrees (hours), minutes and seconds of arc to 
     * decimal representation of an angle.
     * 
     * @param array $dms Array of values: d - degrees, m - minutes, s - seconds.
     * For example, 
     * <pre>
     * ['d' => 30, 'm' => 20, 's' => 10]
     * </pre>
     * @return float
     */
    public static function dmsToDecimal(array $dms)
    {
        if (($dms['d'] < 0) || ($dms['m'] < 0) || (isset($dms['s']) && $dms['s'] < 0)) 
            $sign = -1;
        else
            $sign = 1;

        return  $sign * (abs($dms['d']) + abs($dms['m'])/60 + abs(isset($dms['s']) ? $dms['s']/3600 : 0));
    }

    /**
     * Finds degrees (hours), minutes and seconds of arc for a given angle.
     * 
     * @param float $decimal Decimal value of the arc in degrees
     * @return array
     */
    public static function decimalToDms($decimal)
    {
        $x = abs($decimal);
        $result['d'] = (int) floor($x);
        
        $x = ($x - $result['d']) * 60; 
        $result['m'] = (int) floor($x);
        
        $result['s'] = round(($x - $result['m']) * 60, 10);
        if ($result['s'] == 0) {
            unset($result['s']);
        } elseif ($result['s'] == 60) {
            $result['m'] += 1;
            unset($result['s']);
        }

        if ($decimal < 0) {
            if ($result['d'] != 0) $result['d'] *= -1; 
            else if ($result['m'] != 0) $result['m'] *= -1; 
            else $result['s'] *= -1; 
        }

        return $result;
    }

    /**
     * Finds unints and parts from total parts. 
     * 
     * @param float $totalParts Initial value
     * @param int $partsInUnit Number of parts in the unit
     * @param string $flagRound Rounding flag
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public static function partsToUnits($totalParts, $partsInUnit = 30, $flagRound = 'ceil')
    {
        if ($partsInUnit <= 0) {
            throw new Exception\InvalidArgumentException("Parts in unit must be greater than zero.");
        }

        switch ($flagRound) {
            case 'floor':
                $totalUnits	= (int) floor($totalParts / $partsInUnit);
                break;
            case 'ceil':
            default:
                $totalUnits	= (int) ceil($totalParts / $partsInUnit);
                break;
        }

        $restParts	= fmod($totalParts, $partsInUnit);

        return array ('units' => $totalUnits, 'parts' => $restParts);
    }

    /**
     * Calculates the distance in a cycle.
     * 
     * @param int $n1 First position
     * @param int $n2 Second position
     * @param int $cycle Size of cycle
     * @return int
     * @throws Exception\InvalidArgumentException
     */
    public static function distanceInCycle($n1, $n2, $cycle = 12)
    {
        if ($n1 > $cycle || $n2 > $cycle) {
            throw new Exception\InvalidArgumentException("Number in cycle should not be greater than size of the cycle $cycle.");
        }
        if ($n1 <= $n2) {
            $distance = $n2 - $n1 + 1;
        } else {
            $distance = $cycle - ($n1 - $n2) + 1;
        }
        return $distance;
    }

    /**
     * Calculates the number in a cycle.
     * 
     * @param int $n Initial position
     * @param int $distance Distance between the positions
     * @param int $cycle Size of cycle
     * @return int
     * @throws Exception\InvalidArgumentException
     */
    public static function numberInCycle($n, $distance = 1, $cycle = 12)
    {
        if ($distance == 0) {
            throw new Exception\InvalidArgumentException("Distance should not be zero.");
        }
        
        if ($distance > 0) {
            $distanceCycle = $distance - 1;
        } else {
            $distanceCycle = $distance + 1;
        }
        
        $number = $n + $distanceCycle;
        
        if ($number > 0) {
            if ($number < $cycle) {
                $numberCycle = $number;
            } else {
                $numberCycle = (int) fmod($number, $cycle);
                if ($numberCycle == 0) {
                    $numberCycle = $cycle;
                }
            }
        } else {
            if (abs($number) < $cycle) {
                $numberCycle = $cycle - abs($number);
            } else {
                $numberCycle = $cycle - (int) fmod(abs($number), $cycle);
            }
        }

        return $numberCycle;
    }

    /**
     * Next number in a cycle.
     * 
     * @param int $n Initial position
     * @param int $cycle Size of cycle
     * @return int
     */
    public static function numberNext($n, $cycle = 12)
    {
        $nNext    = $n + 1;
        $nInCycle = self::numberInCycle($nNext, 1, $cycle);

        return $nInCycle;
    }

    /**
     * Previous number in a cycle.
     * 
     * @param int $n Initial position
     * @param int $cycle Size of cycle
     * @return int
     */
    public static function numberPrev($n, $cycle = 12)
    {
        $nPrev    = $n - 1;
        $nInCycle = self::numberInCycle($nPrev, 1, $cycle);

        return $nInCycle;
    }
    
    /**
     * Return sign of number.
     * 
     * @param mixed $number Test number
     * @param bool $returnInt Return integer (-1, 0, 1) or sign ('-', '', '+')
     * @return int|string
     */
    public static function sign($number, $returnInt = true)
    {
        if ($returnInt) {
            $sign = $number > 0 ? 1 : ($number < 0 ? -1 : 0);
        } else {
            $sign = $number > 0 ? '+' : ($number < 0 ? '-' : '');
        }
        
        return $sign;
    }

    /**
     * Sum of arrays.
     * 
     * @param array List of arrays
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public static function arraySum(array ...$arrays)
    {
        $array = [];
        foreach ($arrays as $arr) {
            foreach ($arr as $key => $value) {
                if (array_key_exists($key, $array)) {
                    $array[$key] += $arr[$key];
                } else {
                    $array[$key] = $arr[$key];
                }
            }
        }
        return $array;
    }
    
    /**
     * Checks if a values of array1 exists in an array2.
     * 
     * @param array $array1
     * @param array $array2
     * @param bool $strict
     * @return bool
     */
    public static function arrayInArray(array $array1, array $array2, $strict = false)
    {
        $result = array_intersect($array1, $array2);
        
        if ($strict) {
            return count($result) == count($array1);
        } else {
            return count($result) >= 1 ? true : false;
        }    
    }
    
    /**
     * Shift to the right array key
     * 
     * @param array $array
     * @param string|int $startKey
     * @return array
     */ 
    public static function shiftArray(array $array, $startKey) {
        reset($array);
        $tab = 0;

        while (key($array) != $startKey) {
            $tab++;
            next($array);

            if ($tab > count($array)) {
                return $array;
            }
        }

        $result = array_slice($array, $tab, null, true) + array_slice($array, 0, $tab, true);

        return $result;
    }

    /**
     * Sum of two values of arc angular degrees (hours), minutes and seconds.
     * 
     * @param array $dms1
     * @param array $dms2
     * @return array
     */
    public static function dmsSum(array $dms1, array $dms2)
    {
        $result = ['d' => 0, 'm' => 0, 's' => 0];

        $ssUnits = self::partsToUnits($dms1['s'] + $dms2['s'], 60, 'floor');
        $result['s'] = $ssUnits['parts'];
        $mmUnits = self::partsToUnits($dms1['m'] + $dms2['m'] + $ssUnits['units'], 60, 'floor');
        $result['m'] = $mmUnits['parts'];

        $result['d'] = $dms1['d'] + $dms2['d'] + $mmUnits['units'];

        return $result;
    }

    /**
     * Multiplication value of arc.
     * 
     * @param array $dms
     * @param int|float $factor
     * @return array
     */
    public static function dmsMulti(array $dms, $factor)
    {
        $result = ['d' => 0, 'm' => 0, 's' => 0];

        $ssUnits = self::partsToUnits($dms['s'] * $factor, 60, 'floor');
        $result['s'] = $ssUnits['parts'];
        $mmUnits = self::partsToUnits($dms['m'] * $factor + $ssUnits['units'], 60, 'floor');
        $result['m'] = $mmUnits['parts'];

        $result['d'] = $dms['d'] * $factor + $mmUnits['units'];

        return $result;
    }
    
    /**
     * Check the value in range.
     * 
     * @param mixed $value The value to test
     * @param mixed $min The minimum value in the range
     * @param mixed $max The maximum value in the range
     * @return boolean
     * @throws Exception\InvalidArgumentException
     */
    public static function inRange($value, $min, $max)
    {
        if ($max <= $min) {
            throw new Exception\InvalidArgumentException("The maximum value must be greater than the minimum.");
        }
        
        return ($value >= $min && $value < $max) ? true : false;
    }
    
    /**
     * Get opposite value.
     * 
     * @param float $value Initial value
     * @param int $cycle Size of cycle
     * @return float
     */
    public static function oppositeValue($value, $cycle = 12)
    {
        $oppositeValue = $value + $cycle / 2;
        $result = $oppositeValue >= $cycle ? $oppositeValue - $cycle : $oppositeValue;

        return $result;
    }
    
    /**
     * Simplify the number.
     * 
     * @param int $number
     * @return int
     */
    public static function simplifyNumber($number)
    {
        $i = 0;
        
        if ($number <= 9) {
            return $number;
        } else {
            $numString = strval($number);
            $num = 0;
            while (isset($numString[$i])) {
                $num += $numString[$i];
                $i += 1;
            }
            return self::simplifyNumber($num);
        }
    }
}