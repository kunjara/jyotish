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
 * Class of nakshatra 13.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N13 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_SURYA_SAVITRI;
	static public $nakshatraEnergy = self::ENERGY_SRISHTI;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender = Manusha::GENDER_MALE;
	static public $nakshatraGraha = Graha::GRAHA_CH;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	static public $nakshatraType = self::TYPE_KSHIPRA;
	static public $nakshatraVarna = Manusha::VARNA_VAISHYA;

	public function __construct($options) {
		return $this;
	}

}