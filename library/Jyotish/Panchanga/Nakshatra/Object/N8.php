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
 * Class of nakshatra 8.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N8 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {

	static public $nakshatraDeva = Deva::DEVA_BRIHASPATI;
	static public $nakshatraEnergy = self::ENERGY_STHITI;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender = Manusha::GENDER_MALE;
	static public $nakshatraGraha = Graha::GRAHA_SA;
	static public $nakshatraGuna = Guna::GUNA_TAMA;
	static public $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	static public $nakshatraType = self::TYPE_KSHIPRA;
	static public $nakshatraVarna = Manusha::VARNA_KSHATRIYA;

	public function __construct($options) {
		return $this;
	}

}