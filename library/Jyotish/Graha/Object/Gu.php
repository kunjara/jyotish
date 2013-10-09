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
 * Class of graha Gu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Gu extends \Jyotish\Graha\Graha {
	/**
	 * Title 'guru' in Devanagari transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ga','u','ra','u'
	);
	
	static public $grahaAvatara = 'Vamana';
	static public $grahaDeva = Deva::DEVA_INDRA;
	static public $grahaUnicode = '2643';
	static public $grahaAltName = array
	(
		'Brihaspati',
	);
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_4,
		'degree' => 5
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_10,
		'degree' => 5
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_9,
		'start' => 0,
		'end' => 10
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => Rashi::RASHI_9,
			'start' => 10,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => Rashi::RASHI_12,
			'start' => 0,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 16;
	static public $grahaAgePeriod = array
	(
		'start' => 57,
		'end' => 68
	);
	static public $grahaCharacter = self::CHARACTER_BENEFIC;
	static public $grahaGuna = Guna::GUNA_SATTVA;
	static public $grahaBhuta = Bhuta::BHUTA_AKASH;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA
	);
	static public $grahaRasa = Rasa::RASA_MADHURA;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_MEDHA,
	);
	static public $grahaVarna = Manusha::VARNA_BRAHMANA;
	static public $grahaGender = Manusha::GENDER_MALE;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => 1,
		self::GRAHA_GU => null,
		self::GRAHA_SK => -1,
		self::GRAHA_BU => -1,
		self::GRAHA_MA => 1,
		self::GRAHA_SA => 0,
	);
	static public $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 0.25,
		4 => 0.75,
		5 => 1,
		6 => 0,
		7 => 1,
		8 => 0.75,
		9 => 1,
		10 => 0.25,
		11 => 0,
		12 => 0,
	);

	public function __construct($options) {
		return $this;
	}

}