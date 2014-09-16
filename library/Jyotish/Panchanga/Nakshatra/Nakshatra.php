<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra;

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
	
	const YONI_HORSE = 'horse';
	const YONI_ELEPHANT = 'elephant';
	const YONI_SHEEP = 'sheep';
	const YONI_SERPENT = 'serpent';
	const YONI_DOG = 'dog';
	const YONI_CAT = 'cat';
	const YONI_RAT = 'rat';
	const YONI_COW = 'cow';
	const YONI_BUFFALO = 'buffalo';
	const YONI_TIGER = 'tiger';
	const YONI_HARE = 'hare';
	const YONI_MONKEY = 'monkey';
	const YONI_LION = 'lion';
	const YONI_MONGOOSE = 'mongoose';

	/**
	 * Array of all nakshatras.
	 * 
	 * @var array 
	 */
	static public $nakshatra = array(
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
	 * Array of navatara (nine stars).
	 * 
	 * @var array 
	 */
	static public $navatara = array(
		1 => 'Janma',
		2 => 'Sampat',
		3 => 'Vipat',
		4 => 'Kshema',
		5 => 'Pratyak',
		6 => 'Saadhana',
		7 => 'Naidhana',
		8 => 'Mitra',
		9 => 'Atimitra'
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
	

	/**
	 * Returns the requested instance of nakshatra class.
	 * 
	 * @param int $key The number of nakshatra
	 * @param array $options
	 * @return the requested instance of nakshatra class
	 */
	static public function getInstance($key, array $options = null)
	{
		if (!array_key_exists($key, self::$nakshatra)) {
			throw new Exception\InvalidArgumentException("Nakshatra with the number '$key' does not exist.");
		}
		
		$nakshatraClass = 'Jyotish\\Panchanga\\Nakshatra\\Object\\N' . $key;
		$nakshatraObject = new $nakshatraClass($options);
		
		return $nakshatraObject;
	}
	
	/**
	 * Returns the list of nakshatras.
	 * 
	 * @param type $withAbhijit
	 * @return array
	 */
	static public function nakshatraList($withAbhijit = false)
	{
		$nakshatras = self::$nakshatra;
		
		if($withAbhijit){
			$result = 
				array_slice($nakshatras, 0, 21, true) +
				array_slice($nakshatras, -1, 1, true) + 
				array_slice($nakshatras, 21, 6, true); 
		}else{
			unset($nakshatras[28]);
			$result = $nakshatras;
		}
		return $result;
	}
	
}