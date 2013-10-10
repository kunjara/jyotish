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
 * Class of nakshatra 10.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N10 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'magha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 'ma','gha','aa'
	);
	
	static public $nakshatraDeva = Deva::DEVA_PITRU;
	static public $nakshatraEnergy = self::ENERGY_SRISHTI;
	static public $nakshatraGana = Manusha::GANA_RAKSHASA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_KE;
	static public $nakshatraGuna = Guna::GUNA_TAMA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	static public $nakshatraType = self::TYPE_UGRA;
	static public $nakshatraVarna = Manusha::VARNA_SHUDRA;

	public function __construct($options) {
		return $this;
	}

}