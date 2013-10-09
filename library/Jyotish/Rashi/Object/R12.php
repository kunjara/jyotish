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
 * Class of rashi 12.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R12 extends \Jyotish\Rashi\Rashi {
	/**
	 * Devanagari title 'meena' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $rashiTranslit = array(
		 'ma','ii','na'
	);
	
	static public $rashiUnicode = '2653';
	static public $rashiBhava = self::BHAVA_DVISVA;
	static public $rashiBhuta = Bhuta::BHUTA_JALA;
	static public $rashiGender = Manusha::GENDER_FEMALE;
	static public $rashiLimb = Manusha::LIMB_FEET;
	static public $rashiPrakriti = Prakriti::PRAKRITI_KAPHA;

	public function __construct($options) {
		return $this;
	}

}