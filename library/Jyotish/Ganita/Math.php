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
	 * Greek alphabet
	 */
	const GREEK_ALPHA	= 'alpha';
	const GREEK_BETA	= 'beta';
	const GREEK_GAMMA	= 'gamma';
	const GREEK_DELTA	= 'delta';
	const GREEK_EPSILON	= 'epsilon';
	const GREEK_ZETA	= 'zeta';
	const GREEK_ETA		= 'eta';
	const GREEK_THETA	= 'theta';
	const GREEK_IOTA	= 'iota';
	const GREEK_KAPPA	= 'kappa';
	const GREEK_LAMBDA	= 'lambda';
	const GREEK_MU		= 'mu';
	const GREEK_NU		= 'nu';
	const GREEK_XI		= 'xi';
	const GREEK_OMICRON = 'omicron';
	const GREEK_PI		= 'pi';
	const GREEK_RHO		= 'rho';
	const GREEK_SIGMA	= 'sigma';
	const GREEK_TAU		= 'tau';
	const GREEK_UPSILON = 'upsilon';
	const GREEK_PHI		= 'phi';
	const GREEK_CHI		= 'chi';
	const GREEK_PSI		= 'psi';
	const GREEK_OMEGA	= 'omega';
	
	/**
	 * Greek uppercase letters unicode.
	 * 
	 * @var array
	 */
	static public $greekUpUnicode = array(
		self::GREEK_ALPHA	=> 'U+0391',
		self::GREEK_BETA	=> 'U+0392',
		self::GREEK_GAMMA	=> 'U+0393',
		self::GREEK_DELTA	=> 'U+0394',
		self::GREEK_EPSILON => 'U+0395',
		self::GREEK_ZETA	=> 'U+0396',
		self::GREEK_ETA		=> 'U+0397',
		self::GREEK_THETA	=> 'U+0398',
		self::GREEK_IOTA	=> 'U+0399',
		self::GREEK_KAPPA	=> 'U+039A',
		self::GREEK_LAMBDA	=> 'U+039B',
		self::GREEK_MU		=> 'U+039C',
		self::GREEK_NU		=> 'U+039D',
		self::GREEK_XI		=> 'U+039E',
		self::GREEK_OMICRON => 'U+039F',
		self::GREEK_PI		=> 'U+03A0',
		self::GREEK_RHO		=> 'U+03A1',
		self::GREEK_SIGMA	=> 'U+03A3',
		self::GREEK_TAU		=> 'U+03A4',
		self::GREEK_UPSILON => 'U+03A5',
		self::GREEK_PHI		=> 'U+03A6',
		self::GREEK_CHI		=> 'U+03A7',
		self::GREEK_PSI		=> 'U+03A8',
		self::GREEK_OMEGA	=> 'U+03A9'
	);

	/**
	 * Greek lowercase letters unicode.
	 * 
	 * @var array
	 */
	static public $greekLowUnicode = array(
		self::GREEK_ALPHA	=> 'U+03B1',
		self::GREEK_BETA	=> 'U+03B2',
		self::GREEK_GAMMA	=> 'U+03B3',
		self::GREEK_DELTA	=> 'U+03B4',
		self::GREEK_EPSILON => 'U+03B5',
		self::GREEK_ZETA	=> 'U+03B6',
		self::GREEK_ETA		=> 'U+03B7',
		self::GREEK_THETA	=> 'U+03B8',
		self::GREEK_IOTA	=> 'U+03B9',
		self::GREEK_KAPPA	=> 'U+03BA',
		self::GREEK_LAMBDA	=> 'U+03BB',
		self::GREEK_MU		=> 'U+03BC',
		self::GREEK_NU		=> 'U+03BD',
		self::GREEK_XI		=> 'U+03BE',
		self::GREEK_OMICRON => 'U+03BF',
		self::GREEK_PI		=> 'U+03C0',
		self::GREEK_RHO		=> 'U+03C1',
		self::GREEK_SIGMA	=> 'U+03C3',
		self::GREEK_TAU		=> 'U+03C4',
		self::GREEK_UPSILON => 'U+03C5',
		self::GREEK_PHI		=> 'U+03C6',
		self::GREEK_CHI		=> 'U+03C7',
		self::GREEK_PSI		=> 'U+03C8',
		self::GREEK_OMEGA	=> 'U+03C9'
	);

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
