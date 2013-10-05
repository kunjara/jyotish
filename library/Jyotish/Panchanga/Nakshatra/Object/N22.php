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
 * Class of nakshatra 22.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N22 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_VISHNU;
	static public $nakshatraEnergy = self::ENERGY_SRISHTI;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender = Manusha::GENDER_MALE;
	static public $nakshatraGraha = Graha::GRAHA_CH;
	static public $nakshatraGuna = Guna::GUNA_RAJA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	static public $nakshatraType = self::TYPE_CHARANA;
	static public $nakshatraVarna = Manusha::VARNA_MLECHHA;

	public function __construct($options) {
		return $this;
	}

}