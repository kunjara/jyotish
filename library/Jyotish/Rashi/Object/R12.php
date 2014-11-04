<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of rashi 12.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R12 extends RashiObject {
    /**
     * Rashi key
     * 
     * @var int
     */
    protected $objectKey = 12;

    /**
     * Devanagari title 'meena' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $rashiTranslit = ['ma','ii','na'];

    /**
     * Unicode of rashi.
     * 
     * @var string
     */
    protected $rashiUnicode = '2653';
    
    /**
     * Main name of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
     */
    protected $objectName = Rashi::NAME_12;

    /**
     * Limb of Kaal Purush.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
     */
    protected $rashiLimb = Manusha::LIMB_FEET;

    /**
     * Bhava of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiBhava = Rashi::BHAVA_DVISVA;

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
    protected $rashiPrakriti = Ayurveda::PRAKRITI_KAPHA;

    /**
     * Bala of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     */
    protected $rashiBala  = Rashi::BALA_DINA;

    /**
     * Daya of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     */
    protected $rashiDaya = Rashi::DAYA_UBHAYA;

    /**
     * Type of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    protected $rashiType = Manusha::TYPE_JALA;

    /**
     * Bhuta of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     */
    protected $rashiBhuta = Maha::BHUTA_JALA;

    /**
     * Ruler of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     */
    protected $rashiRuler = Graha::KEY_GU;

    /**
     * Varna of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     */
    protected $rashiVarna = Manusha::VARNA_BRAHMANA;

    public function __construct($options)
    {
        parent::__construct($options);
    }
}