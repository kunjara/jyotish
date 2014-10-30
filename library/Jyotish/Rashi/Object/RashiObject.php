<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Base\Object;
use Jyotish\Tattva\Maha;

/**
 * Parent class for rashi objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class RashiObject extends Object {
    /**
     * Object type
     * 
     * @var string
     */
    protected $objectType = 'rashi';

    /**
     * Devanagari rashi title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $rashiTranslit;

    /**
     * Unicode of rashi.
     * 
     * @var string
     */
    protected $rashiUnicode;

    /**
     * Limb of Kaal Purush.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
     */
    protected $rashiLimb;

    /**
     * Bhava of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiBhava;

    /**
     * Gender of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiGender;

    /**
     * Prakriti of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiPrakriti;

    /**
     * Bala of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     */
    protected $rashiBala;

    /**
     * Daya of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     */
    protected $rashiDaya;

    /**
     * Disha of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 11.
     */
    protected $rashiDisha;

    /**
     * Varna of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-24.
     */
    protected $rashiVarna;

    /**
     * Type of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-24.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    protected $rashiType;

    /**
     * Bhuta of rashi.
     * 
     * @var string
     */
    protected $rashiBhuta;

    /**
     * Ruler of rashi.
     * 
     * @var string
     */
    protected $rashiRuler;

    /**
     * Set rashi disha.
     * 
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 11.
     */
    protected function setRashiDisha()
    {
        switch($this->objectKey){
            case 1:	case 5:	case 9:
                $this->rashiDisha = Maha::DISHA_PURVA;
                break;
            case 2:	case 6:	case 10:
                $this->rashiDisha = Maha::DISHA_DAKSHINA;
                break;
            case 3: case 7: case 11:
                $this->rashiDisha = Maha::DISHA_PASCHIMA;
                break;
            case 4: case 8: case 12:
                $this->rashiDisha = Maha::DISHA_UTTARA;
        }
    }

    /**
     * Constructor
     * 
     * @param array $options
     */
    public function __construct($options)
    {
        $this->setRashiDisha();
    }
}
