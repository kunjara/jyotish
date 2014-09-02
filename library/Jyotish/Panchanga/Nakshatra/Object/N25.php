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
 * Class of nakshatra 25.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N25 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'purva bhadrapada' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'pa','uu','ra','virama','va',' ','bha','aa','da','virama','ra','pa','da','aa'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 8.
	 */
	protected $nakshatraType = self::TYPE_UGRA;
	
	protected $nakshatraDeva = Deva::DEVA_AJIKAPADA;
	protected $nakshatraEnergy = self::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_MALE;
	protected $nakshatraGraha = Graha::GRAHA_GU;
	protected $nakshatraGuna = Guna::GUNA_SATTVA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_BRAHMANA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_VATA;

	public function __construct($options) {
		return $this;
	}

}