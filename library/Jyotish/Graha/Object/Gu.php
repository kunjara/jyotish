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
 * Class of graha Gu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Gu extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'guru' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ga','u','ra','u'
	);
	
	static public $grahaAvatara = 'Vamana';
	static public $grahaUnicode = '2643';
	static public $grahaAltName = array
	(
		'Brihaspati',
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => 9,
			'start' => 10,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 12,
			'start' => 0,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 16;
	static public $grahaAgePeriod = array
	(
		'start' => 57,
		'end' => 68
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	static public $grahaCharacter = self::CHARACTER_BENEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	static public $grahaDeva = Deva::DEVA_INDRA;
	
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
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	static public $grahaBhuta = Bhuta::BHUTA_AKASH;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	static public $grahaVarna = Manusha::VARNA_BRAHMANA;
	
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
		Dhatu::DHATU_MEDHA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	static public $grahaRasa = Rasa::RASA_MADHURA;
	
	/**
	 * Graha exaltation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaExaltation = array
	(
		'rashi' => 4,
		'degree' => 5
	);
	
	/**
	 * Graha debilitation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaDebilitation = array
	(
		'rashi' => 10,
		'degree' => 5
	);
	
	/**
	 * Graha mooltrikon
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	static public $grahaMooltrikon = array
	(
		'rashi' => 9,
		'start' => 0,
		'end' => 10
	);
	
	/**
	 * Natural relationships
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	static public $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => 1,
		self::GRAHA_GU => null,
		self::GRAHA_SK => -1,
		self::GRAHA_BU => -1,
		self::GRAHA_MA => 1,
		self::GRAHA_SA => 0,
	);
	
	static public $grahaDisha = Disha::DISHA_ISHANYA;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA
	);
	
	static public $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 0.25,
		4 => 0.75,
		5 => 1,
		6 => 0,
		7 => 1,
		8 => 0.75,
		9 => 1,
		10 => 0.25,
		11 => 0,
		12 => 0,
	);

	public function __construct($options) {
		return $this;
	}

}