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
class Math {
    const M_RAD = 0.01745329251994329577;

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
    static public function dmsToDecimal(array $dms)
    {
        if ( ($dms['d'] < 0) || ($dms['m'] < 0) || (isset($dms['s']) and $dms['s'] < 0) ) 
            $sign = -1;
        else
            $sign = 1;

        return  $sign * ( abs($dms['d']) + abs($dms['m'])/60 + abs(isset($dms['s']) ? $dms['s']/3600 : 0 ));
    }

    /**
     * Finds degrees (hours), minutes and seconds of arc for a given angle.
     * 
     * @param float $decimal
     * @return array
     */
    static public function decimalToDms($decimal)
    {
        $x = abs($decimal);
        $result['d'] = (int)floor($x);
        
        $x = ($x - $result['d']) * 60; 
        $result['m'] = (int)floor($x);
        
        $result['s'] = round(($x - $result['m']) * 60, 10);
        if($result['s'] == 0){
            unset($result['s']);
        }elseif($result['s'] == 60){
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
     * @param float $totalParts
     * @param int $partsInUnit
     * @param string $flagRound
     * @return array
     */
    static public function partsToUnits($totalParts, $partsInUnit = 30, $flagRound = 'ceil')
    {
        if($partsInUnit <= 0){
            throw new Exception\InvalidArgumentException("Parts in unit must be greater than zero.");
        }

        switch ($flagRound) {
            case 'floor':
                $totalUnits	= (int)floor($totalParts / $partsInUnit);
                break;
            case 'ceil':
            default:
                $totalUnits	= (int)ceil($totalParts / $partsInUnit);
                break;
        }

        $restParts	= fmod($totalParts, $partsInUnit);

        return array ('units' => $totalUnits, 'parts' => $restParts);
    }

    /**
     * Calculates the distance in a cycle.
     * 
     * @param int $n1
     * @param int $n2
     * @param int $cycle Size of cycle
     * @return int
     */
    static public function distanceInCycle($n1, $n2, $cycle = 12)
    {
        if($n1 > $cycle or $n2 > $cycle){
            throw new Exception\InvalidArgumentException("Number in cycle should not be greater than size of the cycle $cycle.");
        }
        if($n1 <= $n2){
            $distance = $n2 - $n1 + 1;
        }else{
            $distance = $cycle - ($n1 - $n2) + 1;
        }
        return $distance;
    }

    /**
     * Calculates the number in a cycle.
     * 
     * @param int $n
     * @param int $distance
     * @return int
     */
    static public function numberInCycle($n, $distance = 1, $cycle = 12)
    {
        if($distance == 0){
            throw new Exception\InvalidArgumentException("Distance should not be zero.");
        }
        
        if($distance > 0){
            $distanceCycle = $distance - 1;
        }else{
            $distanceCycle = $distance;
        }
        
        $number = $n + $distanceCycle;
        
        if($number > 0){
            if($number < $cycle) {
                $numberCycle = $number;
            } else {
                $numberCycle = (int)fmod($number, $cycle);
                if($numberCycle == 0) {
                    $numberCycle = $cycle;
                }
            }
        }else{
            if(abs($number) < $cycle){
                $numberCycle = $cycle - abs($number);
            }else{
                $numberCycle = $cycle - (int)fmod(abs($number), $cycle);
            }
        }

        return $numberCycle;
    }

    /**
     * Next number in a cycle.
     * 
     * @param int $n
     * @return int
     */
    static public function numberNext($n, $cycle = 12)
    {
        $nNext    = $n + 1;
        $nInCycle = self::numberInCycle($nNext, 1, $cycle);

        return $nInCycle;
    }

    /**
     * Previous number in a cycle.
     * 
     * @param int $n
     * @return int
     */
    static public function numberPrev($n, $cycle = 12)
    {
        $nPrev    = $n - 1;
        $nInCycle = self::numberInCycle($nPrev, 1, $cycle);

        return $nInCycle;
    }
    
    /**
     * Return sign of number.
     * 
     * @param mixed $number
     * @return int
     */
    static public function sign($number)
    { 
        return $number > 0 ? 1 : ($number < 0 ? -1 : 0); 
    } 

    /**
     * Sum of arrays.
     * 
     * @return array
     */
    static public function arraySum()
    {
        $arrNum  = func_num_args();
        $arrList = func_get_args();

        $array = array();

        for ($i = 0; $i < $arrNum; $i++) {
            $arr = $arrList[$i];
            if(!is_array($arr)){
                throw new Exception\InvalidArgumentException("Argument of function should be an array.");
            }

            foreach($arr as $key => $value) {
                if(array_key_exists($key, $array)) {
                    $sum = $arr[$key] + $array[$key];

                    $array[$key] = $sum;
                }else{
                    $array[$key] = $arr[$key];
                }
            }
        }
        return $array;
    }

    /**
     * Sum of two values of arc angular degrees (hours), minutes and seconds.
     * 
     * @param array $dms1
     * @param array $dms2
     * @return array
     */
    static public function dmsSum(array $dms1, array $dms2)
    {
        $result = array('d' => 0, 'm' => 0, 's' => 0);

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
     * @param int $factor
     * @return array
     */
    static public function dmsMulti(array $dms, $factor)
    {
        $result = array('d' => 0, 'm' => 0, 's' => 0);

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
    static public function inRange($value, $min, $max)
    {
        if($max <= $min){
            throw new Exception\InvalidArgumentException("The maximum value must be greater than the minimum.");
        }
        
        return ($value >= $min and $value < $max) ? true : false;
    }
}
