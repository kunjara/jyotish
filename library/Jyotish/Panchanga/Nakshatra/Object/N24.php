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
 * Class of nakshatra 24.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N24 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'shatabhisha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 'sha','ta','bha','i','ssa','aa'
	);
	
	static public $nakshatraDeva = Deva::DEVA_VARUNA;
	static public $nakshatraEnergy = self::ENERGY_LAYA;
	static public $nakshatraGana = Manusha::GANA_RAKSHASA;
	static public $nakshatraGender = Manusha::GENDER_NEUTER;
	static public $nakshatraGraha = Graha::GRAHA_RA;
	static public $nakshatraGuna = Guna::GUNA_TAMA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	static public $nakshatraType = self::TYPE_CHARANA;
	static public $nakshatraVarna = Manusha::VARNA_UGRA;

	public function __construct($options) {
		return $this;
	}

}