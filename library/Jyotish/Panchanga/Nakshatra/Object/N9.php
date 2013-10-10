<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Maha\Guna;

/**
 * Class of nakshatra 9.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N9 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'ashlesha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 '_aa','sha','virama','la','e','ssa','aa'
	);
	
	static public $nakshatraDeva = Deva::DEVA_SARPA;
	static public $nakshatraEnergy = self::ENERGY_LAYA;
	static public $nakshatraGana = Manusha::GANA_RAKSHASA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_BU;
	static public $nakshatraGuna = Guna::GUNA_SATTVA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	static public $nakshatraType = self::TYPE_TIKSHNA;
	static public $nakshatraVarna = Manusha::VARNA_MLECHHA;

	public function __construct($options) {
		return $this;
	}

}