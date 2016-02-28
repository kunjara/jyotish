<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Ganita\Math;

/**
 * Parent class for nakshatra objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class NakshatraObject extends \Jyotish\Panchanga\AngaObject
{
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Calculation with Abhijit nakshatra.
     *  
     * @var bool
     */
    protected $optionWithAbhijit = false;


    /**
     * Anga type.
     * 
     * @var string
     */
    protected $angaType = 'nakshatra';

    /**
     * Nakshatra key.
     * 
     * @var int
     */
    protected $nakshatraKey;
    
    /**
     * Nakshatra name.
     * 
     * @var string
     */
    protected $nakshatraName;

    /**
     * The number of taras (stars) of the nakshatra.
     * 
     * @var int
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 1-3.
     */
    protected $nakshatraTara;

    /**
     * Deva of nakshatra.
     * 
     * @var mixed
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva;

    /**
     * Type of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 6-11.
     */
    protected $nakshatraType;

    /**
     * Graha of nakshatra.
     * 
     * @var string
     * @see Satyacharya. Satya Jatakam. Chapter 1, Verse 9.
     */
    protected $nakshatraRuler;

    /**
     * Devanagari nakshatra title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = [];

    /**
     * Nakshatra start.
     * 
     * @var array
     */
    protected $nakshatraStart = [];

    /**
     * Nakshatra end.
     * 
     * @var array
     */
    protected $nakshatraEnd = [];

    /**
     * Energy of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraEnergy;

    /**
     * Gana of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraGana;

    /**
     * Gender of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraGender;

    /**
     * Guna of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraGuna;

    /**
     * Purushartha of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraPurushartha;

    /**
     * Varna of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraVarna;

    /**
     * Navatara of nakshatra.
     * 
     * @var int
     */
    protected $nakshatraNavatara;

    /**
     * Yoni of nakshatra.
     * 
     * @var array
     */
    protected $nakshatraYoni = [];

    /**
     * Rajju of nakshatra.
     * 
     * @var array
     */
    protected $nakshatraRajju = [];

    /**
     * Set nakshatra start and end.
     * 
     * @return void
     */
    protected function setNakshatraStartEnd()
    {
        if ($this->optionWithAbhijit) {
            switch ($this->nakshatraKey) {
            case 21:
                $this->nakshatraStart = Math::dmsMulti(Nakshatra::$arc, 20);
                $this->nakshatraEnd = ['d' => 276, 'm' => 40];
                break;
            case 28:
                $this->nakshatraStart = ['d' => 276, 'm' => 40];
                $this->nakshatraEnd = ['d' => 280, 'm' => 53, 's' => 20];
                break;
            case 22:
                $this->nakshatraStart = ['d' => 280, 'm' => 53, 's' => 20];
                $this->nakshatraEnd = Math::dmsMulti(Nakshatra::$arc, 22);
                break;
            default:
                $this->nakshatraStart = Math::dmsMulti(Nakshatra::$arc, $this->nakshatraKey - 1);
                $this->nakshatraEnd = Math::dmsSum($this->nakshatraStart, Nakshatra::$arc);
            }
        } else {
            if ($this->nakshatraKey == 28) {
                throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Parameters of 28 nakshatra are determined only with option 'withAbhijit' = true.");
            }

            $this->nakshatraStart = Math::dmsMulti(Nakshatra::$arc, $this->nakshatraKey - 1);
            $this->nakshatraEnd = Math::dmsSum($this->nakshatraStart, Nakshatra::$arc);
        }
    }

    /**
     * Set nakshatra navatara.
     * 
     * @return void
     */
    protected function setNakshatraNavatara()
    {
        if ($this->nakshatraKey == 28) {
            $result = null;
        } else {
            $result = Math::numberInCycle($this->nakshatraKey, 1, 9);
        }

        $this->nakshatraNavatara = $result;
    }

    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        parent::__construct();
        
        $this->setOptions($options);
        
        $this->setNakshatraStartEnd();
        $this->setNakshatraNavatara();
    }
}
