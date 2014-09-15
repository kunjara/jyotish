<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
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
class Sy extends GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaAbbr = 'Sy';
	
	/**
	 * Devanagari title 'surya' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'sa','uu','ra','virama','ya'
	);

	protected $grahaAvatara = 'Rama';
	protected $grahaUnicode = '2609';
	protected $grahaAltName = array
	(
		'Mitra',
		'Ravi',
		'Vivasvan',
	);
	
	protected $grahaOwn = array
	(
		'rashi' => 5,
		'start' => 20,
		'end' => 30
	);
	protected $grahaAgeMaturity = 22;
	protected $grahaAgePeriod = array
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
	protected $grahaCharacter = Graha::CHARACTER_MALEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	protected $grahaDeva = Deva::DEVA_AGNI;
	
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
	protected $grahaGuna = Guna::GUNA_SATTVA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	protected $grahaDhatu = array
	(
		Dhatu::DHATU_ASTHI,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	protected $grahaRasa = Rasa::RASA_TIKTA;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 1,
		'degree' => 10
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 7,
		'degree' => 10
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	protected $grahaMooltrikon = array
		(
		'rashi' => 5,
		'start' => 0,
		'end' => 20
	);
	
	protected $grahaDisha = Disha::DISHA_PURVA;
	protected $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_PITTA,
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
		parent::__construct($options);
	}

}