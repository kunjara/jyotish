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
 * Class of nakshatra 12.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N12 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'uttara phalguni' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 '_u','ta','virama','ta','ra',' ','pha','aa','la','virama','ga','u','na','ii'
	);
	
	static public $nakshatraDeva = Deva::DEVA_ARYAMA;
	static public $nakshatraEnergy = self::ENERGY_LAYA;
	static public $nakshatraGana = Manusha::GANA_MANUSHA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_SY;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	static public $nakshatraType = self::TYPE_DHRUVA;
	static public $nakshatraVarna = Manusha::VARNA_KSHATRIYA;

	public function __construct($options) {
		return $this;
	}

}