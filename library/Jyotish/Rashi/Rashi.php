<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi;

use Jyotish\Service\Utils;

/**
 * Class with Rashi names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Rashi {
	const RASHI_1 = 1;
	const RASHI_2 = 2;
	const RASHI_3 = 3;
	const RASHI_4 = 4;
	const RASHI_5 = 5;
	const RASHI_6 = 6;
	const RASHI_7 = 7;
	const RASHI_8 = 8;
	const RASHI_9 = 9;
	const RASHI_10 = 10;
	const RASHI_11 = 11;
	const RASHI_12 = 12;
	
	const BHAVA_CHARA = 'chara';
	const BHAVA_STHIRA = 'sthira';
	const BHAVA_DVISVA = 'dvisva';

	/**
	 * Array of all rashis.
	 * 
     * @var array 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
     */
	static public $RASHI = array(
		self::RASHI_1 => 'Mesha',
		self::RASHI_2 => 'Vrishabha',
		self::RASHI_3 => 'Mithuna',
		self::RASHI_4 => 'Karka',
		self::RASHI_5 => 'Simha',
		self::RASHI_6 => 'Kanya',
		self::RASHI_7 => 'Tula',
		self::RASHI_8 => 'Vrishchika',
		self::RASHI_9 => 'Dhanu',
		self::RASHI_10 => 'Makara',
		self::RASHI_11 => 'Kumbha',
		self::RASHI_12 => 'Meena',
	);
	
	/**
	 * Devanagari title 'rashi' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'ra','aa','sha','i'
	);
	
	/**
	 * Unicode of rashi.
	 * 
	 * @var string
	 */
	static public $rashiUnicode;
	
	/**
	 * Bhava of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	static public $rashiBhava;
	
	/**
	 * Bhuta of rashi.
	 * 
	 * @var string
	 */
	static public $rashiBhuta;
	
	/**
	 * Gender of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	static public $rashiGender;
	
	/**
	 * Limb of Kaal Purush.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
	 */
	static public $rashiLimb;
	
	/**
	 * Prakriti of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	static public $rashiPrakriti;

	static public function getInstance($number, $options = null) {
		if (array_key_exists($number, self::$RASHI)) {
			$rashiClass = 'Jyotish\\Rashi\\Object\\R' . $number;
			$rashiObject = new $rashiClass($options);

			return $rashiObject;
		} else {
			throw new Exception\InvalidArgumentException("Rashi with the number '$number' does not exist.");
		}
	}
	
	static public function nextRashi($rashi) {
		$rashiIncrement = $rashi + 1;
		$rashiZodiac = self::inZodiacRashi($rashiIncrement);
		
		return $rashiZodiac;
	}
	
	static public function inZodiacRashi($rashi, $step = 1) {
		$rashiStep = $rashi + ($step - 1);
		
		if($rashiStep < 12) {
			$rashiZodiac = $rashiStep;
		} else {
			$rashiZodiac = fmod($rashiStep, 12);
			if($rashiZodiac == 0) {
				$rashiZodiac = 12;
			}
		}
		
		return $rashiZodiac;
	}

}