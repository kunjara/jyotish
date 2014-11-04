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
 * Class of rashi 7.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R7 extends RashiObject {
    /**
     * Rashi key
     * 
     * @var int
     */
    protected $objectKey = 7;

    /**
     * Devanagari title 'tula' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $rashiTranslit = ['ta','u','la','aa'];

    /**
     * Unicode of rashi.
     * 
     * @var string
     */
    protected $rashiUnicode = '264E';
    
    /**
     * Main name of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
     */
    protected $objectName = Rashi::NAME_7;

    /**
     * Limb of Kaal Purush.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
     */
    protected $rashiLimb = Manusha::LIMB_BELOWNAVEL;

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
    protected $rashiPrakriti = Ayurveda::PRAKRITI_MISHRA;

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
    protected $rashiDaya = Rashi::DAYA_SIRSHA;

    /**
     * Type of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 15-16 1/2.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    protected $rashiType = Manusha::TYPE_NARA;

    /**
     * Bhuta of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 15-16 1/2.
     */
    protected $rashiBhuta = Maha::BHUTA_VAYU;

    /**
     * Ruler of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 15-16 1/2.
     */
    protected $rashiRuler = Graha::KEY_SK;

    /**
     * Varna of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 15-16 1/2.
     */
    protected $rashiVarna = Manusha::VARNA_SHUDRA;

    public function __construct($options)
    {
        parent::__construct($options);
    }
}