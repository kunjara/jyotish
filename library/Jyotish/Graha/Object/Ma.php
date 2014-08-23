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
 * Class of graha Ma.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ma extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'mangala' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'ma','anusvara','ga','la'
	);
	
	protected $grahaAvatara = 'Narasimha';
	protected $grahaUnicode = '2642';
	protected $grahaAltName = array
	(
		'Kuja',
	);
	
	protected $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => 1,
			'start' => 12,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 8,
			'start' => 0,
			'end' => 30
		)
	);
	protected $grahaAgeMaturity = 28;
	protected $grahaAgePeriod = array
	(
		'start' => 42,
		'end' => 56
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	protected $grahaCharacter = self::CHARACTER_MALEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	protected $grahaDeva = Deva::DEVA_KARTTIKEYA;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	protected $grahaGender = Manusha::GENDER_MALE;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	protected $grahaBhuta = Bhuta::BHUTA_AGNI;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	protected $grahaVarna = Manusha::VARNA_KSHATRIYA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	protected $grahaGuna = Guna::GUNA_TAMA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	protected $grahaDhatu = array
	(
		Dhatu::DHATU_MAMSA,
		Dhatu::DHATU_MAJA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	protected $grahaRasa = Rasa::RASA_KATU;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 10,
		'degree' => 28
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 4,
		'degree' => 28
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	protected $grahaMooltrikon = array
	(
		'rashi' => 1,
		'start' => 0,
		'end' => 12
	);
	
	/**
	 * Natural relationships.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	protected $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => 1,
		self::GRAHA_GU => 1,
		self::GRAHA_SK => 0,
		self::GRAHA_BU => -1,
		self::GRAHA_MA => null,
		self::GRAHA_SA => 0,
	);
	
	protected $grahaDisha = Disha::DISHA_DAKSHINA;
	protected $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_PITTA
	);
	
	protected $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 0.25,
		4 => 1,
		5 => 0.5,
		6 => 0,
		7 => 1,
		8 => 1,
		9 => 0.5,
		10 => 0.25,
		11 => 0,
		12 => 0,
	);

	public function __construct($options) {
		return $this;
	}

}