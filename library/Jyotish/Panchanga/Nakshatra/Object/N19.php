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
 * Class of nakshatra 19.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N19 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'moola' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'ma','uu','la'
	);
	
	protected $nakshatraDeva = Deva::DEVA_NIRITTI;
	protected $nakshatraEnergy = self::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_NEUTER;
	protected $nakshatraGraha = Graha::GRAHA_KE;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_KAMA;
	protected $nakshatraType = self::TYPE_TIKSHNA;
	protected $nakshatraVarna = Manusha::VARNA_UGRA;

	public function __construct($options) {
		return $this;
	}

}