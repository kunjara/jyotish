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
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of nakshatra 4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N4 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'rohini' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'ra','o','ha','i','nna','ii'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 6.
	 */
	protected $nakshatraType = self::TYPE_DHRUVA;
	
	protected $nakshatraDeva = Deva::DEVA_BRAHMA;
	protected $nakshatraEnergy = self::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_CH;
	protected $nakshatraGuna = Guna::GUNA_RAJA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	protected $nakshatraVarna = Manusha::VARNA_SHUDRA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_KAPHA;

	public function __construct($options) {
		return $this;
	}

}