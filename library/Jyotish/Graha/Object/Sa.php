<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Ayurveda;
use Jyotish\Tattva\Kala;

/**
 * Class of graha Sa.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sa extends GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $objectKey = 'Sa';
	
	/**
	 * Unicode of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaUnicode = '2644';
	
	/**
	 * Avatara of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
	 */
	protected $grahaAvatara = 'Kurma';
	
	/**
	 * Main name of the graha.
	 * 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
	 * @var string
	 */
	protected $objectName = 'Shani';
	
	/**
	 * Devanagari title 'shani' in transliteration.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = ['sha','na','i'];
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaCharacter = Graha::CHARACTER_PAPA;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaDeva = Deva::DEVA_BRAHMA;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
	 */
	protected $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
	 */
	protected $grahaBhuta = Maha::BHUTA_VAYU;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
	 */
	protected $grahaVarna = Manusha::VARNA_SHUDRA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
	 */
	protected $grahaGuna = Maha::GUNA_TAMA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
	 */
	protected $grahaDhatu = array
	(
		Ayurveda::DHATU_MAJA,
	);
	
	/**
	 * Kala of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
	 */
	protected $grahaKala = Kala::KALA_VARSHA;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
	 */
	protected $grahaRasa = Ayurveda::RASA_KASHAYA;
	
	/**
	 * Graha basis.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 37.
	 */
	protected $grahaBasis = Maha::BASIS_DHATU;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
	 */
	protected $grahaUcha = array
	(
		'rashi' => 7,
		'degree' => 20
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
	 */
	protected $grahaNeecha = array
	(
		'rashi' => 1,
		'degree' => 20
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
	 */
	protected $grahaMool = array
	(
		'rashi' => 11,
		'start' => 0,
		'end' => 20
	);
	
	/**
	 * Own sign of the graha.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 */
	protected $grahaSwa = array
	(
		'positive' => array
		(
			'rashi' => 11,
			'start' => 20,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 10,
			'start' => 0,
			'end' => 30
		)
	);
	
	/**
	 * Graha disha
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaDisha = Maha::DISHA_PASCHIMA;
	
	/**
	 * Graha drishti
	 * 
	 * @var array
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
	 */
	protected $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 1,
		4 => 0.75,
		5 => 0.5,
		6 => 0,
		7 => 1,
		8 => 0.75,
		9 => 0.5,
		10 => 1,
		11 => 0,
		12 => 0,
	);
	
	/**
	 * Prakriti of graha
	 * 
	 * @var array
	 */
	protected $grahaPrakriti = array
	(
		Ayurveda::PRAKRITI_VATA
	);
	protected $grahaAgeMaturity = 36;
	protected $grahaAgePeriod = array
	(
		'start' => 69,
		'end' => 108
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}