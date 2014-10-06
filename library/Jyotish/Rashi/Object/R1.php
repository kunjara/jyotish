<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Maha\Bhuta;
use Jyotish\Tattva\Ayurveda\Prakriti;

/**
 * Class of rashi 1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R1 extends RashiObject {
	/**
	 * Rashi key
	 * 
	 * @var int
	 */
	protected $objectKey = 1;
	
	/**
	 * Devanagari title 'mesha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $rashiTranslit = array(
		 'ma','e','ssa'
	);
	
	/**
	 * Unicode of rashi.
	 * 
	 * @var string
	 */
	protected $rashiUnicode = '2648';
	
	/**
	 * Limb of Kaal Purush.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
	 */
	protected $rashiLimb = Manusha::LIMB_HEAD;
	
	/**
	 * Bhava of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiBhava = Rashi::BHAVA_CHARA;
	
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
	protected $rashiPrakriti = Prakriti::PRAKRITI_PITTA;
	
	/**
	 * Bala of rashi.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
	 */
	protected $rashiBala = Rashi::BALA_RATRI;
	
	/**
	 * Daya of rashi.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
	 */
	protected $rashiDaya = Rashi::DAYA_PRUSHTA;

	/**
	 * Type of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-7.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
	 */
	protected $rashiType = Manusha::TYPE_PASU;
	
	/**
	 * Bhuta of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-7.
	 */
	protected $rashiBhuta = Bhuta::BHUTA_AGNI;
	
	/**
	 * Ruler of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-7.
	 */
	protected $rashiRuler = Graha::GRAHA_MA;
	
	/**
	 * Varna of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-7.
	 */
	protected $rashiVarna = Manusha::VARNA_KSHATRIYA;

	public function __construct($options)
	{
		parent::__construct($options);
	}

}