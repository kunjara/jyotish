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
 * Class of rashi 10.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R10 extends RashiObject {
	/**
	 * Rashi key
	 * 
	 * @var int
	 */
	protected $objectKey = 10;
	
	/**
	 * Devanagari title 'makara' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $rashiTranslit = ['ma','ka','ra'];
	
	/**
	 * Unicode of rashi.
	 * 
	 * @var string
	 */
	protected $rashiUnicode = '2651';
	
	/**
	 * Limb of Kaal Purush.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
	 */
	protected $rashiLimb = Manusha::LIMB_KNEES;
	
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
	protected $rashiGender = Manusha::GENDER_FEMALE;
	
	/**
	 * Prakriti of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiPrakriti = Prakriti::PRAKRITI_VATA;
	
	/**
	 * Bala of rashi.
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
	 */
	protected $rashiBala  = Rashi::BALA_RATRI;
	
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
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 19-20.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
	 */
	protected $rashiType = array
	(
		'hora1' => Manusha::TYPE_PASU,
		'hora2' => Manusha::TYPE_JALA,
	);
	
	/**
	 * Bhuta of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 19-20.
	 */
	protected $rashiBhuta = Bhuta::BHUTA_PRITVI;
	
	/**
	 * Ruler of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 19-20.
	 */
	protected $rashiRuler = Graha::GRAHA_SA;
	
	/**
	 * Varna of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 19-20.
	 */
	protected $rashiVarna = Manusha::VARNA_VAISHYA;

	public function __construct($options)
	{
		parent::__construct($options);
	}

}