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
 * Class of graha Ke.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ke extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'ketu' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ka','e','ta','u'
	);
	
	static public $grahaAvatara = 'Matsya';
	static public $grahaUnicode = '260B';
	static public $grahaAltName = array
	();
	
	static public $grahaOwn = array
	(
		'rashi' => 1,
		'start' => 0,
		'end' => 30
	);
	static public $grahaAgeMaturity = 48;
	static public $grahaAgePeriod = array
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
	static public $grahaCharacter = self::CHARACTER_MALEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaDeva = null;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaBhuta = null;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaVarna = Manusha::VARNA_MLECHHA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaGuna = Guna::GUNA_TAMA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaDhatu = null;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 */
	static public $grahaRasa = null;
	
	/**
	 * Graha exaltation
	 * 
	 * @var array
	 */
	static public $grahaExaltation = array
	(
		'rashi' => 9,
		'degree' => null
	);
	
	/**
	 * Graha debilitation
	 * 
	 * @var array
	 */
	static public $grahaDebilitation = array
	(
		'rashi' => 3,
		'degree' => null
	);
	
	/**
	 * Graha mooltrikon
	 * 
	 * @var array
	 */
	static public $grahaMooltrikon = array
	(
		'rashi' => null,
	);
	
	/**
	 * Natural relationships
	 * 
	 * @var array
	 */
	static public $grahaRelation = null;
	
	static public $grahaDisha = Disha::DISHA_NAIRUTYA;
	static public $grahaPrakriti = null;
	static public $grahaDrishti = null;

	public function __construct($options) {
		return $this;
	}

}