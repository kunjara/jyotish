<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Ganita\Math;

/**
 * Parent class for nakshatra objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class NakshatraObject {
    
    use \Jyotish\Base\GetTrait;
    use \Jyotish\Base\OptionTrait;
    
    /**
     * Options of nakshatra object.
     * 
     * @var array
     */
    protected $options = array(
        'withAbhijit' => false,
    );

    /**
     * Arc length of the nakshatra.
     * 
     * @var array 
     */
    static public $nakshatraArc = array(
        'd' => 13,
        'm' => 20,
        's' => 0
    );

    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey;

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
    protected $nakshatraTranslit = array();

    /**
     * Nakshatra start.
     * 
     * @var array
     */
    protected $nakshatraStart = array();

    /**
     * Nakshatra end.
     * 
     * @var array
     */
    protected $nakshatraEnd = array();

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
     * @var string
     */
    protected $nakshatraNavatara;

    /**
     * Yoni of nakshatra.
     * 
     * @var array
     */
    protected $nakshatraYoni = array();

    /**
     * Rajju of nakshatra.
     * 
     * @var array
     */
    protected $nakshatraRajju = array();

    /**
     * Set nakshatra start and end.
     * 
     * @param array $options Options to set
     * @return void
     */
    protected function setNakshatraStartEnd($options)
    {
        if($options['withAbhijit']){
            switch ($this->nakshatraKey){
            case 21:
                $this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, 20);
                $this->nakshatraEnd = array('d' => 276, 'm' => 40);
                break;
            case 28:
                $this->nakshatraStart = array('d' => 276, 'm' => 40);
                $this->nakshatraEnd = array('d' => 280, 'm' => 53, 's' => 20);
                break;
            case 22:
                $this->nakshatraStart = array('d' => 280, 'm' => 53, 's' => 20);
                $this->nakshatraEnd = Math::dmsMulti(self::$nakshatraArc, 22);
                break;
            default:
                $this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, $this->nakshatraKey - 1);
                $this->nakshatraEnd = Math::dmsSum($this->nakshatraStart, self::$nakshatraArc);
            }
        }else{
            if($this->nakshatraKey == 28) {
                throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Parameters of 28 nakshatra are determined only with argument 'withAbhijit' = true.");
            }

            $this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, $this->nakshatraKey - 1);
            $this->nakshatraEnd = Math::dmsSum($this->nakshatraStart, self::$nakshatraArc);
        }
    }

    /**
     * Set nakshatra navatara.
     * 
     * @return void
     */
    protected function setNakshatraNavatara()
    {
        if($this->nakshatraKey == 28){
            $result = null;
        }else{
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
        $this->setOptions($options);
        
        $this->setNakshatraStartEnd($this->options);
        $this->setNakshatraNavatara();
    }
}
