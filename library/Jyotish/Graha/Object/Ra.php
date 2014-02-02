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
	static public $grahaTranslit = array(
		 'ra','aa','ha','u'
	);
	
	static public $grahaAvatara = 'Varaha';
	static public $grahaDeva = null;
	static public $grahaUnicode = '260A';
	static public $grahaAltName = array
	();
	static public $grahaExaltation = array
	(
		'rashi' => 3,
		'degree' => null
	);
	static public $grahaDebilitation = array
	(
		'rashi' => 9,
		'degree' => null
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => null,
	);
	static public $grahaOwn = array
	(
		'rashi' => 11,
		'start' => 0,
		'end' => 30
	);
	static public $grahaAgeMaturity = 48;
	static public $grahaAgePeriod = array
	(
		'start' => 69,
		'end' => 108
	);
	static public $grahaCharacter = self::CHARACTER_MALEFIC;
	static public $grahaGuna = Guna::GUNA_TAMA;
	static public $grahaBhuta = null;
	static public $grahaPrakriti = null;
	static public $grahaVarna = Manusha::VARNA_MLECHHA;
	static public $grahaGender = Manusha::GENDER_FEMALE;
	static public $grahaDisha = Disha::DISHA_NAIRUTYA;
	static public $grahaRelation = null;
	static public $grahaDrishti = null;

	public function __construct($options) {
		return $this;
	}

}