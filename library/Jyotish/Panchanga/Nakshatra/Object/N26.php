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
 * Class of nakshatra 26.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N26 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'uttara bhadrapada' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 '_u','ta','virama','ta','ra',' ','bha','aa','da','virama','ra','pa','da','aa'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 6.
	 */
	protected $nakshatraType = self::TYPE_DHRUVA;
	
	protected $nakshatraDeva = Deva::DEVA_AHIRBUDHYANA;
	protected $nakshatraEnergy = self::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_MALE;
	protected $nakshatraGraha = Graha::GRAHA_SA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_KSHATRIYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_PITTA;

	public function __construct($options) {
		return $this;
	}

}