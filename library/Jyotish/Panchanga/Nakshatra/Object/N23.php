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
 * Class of nakshatra 23.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N23 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'dhanishta' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'dha','na','i','ssa','virama','ttha','aa'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 11.
	 */
	protected $nakshatraType = self::TYPE_CHARANA;
	
	protected $nakshatraDeva = Deva::DEVA_VASU;
	protected $nakshatraEnergy = self::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_MA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	protected $nakshatraVarna = Manusha::VARNA_DASYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_PITTA;

	public function __construct($options) {
		return $this;
	}

}