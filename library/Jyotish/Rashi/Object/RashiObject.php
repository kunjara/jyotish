<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Base\Object;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva;

/**
 * Parent class for rashi objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class RashiObject extends Object {
    /**
     * Options of rashi object.
     * 
     * @var array
     */
    protected $options = array(
        'rashi5Vana' => false,
    );
    
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
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 20-21.
     */
    protected $rashiBhava;

    /**
     * Gender of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 20-21.
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
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiBala;

    /**
     * Daya of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiDaya;

    /**
     * Disha of rashi.
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 11.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 22.
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
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     */
    protected $rashiBhuta;

    /**
     * Ruler of rashi.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 22-24.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 11.
     */
    protected $rashiRuler;
    
    /**
     * Drishti of rashi.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 8, Verse 1-3.
     */
    protected $rashiDrishti;

    /**
     * Set rashi bhava.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 20-21.
     */
    protected function setRashiBhava()
    {
        switch($this->objectKey){
            case 1: case 4: case 7: case 10:
                $this->rashiBhava = Rashi::BHAVA_CHARA;
                break;
            case 2: case 5: case 8: case 11:
                $this->rashiBhava = Rashi::BHAVA_STHIRA;
                break;
            case 3: case 6: case 9: case 12:
                $this->rashiBhava = Rashi::BHAVA_DVISVA;
        }
    }
    
    /**
     * Set rashi drishti.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 8, Verse 1-3.
     */
    protected function setRashiDrishti()
    {
        switch($this->rashiBhava){
            case Rashi::BHAVA_CHARA:
                $drishti = array_diff([2, 5, 8, 11], [$this->objectKey + 1]);
                break;
            case Rashi::BHAVA_STHIRA:
                $drishti = array_diff([1, 4, 7, 10], [$this->objectKey - 1]);
                break;
            case Rashi::BHAVA_DVISVA:
                $drishti = array_diff([3, 6, 9, 12], [$this->objectKey]);
        }
        foreach ($drishti as $num => $rashi){
           $result[$rashi] = 1;
        }
        $this->rashiDrishti = $result;
    }

    /**
     * Set rashi gender.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 20-21.
     */
    protected function setRashiGender()
    {
        $this->rashiGender = ($this->objectKey % 2) ? Jiva::GENDER_MALE : Jiva::GENDER_FEMALE;
    }

    /**
     * Set rashi disha.
     * 
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 11.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 22.
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
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        parent::__construct($options);
        
        $this->setRashiBhava();
        $this->setRashiDrishti();
        $this->setRashiGender();
        $this->setRashiDisha();
    }
}
