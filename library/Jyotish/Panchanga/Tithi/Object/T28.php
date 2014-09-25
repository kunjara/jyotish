<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 28.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T28 extends TithiObject {
	/**
	 * Tithi key
	 * 
	 * @var int
	 */
	protected $tithiKey = 28;
	
	/**
	 * Devanagari number 13 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $tithiTranslit = array(
		 'd1', 'd3'
	);
	
	/**
	 * Deva of tithi.
	 * 
	 * @var string
	 */
	protected $tithiDeva = Deva::DEVA_KAMA_MANMATHA;
	
	/**
	 * Paksha of tithi.
	 * 
	 * @var string
	 */
	protected $tithiPaksha = Tithi::PAKSHA_KRISHNA;
	
	/**
	 * Type of tithi.
	 * 
	 * @var string
	 */
	protected $tithiType = Tithi::TYPE_JAYA;
	
	/**
	 * Karana of tithi.
	 * 
	 * @var string
	 */
	protected $tithiKarana = array(
		1 => Karana::NAME_GARA,
		2 => Karana::NAME_VANIJA
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}