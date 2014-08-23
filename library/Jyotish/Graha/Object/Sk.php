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
 * Class of graha Sk.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sk extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'shukra' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'sha','u','ka','virama','ra'
	);
	
	protected $grahaAvatara = 'Parashurama';
	protected $grahaUnicode = '2640';
	protected $grahaAltName = array
	();
	
	protected $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => 7,
			'start' => 15,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 2,
			'start' => 0,
			'end' => 30
		)
	);
	protected $grahaAgeMaturity = 25;
	protected $grahaAgePeriod = array
	(
		'start' => 15,
		'end' => 22
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	protected $grahaCharacter = self::CHARACTER_BENEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	protected $grahaDeva = Deva::DEVA_SHACHI;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	protected $grahaGender = Manusha::GENDER_FEMALE;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	protected $grahaBhuta = Bhuta::BHUTA_JALA;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	protected $grahaVarna = Manusha::VARNA_BRAHMANA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	protected $grahaGuna = Guna::GUNA_RAJA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	protected $grahaDhatu = array
	(
		Dhatu::DHATU_SHUKRA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	protected $grahaRasa = Rasa::RASA_AMLA;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 12,
		'degree' => 27
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 6,
		'degree' => 27
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	protected $grahaMooltrikon = array
	(
		'rashi' => 7,
		'start' => 0,
		'end' => 15
	);
	
	/**
	 * Natural relationships.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	protected $grahaRelation = array
	(
		self::GRAHA_SY => -1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => null,
		self::GRAHA_BU => 1,
		self::GRAHA_MA => 0,
		self::GRAHA_SA => 1,
	);
	
	protected $grahaDisha = Disha::DISHA_AGNEYA;
	protected $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_VATA
	);
	
	protected $grahaDrishti = array
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