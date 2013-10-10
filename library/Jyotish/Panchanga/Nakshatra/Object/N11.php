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
 * Class of nakshatra 11.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N11 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'poorva phalguni' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 'pa','uu','ra','virama','va',' ','pha','aa','la','virama','ga','u','na','ii'
	);
	
	static public $nakshatraDeva = Deva::DEVA_BHAGA;
	static public $nakshatraEnergy = self::ENERGY_STHITI;
	static public $nakshatraGana = Manusha::GANA_MANUSHA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_SK;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_KAMA;
	static public $nakshatraType = self::TYPE_UGRA;
	static public $nakshatraVarna = Manusha::VARNA_BRAHMANA;

	public function __construct($options) {
		return $this;
	}

}