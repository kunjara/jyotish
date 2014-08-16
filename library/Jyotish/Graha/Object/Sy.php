<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Tattva\Maha\Bhuta;
use Jyotish\Tattva\Maha\Disha;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Ayurveda\Dhatu;
use Jyotish\Tattva\Ayurveda\Prakriti;
use Jyotish\Tattva\Ayurveda\Rasa;

/**
 * Class of graha Sy.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sy extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'surya' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'sa','uu','ra','virama','ya'
	);

	static public $grahaAvatara = 'Rama';
	static public $grahaUnicode = '2609';
	static public $grahaAltName = array
	(
		'Mitra',
		'Ravi',
		'Vivasvan',
	);
	
	static public $grahaOwn = array
	(
		'rashi' => 5,
		'start' => 20,
		'end' => 30
	);
	static public $grahaAgeMaturity = 22;
	static public $grahaAgePeriod = array
	(
		'start' => 23,
		'end' => 41
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	static public $grahaCharacter = self::CHARACTER_MALEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	static public $grahaDeva = Deva::DEVA_AGNI;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	static public $grahaGender = Manusha::GENDER_MALE;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaBhuta = Bhuta::BHUTA_AGNI;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	static public $grahaVarna = Manusha::VARNA_KSHATRIYA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	static public $grahaGuna = Guna::GUNA_SATTVA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_ASTHI,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	static public $grahaRasa = Rasa::RASA_TIKTA;
	
	/**
	 * Graha exaltation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaExaltation = array
	(
		'rashi' => 1,
		'degree' => 10
	);
	
	/**
	 * Graha debilitation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaDebilitation = array
	(
		'rashi' => 7,
		'degree' => 10
	);
	
	/**
	 * Graha mooltrikon
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	static public $grahaMooltrikon = array
		(
		'rashi' => 5,
		'start' => 0,
		'end' => 20
	);
	
	/**
	 * Natural relationships
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	static public $grahaRelation = array
	(
		self::GRAHA_SY => null,
		self::GRAHA_CH => 1,
		self::GRAHA_GU => 1,
		self::GRAHA_SK => -1,
		self::GRAHA_BU => 0,
		self::GRAHA_MA => 1,
		self::GRAHA_SA => -1,
	);
	
	static public $grahaDisha = Disha::DISHA_PURVA;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_PITTA,
	);
	
	static public $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 0.25,
		4 => 0.75,
		5 => 0.5,
		6 => 0,
		7 => 1,
		8 => 0.75,
		9 => 0.5,
		10 => 0.25,
		11 => 0,
		12 => 0,
	);

	public function __construct($options) {
		return $this;
	}

}