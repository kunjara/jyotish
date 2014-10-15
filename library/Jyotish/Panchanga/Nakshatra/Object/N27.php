<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Jiva\Pasu;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of nakshatra 27.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N27 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 27;
	
	/**
	 * Devanagari title 'revati' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = ['ra','e','va','ta','ii'];
	
	/**
	 * Deva of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
	 */
	protected $nakshatraDeva = Deva::DEVA_PUSHA;
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 10.
	 */
	protected $nakshatraType = Nakshatra::TYPE_MRIDU;
	
	protected $nakshatraEnergy = Nakshatra::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_BU;
	protected $nakshatraGuna = Maha::GUNA_SATTVA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	protected $nakshatraVarna = Manusha::VARNA_SHUDRA;
	protected $nakshatraPrakriti = Ayurveda::PRAKRITI_KAPHA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_ELEPHANT,
		'gender' => Manusha::GENDER_FEMALE,
	);
	protected $nakshatraRajju = array(
		'lift' => Nakshatra::LIFT_AVAROHA,
		'limb' => Nakshatra::LIMB_PADA,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}