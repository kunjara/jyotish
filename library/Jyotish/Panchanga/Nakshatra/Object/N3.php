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
 * Class of nakshatra 3.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N3 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_AGNI;
	static public $nakshatraEnergy = self::ENERGY_LAYA;
	static public $nakshatraGana = Manusha::GANA_RAKSHASA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_SY;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_KAMA;
	static public $nakshatraType = self::TYPE_SADHARANA;
	static public $nakshatraVarna = Manusha::VARNA_BRAHMANA;

	public function __construct($options) {
		return $this;
	}

}