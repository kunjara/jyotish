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
	protected $nakshatraTranslit = array(
		 '_a','bha','i','ja','ii','ta'
	);
	
	protected $nakshatraDeva = Deva::DEVA_BRAHMA;
	protected $nakshatraEnergy;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender;
	protected $nakshatraGraha;
	protected $nakshatraGuna;
	protected $nakshatraPurushartha;
	protected $nakshatraType = self::TYPE_KSHIPRA;
	protected $nakshatraVarna;

	public function __construct($options) {
		return $this;
	}

}