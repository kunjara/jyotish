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
 * Class of graha Bu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'budha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ba','u','dha'
	);
	
	static public $grahaAvatara = 'Budda';
	static public $grahaUnicode = '263F';
	static public $grahaAltName = array
	();
	
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => 3,
			'start' => 0,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 6,
			'start' => 20,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 32;
	static public $grahaAgePeriod = array
	(
		'start' => 5,
		'end' => 14
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
	static public $grahaDeva = Deva::DEVA_VISHNU_MAHA;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	static public $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	static public $grahaBhuta = Bhuta::BHUTA_PRITVI;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	static public $grahaVarna = Manusha::VARNA_VAISHYA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	static public $grahaGuna = Guna::GUNA_RAJA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_RASA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	static public $grahaRasa = Rasa::RASA_MISHRA;
	
	/**
	 * Graha exaltation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaExaltation = array
	(
		'rashi' => 6,
		'degree' => 15
	);
	
	/**
	 * Graha debilitation
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	static public $grahaDebilitation = array
	(
		'rashi' => 12,
		'degree' => 15
	);
	
	/**
	 * Graha mooltrikon
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	static public $grahaMooltrikon = array
	(
		'rashi' => 6,
		'start' => 15,
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
		self::GRAHA_SY => 1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => 1,
		self::GRAHA_BU => null,
		self::GRAHA_MA => 0,
		self::GRAHA_SA => 0,
	);
	
	static public $grahaDisha = Disha::DISHA_UTTARA;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_PITTA,
		Prakriti::PRAKRITI_VATA
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

	public function __construct($ganitaData) {
		if(!is_null($ganitaData)) {
			self::$grahaCharacter = 'null';
		} else {
			self::$grahaCharacter = self::CHARACTER_BENEFIC;
		}
		return $this;
	}

}