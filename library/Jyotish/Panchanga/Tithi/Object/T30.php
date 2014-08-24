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
	protected $tithiTranslit = array(
		 'd1', 'd5'
	);
	
	/**
	 * Deva of tithi.
	 * 
	 * @var string
	 */
	protected $tithiDeva = Deva::DEVA_PITRU;
	
	/**
	 * Paksha of tithi.
	 * 
	 * @var string
	 */
	protected $tithiPaksha = null;
	
	/**
	 * Type of tithi.
	 * 
	 * @var string
	 */
	protected $tithiType = self::TYPE_PURNA;
	
	/**
	 * Karana of tithi.
	 * 
	 * @var string
	 */
	protected $tithiKarana = array(
		1 => Karana::NAME_CHATUSHPADA,
		2 => Karana::NAME_NAGA
	);

	public function __construct($options) {
		return $this;
	}

}