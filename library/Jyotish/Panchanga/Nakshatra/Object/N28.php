<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;

/**
 * Class of nakshatra 28.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N28 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 28;
	
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
	protected $nakshatraType = Nakshatra::TYPE_KSHIPRA;
	
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
		parent::__construct($options);
	}

}