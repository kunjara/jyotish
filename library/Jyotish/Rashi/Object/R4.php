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
 * Class of rashi 4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R4 extends \Jyotish\Rashi\Rashi {

	static public $rashiUnicode = 'U+264B';
	static public $rashiBhava = self::BHAVA_CHARA;
	static public $rashiBhuta = Bhuta::BHUTA_JALA;
	static public $rashiGender = Manusha::GENDER_FEMALE;
	static public $rashiLimb = Manusha::LIMB_HEART;
	static public $rashiPrakriti = Prakriti::PRAKRITI_KAPHA;

	public function __construct($options) {
		return $this;
	}

}