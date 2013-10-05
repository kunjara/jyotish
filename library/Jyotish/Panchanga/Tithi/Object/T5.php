<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 5.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T5 extends \Jyotish\Panchanga\Tithi\Tithi {

	static public $tithiDeva = Deva::DEVA_SARPA;
	static public $tithiPaksha = self::PAKSHA_SHUKLA;
	static public $tithiType = self::TYPE_PURNA;
	static public $tithiKarana = array(
		1 => Karana::NAME_BAVA,
		2 => Karana::NAME_BALAVA
	);
	

	public function __construct($options) {
		return $this;
	}

}