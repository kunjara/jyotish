<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 29.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T29 extends \Jyotish\Panchanga\Tithi\Tithi {
	/**
	 * Devanagari number 14 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $tithiTranslit = array(
		 'd1', 'd4'
	);
	
	static public $tithiDeva = Deva::DEVA_KALIPURUSHA;
	static public $tithiPaksha = self::PAKSHA_KRISHNA;
	static public $tithiType = self::TYPE_RIKTA;
	static public $tithiKarana = array(
		1 => Karana::NAME_VISHTI,
		2 => Karana::NAME_SHAKUNI
	);

	public function __construct($options) {
		return $this;
	}

}