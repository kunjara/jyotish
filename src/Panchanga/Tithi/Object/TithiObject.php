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
class TithiObject extends \Jyotish\Panchanga\AngaObject
{
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Source of tithi deva information.
     * 
     * @var string
     */
    protected $optionDevaSource = Biblio::BOOK_BS;

    /**
     * Anga type.
     * 
     * @var string
     */
    protected $angaType = 'tithi';

    /**
     * Tithi key.
     * 
     * @var int
     */
    protected $tithiKey;
    
    /**
     * Tithi name.
     * 
     * @var string
     */
    protected $tithiName;

    /**
     * Devanagari tithi title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $tithiTranslit = [];

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
    protected $tithiKarana = [];
    
    /**
     * Set source of tithi Deva.
     * 
     * @param string $value
     * @return TithiObject
     */
    public function setOptionDevaSource($value)
    {
        if (in_array($value, [Biblio::BOOK_BS, Biblio::BOOK_BP])) {
            $this->optionDevaSource = $value;
        }
        return $this;
    }

    /**
     * Set tithi Deva.
     */
    protected function setTithiDeva()
    {
        $number = ($this->tithiKey > 15 && $this->tithiKey < 30) ? $this->tithiKey - 15 : $this->tithiKey;

        $this->tithiDeva = Tithi::$deva[$this->optionDevaSource][$number];
    }

    /**
     * Set tithi paksha.
     */
    protected function setTithiPaksha()
    {
        if ($this->tithiKey < 15) {
            $this->tithiPaksha = Tithi::PAKSHA_SHUKLA;
        } elseif ($this->tithiKey > 15 && $this->tithiKey < 30) {
            $this->tithiPaksha = Tithi::PAKSHA_KRISHNA;
        } else {
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

        switch ($number) {
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
        parent::__construct();
        
        $this->setOptions($options);
        
        $this->setTithiDeva();
        $this->setTithiPaksha();
        $this->setTithiType();
    }
}
