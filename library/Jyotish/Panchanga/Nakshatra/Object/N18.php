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
 * Class of nakshatra 18.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N18 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 18;
	
	/**
	 * Devanagari title 'jyeshtha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'ja','virama','ya','e','ssa','virama','ttha','aa'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 7.
	 */
	protected $nakshatraType = Nakshatra::TYPE_TIKSHNA;
	
	protected $nakshatraDeva = Deva::DEVA_INDRA;
	protected $nakshatraEnergy = Nakshatra::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_BU;
	protected $nakshatraGuna = Guna::GUNA_SATTVA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_DASYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_VATA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_HARE,
		'gender' => Manusha::GENDER_MALE,
	);
	protected $nakshatraRajju = array(
		'lift' => Nakshatra::LIFT_AVAROHA,
		'limb' => Nakshatra::LIMB_PADA,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}