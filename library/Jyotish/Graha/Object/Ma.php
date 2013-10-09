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
 * Class of graha Ma.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ma extends \Jyotish\Graha\Graha {
	/**
	 * Title 'mangala' in Devanagari transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ma','anusvara','ga','la'
	);
	
	static public $grahaAvatara = 'Narasimha';
	static public $grahaDeva = Deva::DEVA_KARTTIKEYA;
	static public $grahaUnicode = '2642';
	static public $grahaAltName = array
	(
		'Kuja',
	);
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_10,
		'degree' => 28
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_4,
		'degree' => 28
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_1,
		'start' => 0,
		'end' => 12
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => Rashi::RASHI_1,
			'start' => 12,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => Rashi::RASHI_8,
			'start' => 0,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 28;
	static public $grahaAgePeriod = array
	(
		'start' => 42,
		'end' => 56
	);
	static public $grahaCharacter = self::CHARACTER_MALEFIC;
	static public $grahaGuna = Guna::GUNA_TAMA;
	static public $grahaBhuta = Bhuta::BHUTA_AGNI;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_PITTA
	);
	static public $grahaRasa = Rasa::RASA_KATU;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_MAMSA,
		Dhatu::DHATU_MAJA,
	);
	static public $grahaVarna = Manusha::VARNA_KSHATRIYA;
	static public $grahaGender = Manusha::GENDER_MALE;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => 1,
		self::GRAHA_GU => 1,
		self::GRAHA_SK => 0,
		self::GRAHA_BU => -1,
		self::GRAHA_MA => null,
		self::GRAHA_SA => 0,
	);
	static public $grahaDrishti = array
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