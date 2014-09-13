<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Manusha;
use Jyotish\Tattva\Maha\Bhuta;
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of rashi 11.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R11 extends RashiObject {
	/**
	 * Rashi key
	 * 
	 * @var int
	 */
	protected $rashiKey = 11;
	
	/**
	 * Devanagari title 'kumbha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $rashiTranslit = array(
		 'ka','u','ma','virama','bha'
	);
	
	/**
	 * Unicode of rashi.
	 * 
	 * @var string
	 */
	protected $rashiUnicode = '2652';
	
	/**
	 * Limb of Kaal Purush.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
	 */
	protected $rashiLimb = Manusha::LIMB_ANKLES;
	
	/**
	 * Bhava of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiBhava = Rashi::BHAVA_STHIRA;
	
	/**
	 * Gender of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiGender = Manusha::GENDER_MALE;
	
	/**
	 * Prakriti of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiPrakriti = Prakriti::PRAKRITI_MISHRA;
	
	/**
	 * Bhuta of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 21-21 1/2.
	 */
	protected $rashiBhuta = Bhuta::BHUTA_VAYU;
	
	/**
	 * Ruler of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 21-21 1/2.
	 */
	protected $rashiRuler = Graha::GRAHA_SA;
	
	/**
	 * Varna of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 21-21 1/2.
	 */
	protected $rashiVarna = Manusha::VARNA_SHUDRA;

	public function __construct($options) {
		parent::__construct($options);
	}

}