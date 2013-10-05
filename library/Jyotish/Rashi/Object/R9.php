<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Maha\Bhuta;
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of rashi 9.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R9 extends \Jyotish\Rashi\Rashi {

	static public $rashiUnicode = 'U+2650';
	static public $rashiBhava = self::BHAVA_DVISVA;
	static public $rashiBhuta = Bhuta::BHUTA_AGNI;
	static public $rashiGender = Manusha::GENDER_MALE;
	static public $rashiLimb = Manusha::LIMB_THIGHS;
	static public $rashiPrakriti = Prakriti::PRAKRITI_PITTA;

	public function __construct($options) {
		return $this;
	}

}