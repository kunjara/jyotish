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
 * Class of graha Sa.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sa extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'shani' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'sha','na','i'
	);
	
	static public $grahaAvatara = 'Kurma';
	static public $grahaDeva = Deva::DEVA_BRAHMA;
	static public $grahaUnicode = '2644';
	static public $grahaAltName = array
	();
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_7,
		'degree' => 20
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_1,
		'degree' => 20
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_11,
		'start' => 0,
		'end' => 20
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => Rashi::RASHI_11,
			'start' => 20,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => Rashi::RASHI_10,
			'start' => 0,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 36;
	static public $grahaAgePeriod = array
	(
		'start' => 69,
		'end' => 108
	);
	static public $grahaCharacter = self::CHARACTER_MALEFIC;
	static public $grahaGuna = Guna::GUNA_TAMA;
	static public $grahaBhuta = Bhuta::BHUTA_VAYU;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_VATA
	);
	static public $grahaRasa = Rasa::RASA_KASHAYA;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_MAJA,
	);
	static public $grahaVarna = Manusha::VARNA_SHUDRA;
	static public $grahaGender = Manusha::GENDER_NEUTER;
	static public $grahaDisha = Disha::DISHA_PASCHIMA;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => -1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => 1,
		self::GRAHA_BU => 1,
		self::GRAHA_MA => -1,
		self::GRAHA_SA => null,
	);
	static public $grahaDrishti = array
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

	public function __construct($options) {
		return $this;
	}

}