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
 * Class of nakshatra 2.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N2 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 2;
	
	/**
	 * Devanagari title 'bharani' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'bha','ra','nna','ii'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 8.
	 */
	protected $nakshatraType = Nakshatra::TYPE_UGRA;
	
	protected $nakshatraDeva = Deva::DEVA_YAMA;
	protected $nakshatraEnergy = Nakshatra::ENERGY_STHITI;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_SK;
	protected $nakshatraGuna = Guna::GUNA_RAJA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
	protected $nakshatraVarna = Manusha::VARNA_MLECHHA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_PITTA;
	protected $nakshatraYoni = array(
		'animal' => Chatushpada::ANIMAL_ELEPHANT,
		'gender' => Manusha::GENDER_MALE,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}