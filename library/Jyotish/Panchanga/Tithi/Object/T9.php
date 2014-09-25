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
 * Class of tithi 9.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T9 extends TithiObject {
	/**
	 * Tithi key
	 * 
	 * @var int
	 */
	protected $tithiKey = 9;
	
	/**
	 * Devanagari number 9 in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $tithiTranslit = array(
		 'd9'
	);
	
	/**
	 * Deva of tithi.
	 * 
	 * @var string
	 */
	protected $tithiDeva = Deva::DEVA_ASHTAVASU;
	
	/**
	 * Paksha of tithi.
	 * 
	 * @var string
	 */
	protected $tithiPaksha = Tithi::PAKSHA_SHUKLA;
	
	/**
	 * Type of tithi.
	 * 
	 * @var string
	 */
	protected $tithiType = Tithi::TYPE_RIKTA;
	
	/**
	 * Karana of tithi.
	 * 
	 * @var string
	 */
	protected $tithiKarana = array(
		1 => Karana::NAME_BALAVA,
		2 => Karana::NAME_KAULAVA
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}