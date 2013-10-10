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
 * Class of nakshatra 14.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N14 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'chitra' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 'ca','i','ta','virama','ra','aa'
	);
	
	static public $nakshatraDeva = Deva::DEVA_TWASHTR;
	static public $nakshatraEnergy = self::ENERGY_STHITI;
	static public $nakshatraGana = Manusha::GANA_RAKSHASA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_MA;
	static public $nakshatraGuna = Guna::GUNA_TAMA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_KAMA;
	static public $nakshatraType = self::TYPE_MRIDU;
	static public $nakshatraVarna = Manusha::VARNA_DASYA;

	public function __construct($options) {
		return $this;
	}

}