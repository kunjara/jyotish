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
 * Class of nakshatra 2.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N2 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_YAMA;
	static public $nakshatraEnergy = self::ENERGY_STHITI;
	static public $nakshatraGana = Manusha::GANA_MANUSHA;
	static public $nakshatraGender = Manusha::GENDER_FEMALE;
	static public $nakshatraGraha = Graha::GRAHA_SK;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	static public $nakshatraType = self::TYPE_UGRA;
	static public $nakshatraVarna = Manusha::VARNA_MLECHHA;

	public function __construct($options) {
		return $this;
	}

}