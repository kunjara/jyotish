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
 * Class of nakshatra 1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N1 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'ashwini' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 '_a','sha','virama','va','i','na','ii'
	);
	
	static public $nakshatraDeva = Deva::DEVA_ASHWINI;
	static public $nakshatraEnergy = self::ENERGY_SRISHTI;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender = Manusha::GENDER_MALE;
	static public $nakshatraGraha = Graha::GRAHA_KE;
	static public $nakshatraGuna = Guna::GUNA_TAMA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	static public $nakshatraType = self::TYPE_KSHIPRA;
	static public $nakshatraVarna = Manusha::VARNA_VAISHYA;

	public function __construct($options) {
		return $this;
	}

}