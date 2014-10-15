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
 * Class of nakshatra 5.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N5 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 5;
	
	/**
	 * Devanagari title 'mrigashirsha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = ['ma','r','ga','sha','ii','ra','virama','ssa','aa'];
	
	/**
	 * Deva of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
	 */
	protected $nakshatraDeva = Deva::DEVA_CHANDRA;
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 10.
	 */
	protected $nakshatraType = Nakshatra::TYPE_MRIDU;
	
	protected $nakshatraEnergy = Nakshatra::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = Manusha::GENDER_NEUTER;
	protected $nakshatraGraha = Graha::GRAHA_MA;
	protected $nakshatraGuna = Maha::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	protected $nakshatraVarna = Manusha::VARNA_DASYA;
	protected $nakshatraPrakriti = Ayurveda::PRAKRITI_PITTA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_SERPENT,
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