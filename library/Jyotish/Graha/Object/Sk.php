<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Tattva\Maha\Bhuta;
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
	static public $grahaTranslit = array(
		 'sha','u','ka','virama','ra'
	);
	
	static public $grahaAvatara = 'Parashurama';
	static public $grahaDeva = Deva::DEVA_SHACHI;
	static public $grahaUnicode = '2640';
	static public $grahaAltName = array
	();
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_12,
		'degree' => 27
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_6,
		'degree' => 27
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_7,
		'start' => 0,
		'end' => 15
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => Rashi::RASHI_7,
			'start' => 15,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => Rashi::RASHI_2,
			'start' => 0,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 25;
	static public $grahaAgePeriod = array
	(
		'start' => 15,
		'end' => 22
	);
	static public $grahaCharacter = self::CHARACTER_BENEFIC;
	static public $grahaGuna = Guna::GUNA_RAJA;
	static public $grahaBhuta = Bhuta::BHUTA_JALA;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_VATA
	);
	static public $grahaRasa = Rasa::RASA_AMLA;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_SHUKRA,
	);
	static public $grahaVarna = Manusha::VARNA_BRAHMANA;
	static public $grahaGender = Manusha::GENDER_FEMALE;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => -1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => null,
		self::GRAHA_BU => 1,
		self::GRAHA_MA => 0,
		self::GRAHA_SA => 1,
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

	public function __construct($options) {
		return $this;
	}

}