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
 * Class of nakshatra 21.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N21 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 21;
	
	/**
	 * Devanagari title 'uttara ashadha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = ['_u','ta','virama','ta','ra','aa','ssa','aa','ddha','aa'];
	
	/**
	 * Deva of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
	 */
	protected $nakshatraDeva = Deva::DEVA_VISHVADEVA;
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 6.
	 */
	protected $nakshatraType = Nakshatra::TYPE_DHRUVA;
	
	protected $nakshatraEnergy = Nakshatra::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_SY;
	protected $nakshatraGuna = Guna::GUNA_RAJA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	protected $nakshatraVarna = Manusha::VARNA_KSHATRIYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_KAPHA;
	protected $nakshatraYoni = array(
		'animal' => Pasu::ANIMAL_MONGOOSE,
		'gender' => Manusha::GENDER_MALE,
	);
	protected $nakshatraRajju = array(
		'lift' => Nakshatra::LIFT_AROHA,
		'limb' => Nakshatra::LIMB_NABHI,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}