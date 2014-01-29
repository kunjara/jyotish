<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 28.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T28 extends \Jyotish\Panchanga\Tithi\Tithi {
	/**
	 * Devanagari number 13 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $tithiTranslit = array(
		 'd1', 'd3'
	);
	
	static public $tithiDeva = Deva::DEVA_KAMA_MANMATHA;
	static public $tithiPaksha = self::PAKSHA_KRISHNA;
	static public $tithiType = self::TYPE_JAYA;
	static public $tithiKarana = array(
		1 => Karana::NAME_GARA,
		2 => Karana::NAME_VANIJA
	);

	public function __construct($options) {
		return $this;
	}

}