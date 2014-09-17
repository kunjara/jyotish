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
 * Class of nakshatra 12.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N12 extends NakshatraObject {
	/**
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey = 12;
	
	/**
	 * Devanagari title 'uttara phalguni' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 '_u','ta','virama','ta','ra',' ','pha','aa','la','virama','ga','u','na','ii'
	);
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 6.
	 */
	protected $nakshatraType = Nakshatra::TYPE_DHRUVA;
	
	protected $nakshatraDeva = Deva::DEVA_ARYAMA;
	protected $nakshatraEnergy = Nakshatra::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_MANUSHA;
	protected $nakshatraGender = Manusha::GENDER_FEMALE;
	protected $nakshatraGraha = Graha::GRAHA_SY;
	protected $nakshatraGuna = Guna::GUNA_RAJA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
	protected $nakshatraVarna = Manusha::VARNA_KSHATRIYA;
	protected $nakshatraPrakriti = Prakriti::PRAKRITI_VATA;
	protected $nakshatraYoni = array(
		'animal' => Chatushpada::ANIMAL_COW,
		'gender' => Manusha::GENDER_MALE,
	);

	public function __construct($options) {
		parent::__construct($options);
	}

}