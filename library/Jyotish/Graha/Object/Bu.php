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
 * Class of graha Bu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaAbbr = 'Bu';
	
	/**
	 * Devanagari title 'budha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'ba','u','dha'
	);
	
	protected $grahaAvatara = 'Budda';
	protected $grahaUnicode = '263F';
	protected $grahaAltName = array
	();
	
	protected $grahaOwn = array
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
	protected $grahaAgeMaturity = 32;
	protected $grahaAgePeriod = array
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
	protected $grahaCharacter = Graha::CHARACTER_BENEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	protected $grahaDeva = Deva::DEVA_VISHNU_MAHA;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	protected $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	protected $grahaBhuta = Bhuta::BHUTA_PRITVI;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	protected $grahaVarna = Manusha::VARNA_VAISHYA;
	
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
		Dhatu::DHATU_RASA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	protected $grahaRasa = Rasa::RASA_MISHRA;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 6,
		'degree' => 15
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50. 
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 12,
		'degree' => 15
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54. 
	 */
	protected $grahaMooltrikon = array
	(
		'rashi' => 6,
		'start' => 15,
		'end' => 20
	);
	
	/**
	 * Natural relationships.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55. 
	 */
	protected $grahaRelation = array
	(
		Graha::GRAHA_SY => 1,
		Graha::GRAHA_CH => -1,
		Graha::GRAHA_GU => 0,
		Graha::GRAHA_SK => 1,
		Graha::GRAHA_BU => null,
		Graha::GRAHA_MA => 0,
		Graha::GRAHA_SA => 0,
	);
	
	protected $grahaDisha = Disha::DISHA_UTTARA;
	protected $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_PITTA,
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
		if(!is_null($options)) {
			$this->grahaCharacter = 'null';
		} else {
			$this->grahaCharacter = Graha::CHARACTER_BENEFIC;
		}
		return $this;
	}

}