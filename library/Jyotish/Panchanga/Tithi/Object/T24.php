<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 24.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T24 extends \Jyotish\Panchanga\Tithi\Tithi {
	/**
	 * Devanagari number 9 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $tithiTranslit = array(
		 'd9'
	);
	
	static public $tithiDeva = Deva::DEVA_ASHTAVASU;
	static public $tithiPaksha = self::PAKSHA_KRISHNA;
	static public $tithiType = self::TYPE_RIKTA;
	static public $tithiKarana = array(
		1 => Karana::NAME_TAITILA,
		2 => Karana::NAME_GARA
	);

	public function __construct($options) {
		return $this;
	}

}