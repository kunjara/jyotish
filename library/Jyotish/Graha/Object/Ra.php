<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Tattva\Maha\Disha;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Jiva\Manusha;

/**
 * Class of graha Ra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ra extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'rahu' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'ra','aa','ha','u'
	);
	
	protected $grahaAvatara = 'Varaha';
	protected $grahaUnicode = '260A';
	protected $grahaAltName = array
	();
	
	protected $grahaOwn = array
	(
		'rashi' => 11,
		'start' => 0,
		'end' => 30
	);
	protected $grahaAgeMaturity = 48;
	protected $grahaAgePeriod = array
	(
		'start' => 69,
		'end' => 108
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
	 */
	protected $grahaDeva = null;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaBhuta = null;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaVarna = Manusha::VARNA_MLECHHA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaGuna = Guna::GUNA_TAMA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaDhatu = null;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaRasa = null;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 3,
		'degree' => null
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 9,
		'degree' => null
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 */
	protected $grahaMooltrikon = array
	(
		'rashi' => 11,
		'degree' => null
	);
	
	/**
	 * Natural relationships.
	 * 
	 * @var array
	 */
	protected $grahaRelation = array
	(
		self::GRAHA_SY => -1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 1,
		self::GRAHA_SK => 1,
		self::GRAHA_BU => 0,
		self::GRAHA_MA => -1,
		self::GRAHA_SA => 1,
	);
	
	protected $grahaDisha = Disha::DISHA_NAIRUTYA;
	protected $grahaPrakriti = null;
	protected $grahaDrishti = null;

	public function __construct($options) {
		return $this;
	}

}