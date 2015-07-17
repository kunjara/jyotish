<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Base\Biblio;
use Jyotish\Panchanga\Tithi\Tithi;

/**
 * Parent class for tithi objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class TithiObject {

    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Options of tithi object.
     * 
     * @var array
     */
    protected $options = array(
        'tithiDeva' => Biblio::BOOK_BS,
    );

    /**
     * Tithi key
     * 
     * @var int
     */
    protected $tithiKey;

    /**
     * Devanagari tithi title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $tithiTranslit = array();

    /**
     * Deva of tithi.
     * 
     * @var string
     */
    protected $tithiDeva;

    /**
     * Paksha of tithi.
     * 
     * @var string
     */
    protected $tithiPaksha;

    /**
     * Type of tithi.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 99, Verse 2.
     */
    protected $tithiType;

    /**
     * Karana of tithi.
     * 
     * @var string
     */
    protected $tithiKarana = array();

    /**
     * Set tithi Deva.
     */
    protected function setTithiDeva($options)
    {
        $number = ($this->tithiKey > 15 and $this->tithiKey < 30) ? $this->tithiKey - 15 : $this->tithiKey;

        if(!is_null($options) and in_array($options['tithiDeva'], [Biblio::BOOK_BS, Biblio::BOOK_BP])){
            $this->tithiDeva = Tithi::$deva[$options['tithiDeva']][$number];
        }else{
            $this->tithiDeva = Tithi::$deva[Biblio::BOOK_BS][$number];
        }
    }

    /**
     * Set tithi paksha.
     */
    protected function setTithiPaksha()
    {
        if($this->tithiKey < 15){
            $this->tithiPaksha = Tithi::PAKSHA_SHUKLA;
        }elseif($this->tithiKey > 15 and $this->tithiKey < 30){
            $this->tithiPaksha = Tithi::PAKSHA_KRISHNA;
        }else{
            $this->tithiPaksha = null;
        }
    }

    /**
     * Set tithi type.
     * 
     * @see Varahamihira. Brihat Samhita. Chapter 99, Verse 2.
     */
    protected function setTithiType()
    {
        $number = $this->tithiKey <= 15 ? $this->tithiKey : $this->tithiKey - 15;

        switch ($number){
            case 1:	case 6:	case 11: 
                $this->tithiType = Tithi::TYPE_NANDA;
                break;
            case 2: case 7: case 12:
                $this->tithiType = Tithi::TYPE_BHADRA;
                break;
            case 3: case 8: case 13:
                $this->tithiType = Tithi::TYPE_JAYA;
                break;
            case 4: case 9: case 14:
                $this->tithiType = Tithi::TYPE_RIKTA;
                break;
            case 5: case 10: case 15:
                $this->tithiType = Tithi::TYPE_PURNA;
                break;
        }
    }

    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        $this->setOptions($options);
        
        $this->setTithiDeva($this->options);
        $this->setTithiPaksha();
        $this->setTithiType();
    }
}
