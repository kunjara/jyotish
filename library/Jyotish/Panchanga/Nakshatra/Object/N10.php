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
use Jyotish\Tattva\Jiva\Pasu\Pasu;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of nakshatra 10.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N10 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 10;
	
	/**
	 * Devanagari title 'magha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'ma','gha','aa'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 8.
	 */
	protected $nakshatraType = Nakshatra::TYPE_UGRA;
	
	protected $nakshatraDeva = Deva::DEVA_PITRU;
	protected $nakshatraEnergy = Nakshatra::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_KE;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_SHUDRA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_KAPHA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_RAT,
		'gender' => Manusha::GENDER_MALE,
	);
	protected $nakshatraRajju = array(
		'lift' => Nakshatra::LIFT_AROHA,
		'limb' => Nakshatra::LIMB_PADA,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}