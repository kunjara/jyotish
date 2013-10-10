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
 * Class of nakshatra 25.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N25 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'purva bhadrapada' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 'pa','uu','ra','virama','va',' ','bha','aa','da','virama','ra','pa','da','aa'
	);
	
	static public $nakshatraDeva = Deva::DEVA_AJIKAPADA;
	static public $nakshatraEnergy = self::ENERGY_SRISHTI;
	static public $nakshatraGana = Manusha::GANA_MANUSHA;
	static public $nakshatraGender = Manusha::GENDER_MALE;
	static public $nakshatraGraha = Graha::GRAHA_GU;
	static public $nakshatraGuna = Guna::GUNA_SATTVA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	static public $nakshatraType = self::TYPE_UGRA;
	static public $nakshatraVarna = Manusha::VARNA_BRAHMANA;

	public function __construct($options) {
		return $this;
	}

}