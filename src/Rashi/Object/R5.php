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
 * Class of rashi 5.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R5 extends RashiObject
{
    /**
     * Rashi key
     * 
     * @var int
     */
    protected $objectKey = 5;
    
    /**
     * Set type of jiva for 5th rashi as vana (wild).
     * 
     * @var bool
     */
    protected $optionRashi5IsVana = false;

    /**
     * Devanagari title 'simha' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $rashiTranslit = ['sa','i','anusvara','ha'];

    /**
     * Unicode of rashi.
     * 
     * @var string
     */
    protected $rashiUnicode = '264C';
    
    /**
     * Names of the rashi.
     * 
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 8.
     */
    protected $objectNames = [
        'Leya',
    ];

    /**
     * Limb of Kaal Purush.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
     */
    protected $rashiLimb = Manusha::LIMB_STOMACH;

    /**
     * Prakriti of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiPrakriti = Ayurveda::PRAKRITI_PITTA;

    /**
     * Bala of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiBala  = Rashi::BALA_DINA;

    /**
     * Daya of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiDaya = Rashi::DAYA_SIRSHA;

    /**
     * Type of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 12.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    protected $rashiType = Manusha::TYPE_PASU;

    /**
     * Bhuta of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 12.
     */
    protected $rashiBhuta = Maha::BHUTA_AGNI;

    /**
     * Ruler of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 12.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 11.
     */
    protected $rashiRuler = Graha::KEY_SY;

    /**
     * Varna of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 12.
     */
    protected $rashiVarna = Manusha::VARNA_KSHATRIYA;

    /**
     * Set rashi type.
     */
    protected function setRashiType()
    {
        if ($this->optionRashi5IsVana) {
            $this->rashiType = Manusha::TYPE_VANA;
        } else {
            $this->rashiType = Manusha::TYPE_PASU;
        }
    }

    public function __construct($options = null)
    {
        parent::__construct($options);
        
        $this->setRashiType();
    }
}