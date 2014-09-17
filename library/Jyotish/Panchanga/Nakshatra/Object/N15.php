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
 * Class of nakshatra 15.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N15 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 15;
	
	/**
	 * Devanagari title 'swati' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'sa','virama','va','aa','ta','ii'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 11.
	 */
	protected $nakshatraType = Nakshatra::TYPE_CHARANA;
	
	protected $nakshatraDeva = Deva::DEVA_VAYU;
	protected $nakshatraEnergy = Nakshatra::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_DEVA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_RA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_UGRA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_KAPHA;
	protected $nakshatraYoni = array(
		'animal' => Chatushpada::ANIMAL_BUFFALO,
		'gender' => Manusha::GENDER_MALE,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}