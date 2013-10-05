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
 * Class of graha Bu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends \Jyotish\Graha\Graha {

	static public $grahaAvatara = 'Budda';
	static public $grahaDeva = Deva::DEVA_VISHNU_MAHA;
	static public $grahaUnicode = 'U+263F';
	static public $grahaAltName = array
	();
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_6,
		'degree' => 15
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_12,
		'degree' => 15
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => Rashi::RASHI_6,
		'start' => 15,
		'end' => 20
	);
	static public $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => Rashi::RASHI_3,
			'start' => 0,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => Rashi::RASHI_6,
			'start' => 20,
			'end' => 30
		)
	);
	static public $grahaAgeMaturity = 32;
	static public $grahaAgePeriod = array
	(
		'start' => 5,
		'end' => 14
	);
	static public $grahaCharacter = self::CHARACTER_BENEFIC;
	static public $grahaGuna = Guna::GUNA_RAJA;
	static public $grahaBhuta = Bhuta::BHUTA_PRITVI;
	static public $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_PITTA,
		Prakriti::PRAKRITI_VATA
	);
	static public $grahaRasa = Rasa::RASA_MISHRA;
	static public $grahaDhatu = array
	(
		Dhatu::DHATU_RASA,
	);
	static public $grahaVarna = Manusha::VARNA_VAISHYA;
	static public $grahaGender = Manusha::GENDER_NEUTER;
	static public $grahaRelation = array
	(
		self::GRAHA_SY => 1,
		self::GRAHA_CH => -1,
		self::GRAHA_GU => 0,
		self::GRAHA_SK => 1,
		self::GRAHA_BU => null,
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
		} else {
			self::$grahaCharacter = self::CHARACTER_BENEFIC;
		}
		return $this;
	}

}