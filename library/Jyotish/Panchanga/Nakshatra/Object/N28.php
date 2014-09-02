<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;

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
	protected $nakshatraTranslit = array(
		 '_a','bha','i','ja','ii','ta'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraType = self::TYPE_KSHIPRA;
	
	protected $nakshatraDeva = Deva::DEVA_BRAHMA;
	protected $nakshatraEnergy = null;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = null;
	protected $nakshatraGraha = null;
	protected $nakshatraGuna = null;
	protected $nakshatraPurushartha = null;
	protected $nakshatraVarna = null;
	protected $nakshatraPrakriti = null;

	public function __construct($options) {
		return $this;
	}

}