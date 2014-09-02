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
 * Class of nakshatra 1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N1 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'ashwini' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 '_a','sha','virama','va','i','na','ii'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 9.
	 */
	protected $nakshatraType = self::TYPE_KSHIPRA;
	
	protected $nakshatraDeva = Deva::DEVA_ASHWINI;
	protected $nakshatraEnergy = self::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = Manusha::GENDER_MALE;
	protected $nakshatraGraha = Graha::GRAHA_KE;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	protected $nakshatraVarna = Manusha::VARNA_VAISHYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_VATA;

	public function __construct($options) {
		return $this;
	}

}