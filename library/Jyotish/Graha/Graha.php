<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha {
	const GRAHA_SY = 'Sy';
	const GRAHA_CH = 'Ch';
	const GRAHA_MA = 'Ma';
	const GRAHA_BU = 'Bu';
	const GRAHA_GU = 'Gu';
	const GRAHA_SK = 'Sk';
	const GRAHA_SA = 'Sa';
	const GRAHA_RA = 'Ra';
	const GRAHA_KE = 'Ke';
	
	const LAGNA = 'Lg';
	
	const CHARACTER_BENEFIC = 'benefic';
	const CHARACTER_MALEFIC = 'malefic';
	
	/**
	 * Names of Grahas.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
	 */
	static public $GRAHA = array(
		self::GRAHA_SY => 'Surya',
		self::GRAHA_CH => 'Chandra',
		self::GRAHA_MA => 'Mangala',
		self::GRAHA_BU => 'Budha',
		self::GRAHA_GU => 'Guru',
		self::GRAHA_SK => 'Shukra',
		self::GRAHA_SA => 'Shani',
		self::GRAHA_RA => 'Rahu',
		self::GRAHA_KE => 'Ketu'
	);
	/**
	 * Devanagari title 'graha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'ga','virama','ra','ha'
	);
	static public $grahaTranslit;
	static public $grahaAvatara;
	static public $grahaUnicode;
	static public $grahaAltName = array();
	static public $grahaAgeMaturity;
	static public $grahaAgePeriod = array(
		'start',
		'end'
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	static public $grahaCharacter;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	static public $grahaDeva;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	static public $grahaGender;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	static public $grahaBhuta;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	static public $grahaVarna;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	static public $grahaGuna;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	static public $grahaDhatu;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	static public $grahaRasa;
	
	static public $grahaPrakriti;
	
	/**
	 * Natural relationships
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	static public $grahaRelation = array();
	static public $grahaDrishti = array();

	static public function getInstance($abbr, array $ganitaData = null) {
		if (array_key_exists($abbr, self::$GRAHA)) {
			$grahaClass = 'Jyotish\Graha\Object\\' . $abbr;
			$grahaObject = new $grahaClass($ganitaData);

			return $grahaObject;
		} else {
			throw new Exception\InvalidArgumentException("Graha with the acronym '$abbr' does not exist.");
		}
	}

}