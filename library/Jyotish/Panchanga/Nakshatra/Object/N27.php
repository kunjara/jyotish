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
 * Class of nakshatra 27.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N27 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_PUSHA;
	static public $nakshatraEnergy = self::ENERGY_LAYA;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_BU;
	static public $nakshatraGuna = Guna::GUNA_SATTVA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	static public $nakshatraType = self::TYPE_MRIDU;
	static public $nakshatraVarna = Manusha::VARNA_SHUDRA;

	public function __construct($options) {
		return $this;
	}

}