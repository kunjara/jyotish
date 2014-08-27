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
 * Class of nakshatra 17.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N17 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'anuradha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 '_a','na','u','ra','aa','dha','aa'
	);
	
	protected $nakshatraDeva = Deva::DEVA_SURYA_MITRA;
	protected $nakshatraEnergy = self::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = Manusha::GENDER_MALE;
	protected $nakshatraGraha = Graha::GRAHA_SA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	protected $nakshatraType = self::TYPE_MRIDU;
	protected $nakshatraVarna = Manusha::VARNA_SHUDRA;

	public function __construct($options) {
		return $this;
	}

}