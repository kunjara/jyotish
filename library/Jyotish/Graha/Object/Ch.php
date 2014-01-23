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
 * Class of graha Ch.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ch extends \Jyotish\Graha\Graha {
	/**
	 * Devanagari title 'chandra' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ca','na','virama','da','virama','ra'
	);
	
	static public $grahaAvatara = 'Krishna';
	static public $grahaDeva = Deva::DEVA_VARUNA;
	static public $grahaUnicode = '263D';
	static public $grahaAltName = array
	(
		'Soma',
	);
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_2,
		'degree' => 3
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_8,
		'degree' => 3
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_2,
		'start' => 3,
		'end' => 30
	);
	static public $grahaOwn = array
	(
		'rashi' => Rashi::RASHI_4,
		'start' => 0,
		'end' => 30
	);
	static public $grahaAgeMaturity = 24;
	static public $grahaAgePeriod = array
	(
		'start' => 0,
		'end' => 4
	);
	static public $grahaCharacter = self::CHARACTER_BENEFIC;
	static public $grahaGuna = Guna::GUNA_SATTVA;
	static public $grahaBhuta = Bhuta::BHUTA_JALA;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_VATA
	);
	static public $grahaRasa = Rasa::RASA_LAVANA;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_RAKTA,
	);
	static public $grahaVarna = Manusha::VARNA_VAISHYA;
	static public $grahaGender = Manusha::GENDER_FEMALE;
	static public $grahaDisha = Disha::DISHA_VAYAVYA;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => null,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => 0,
		self::GRAHA_BU => 1,
		self::GRAHA_MA => 0,
		self::GRAHA_SA => 0,
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

	public function __construct($ganitaData) {
		if(!is_null($ganitaData)) {
			self::$grahaCharacter = 'null';
		}
		return $this;
	}

}