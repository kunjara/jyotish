<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 30.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T30 extends \Jyotish\Panchanga\Tithi\Tithi {
	/**
	 * Devanagari number 15 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $tithiTranslit = array(
		 'd1', 'd5'
	);
	
	static public $tithiDeva = Deva::DEVA_PITRU;
	static public $tithiPaksha = null;
	static public $tithiType = self::TYPE_PURNA;
	static public $tithiKarana = array(
		1 => Karana::NAME_CHATUSHPADA,
		2 => Karana::NAME_NAGA
	);

	public function __construct($options) {
		return $this;
	}

}