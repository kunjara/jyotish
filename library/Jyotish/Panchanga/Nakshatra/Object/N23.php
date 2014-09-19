<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Dwipada\Deva;
use Jyotish\Tattva\Jiva\Dwipada\Manusha;
use Jyotish\Tattva\Jiva\Chatushpada\Chatushpada;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of nakshatra 23.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N23 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 23;
	
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
	protected $nakshatraType = Nakshatra::TYPE_CHARANA;
	
	protected $nakshatraDeva = Deva::DEVA_VASU;
	protected $nakshatraEnergy = Nakshatra::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_MA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	protected $nakshatraVarna = Manusha::VARNA_DASYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_PITTA;
	protected $nakshatraYoni = array(
		'animal' => Chatushpada::ANIMAL_LION,
		'gender' => Manusha::GENDER_FEMALE,
	);
	protected $nakshatraRajju = array(
		'lift' => Nakshatra::LIFT_AROHA,
		'limb' => Nakshatra::LIMB_SHIRO,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}