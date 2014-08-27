<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Deva;
use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Maha\Guna;

/**
 * Class of nakshatra 24.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N24 extends \Jyotish\Panchanga\Nakshatra\Nakshatra {
	/**
	 * Devanagari title 'shatabhisha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array(
		 'sha','ta','bha','i','ssa','aa'
	);
	
	protected $nakshatraDeva = Deva::DEVA_VARUNA;
	protected $nakshatraEnergy = self::ENERGY_LAYA;
	protected $nakshatraGana = Manusha::GANA_RAKSHASA;
	protected $nakshatraGender = Manusha::GENDER_NEUTER;
	protected $nakshatraGraha = Graha::GRAHA_RA;
	protected $nakshatraGuna = Guna::GUNA_TAMA;
	protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
	protected $nakshatraType = self::TYPE_CHARANA;
	protected $nakshatraVarna = Manusha::VARNA_UGRA;

	public function __construct($options) {
		return $this;
	}

}