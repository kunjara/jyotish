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
 * Class of nakshatra 19.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N19 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 19;
	
	/**
	 * Devanagari title 'moola' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = ['ma','uu','la'];
	
	/**
	 * Deva of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
	 */
	protected $nakshatraDeva = Deva::DEVA_NIRRITI;
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 7.
	 */
	protected $nakshatraType = Nakshatra::TYPE_TIKSHNA;
	
	protected $nakshatraEnergy = Nakshatra::ENERGY_SRISHTI;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_NEUTER;
	protected $nakshatraGraha = Graha::GRAHA_KE;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_KAMA;
	protected $nakshatraVarna = Manusha::VARNA_UGRA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_VATA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_DOG,
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