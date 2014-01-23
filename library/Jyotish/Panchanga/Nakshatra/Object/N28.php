<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Maha\Guna;

/**
 * Class of nakshatra 28.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N28 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'abhijit' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $nakshatraTranslit = array(
		 '_a','bha','i','ja','ii','ta'
	);
	
	static public $nakshatraDeva = Deva::DEVA_BRAHMA;
	static public $nakshatraEnergy;
	static public $nakshatraGana = Manusha::GANA_DEVA;
	static public $nakshatraGender;
	static public $nakshatraGraha;
	static public $nakshatraGuna;
	static public $nakshatraPurushartha;
	static public $nakshatraType = self::TYPE_KSHIPRA;
	static public $nakshatraVarna;

	public function __construct($options) {
		return $this;
	}

}