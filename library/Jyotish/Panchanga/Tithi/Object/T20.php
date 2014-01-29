<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 20.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T20 extends \Jyotish\Panchanga\Tithi\Tithi {
	/**
	 * Devanagari number 5 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $tithiTranslit = array(
		 'd5'
	);
	
	static public $tithiDeva = Deva::DEVA_SARPA;
	static public $tithiPaksha = self::PAKSHA_KRISHNA;
	static public $tithiType = self::TYPE_PURNA;
	static public $tithiKarana = array(
		1 => Karana::NAME_KAULAVA,
		2 => Karana::NAME_TAITILA
	);

	public function __construct($options) {
		return $this;
	}

}