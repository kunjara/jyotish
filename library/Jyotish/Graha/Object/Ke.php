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
 * Class of graha Ke.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ke extends \Jyotish\Graha\Graha {
	/**
	 * Title 'ketu' in Devanagari transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $grahaTranslit = array(
		 'ka','e','ta','u'
	);
	
	static public $grahaAvatara = 'Matsya';
	static public $grahaDeva = null;
	static public $grahaUnicode = '260B';
	static public $grahaAltName = array
	();
	static public $grahaExaltation = array
	(
		'rashi' => Rashi::RASHI_9,
		'degree' => null
	);
	static public $grahaDebilitation = array
	(
		'rashi' => Rashi::RASHI_3,
		'degree' => null
	);
	static public $grahaMooltrikon = array
	(
		'rashi' => null,
	);
	static public $grahaOwn = array
	(
		'rashi' => Rashi::RASHI_1,
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
	static public $grahaGender = Manusha::GENDER_NEUTER;
	static public $grahaRelation = null;
	static public $grahaDrishti = null;

	public function __construct($options) {
		return $this;
	}

}