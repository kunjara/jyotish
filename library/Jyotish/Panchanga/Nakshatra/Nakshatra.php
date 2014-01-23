<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra;

use Jyotish\Ganita\Math;

/**
 * Class with Nakshatra names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Nakshatra {
	
	const PADA_1 = 1;
	const PADA_2 = 2;
	const PADA_3 = 3;
	const PADA_4 = 4;
	
	const TYPE_DHRUVA = 'dhruva';
	const TYPE_CHARANA = 'charana';
	const TYPE_TIKSHNA = 'tikshna';
	const TYPE_MRIDU = 'mridu';
	const TYPE_SADHARANA = 'sadharana';
	const TYPE_UGRA = 'ugra';
	const TYPE_KSHIPRA = 'kshipra';
	
	const ENERGY_SRISHTI = 'srishti';
	const ENERGY_STHITI = 'sthiti';
	const ENERGY_LAYA = 'laya';

	static public $NAKSHATRA = array(
		1 => 'Ashwini',
		2 => 'Bharani',
		3 => 'Krittika',
		4 => 'Rohini',
		5 => 'Mrigashirsha',
		6 => 'Ardra',
		7 => 'Punarvasu',
		8 => 'Pushya',
		9 => 'Ashlesha',
		10 => 'Magha',
		11 => 'Poorva Phalguni',
		12 => 'Uttara Phalguni',
		13 => 'Hasta',
		14 => 'Chitra',
		15 => 'Swati',
		16 => 'Vishakha',
		17 => 'Anuradha',
		18 => 'Jyeshtha',
		19 => 'Moola',
		20 => 'Purva Ashadha',
		21 => 'Uttara Ashadha',
		22 => 'Shravana',
		23 => 'Dhanishta',
		24 => 'Shatabhisha',
		25 => 'Purva Bhadrapada',
		26 => 'Uttara Bhadrapada',
		27 => 'Revati',
		28 => 'Abhijit'
	);
	
	/**
	 * Devanagari title 'nakshatra' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'na','ka','virama','ssa','ta','virama','ra'
	);
	
	static public $nakshatraArc = array(
		'd' => 13,
		'm' => 20,
		's' => 0
	);
	static public $nakshatraStart;
	static public $nakshatraEnd;
	
	static public $nakshatraTranslit;
	static public $nakshatraDeva;
	static public $nakshatraEnergy;
	static public $nakshatraGana;
	static public $nakshatraGender;
	static public $nakshatraGraha;
	static public $nakshatraGuna;
	static public $nakshatraPurushartha;
	static public $nakshatraType;
	static public $nakshatraVarna;

	static public function getInstance($number, $options = null)
	{
		if (!array_key_exists($number, self::$NAKSHATRA)) {
			throw new Exception\InvalidArgumentException("Nakshatra with the number '$number' does not exist.");
		}
		
		$nakshatraClass = 'Jyotish\\Panchanga\\Nakshatra\\Object\\N' . $number;
		$nakshatraObject = new $nakshatraClass($options);
		
		if($number == 28){
			self::$nakshatraStart = array('d' => 276, 'm' => 40);
			self::$nakshatraEnd = array('d' => 280, 'm' => 53, 's' => 20);
		}else{
			self::$nakshatraStart = Math::dmsMulti(self::$nakshatraArc, $number - 1);
			self::$nakshatraEnd = Math::dmsSum(self::$nakshatraStart, self::$nakshatraArc);
		}
		
		return $nakshatraObject;
	}
	
}