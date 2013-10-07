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
	static public function dmsToDecimal($d, $m, $s = 0)
	{
	  if ( ($d<0) || ($m<0) || ($s<0) ) 
		  $sign = -1;
	  else
		  $sign = 1;

	  return  $sign * ( abs($d) + abs($m)/60 + abs($s)/3600 );
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
}
