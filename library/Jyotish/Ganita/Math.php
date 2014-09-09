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
	 * Conversion of angular degrees (hours), minutes and seconds of arc to decimal representation of an angle.
	 * 
	 * @param int $d
	 * @param int $m
	 * @param float $s
	 * @return float
	 */
	static public function dmsToDecimal(array $dms)
	{
		if ( ($dms['d'] < 0) || ($dms['m'] < 0) || ($dms['s'] < 0) ) 
			$sign = -1;
		else
			$sign = 1;

		return  $sign * ( abs($dms['d']) + abs($dms['m'])/60 + abs($dms['s'])/3600 );
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
		$result['d'] = floor($x);
		$x = ($x - $result['d']) * 60; 
		$result['m'] = floor($x);  
		$result['s'] = ($x - $result['m']) * 60;

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
	static public function partsToUnits($totalParts, $partsInUnit = 30, $flagRound = 'ceil') {
		if($partsInUnit <= 0){
			throw new Exception\InvalidArgumentException("Parts in unit must be greater than zero.");
		}
		
		switch ($flagRound) {
			case 'floor':
				$totalUnits	= floor($totalParts / $partsInUnit);
				break;
			case 'ceil':
			default:
				$totalUnits	= ceil($totalParts / $partsInUnit);
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
		if($n1 < $n2){
			$dn = $n2 - $n1 + 1;
		}else{
			$dn = $cycle - ($n1 - $n2) + 1;
		}
		return $dn;
	}
	
	/**
	 * Calculates the number in a cycle.
	 * 
	 * @param int $n
	 * @param int $distance
	 * @return int
	 */
	static public function numberInCycle($n, $distance = 1, $cycle = 12) {
		/*
		if(!is_int($n)){
			throw new Exception\InvalidArgumentException("Number of object must be an integer.");
		}
		 */
		$number = $n + ($distance - 1);
		
		if($number < $cycle) {
			$numberCycle = $number;
		} else {
			$numberCycle = fmod($number, $cycle);
			if($numberCycle == 0) {
				$numberCycle = $cycle;
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
	static public function numberNext($n, $cycle = 12) {
		$nNext    = $n + 1;
		$nInCycle = self::numberInCycle($nNext, 1, $cycle);
		
		return $nInCycle;
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
	
}
