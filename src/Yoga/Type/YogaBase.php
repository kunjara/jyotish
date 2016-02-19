<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Yoga;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;

/**
 * Base class for yoga combinations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class YogaBase
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = null;
    
    /**
     * Combinations list.
     * 
     * @var array
     */
    protected $yogas = [];
    
    /**
     * Options of Yoga calculation.
     * 
     * @var array
     */
    protected $options = [
        'outputAmple' => false,
    ];
    
    /**
     * Constructor
     * 
     * @param null|array $options Options to set (optional)
     */
    public function __construct(array $options = null)
    {
        $this->setOptions($options);
    }
    
    /**
     * Is there Parivarthana yoga.
     * 
     * @param string $graha1 Key of graha
     * @param string $graha2 Key of graha
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 32.
     */
    public function hasParivarthana($graha1, $graha2)
    {
        $Graha1 = Graha::getInstance($graha1);
        $Graha2 = Graha::getInstance($graha2);
        foreach ($Graha1->grahaSwa as $key => $data) $rashi1Swa[] = $data['rashi']; 
        foreach ($Graha2->grahaSwa as $key => $data) $rashi2Swa[] = $data['rashi']; 
        
        if (
            in_array($this->getData()['graha'][$graha1]['rashi'], $rashi2Swa) && 
            in_array($this->getData()['graha'][$graha2]['rashi'], $rashi1Swa)
        ) {
            if ($this->options['outputAmple']) {
                $Graha1->setEnvironment($this->Data);
                $Graha2->setEnvironment($this->Data);
                $graha1Bhava = $Graha1->getBhava();
                $graha2Bhava = $Graha2->getBhava();
                
                if (in_array($graha1Bhava, Bhava::$bhavaDusthana) || in_array($graha2Bhava, Bhava::$bhavaDusthana)) {
                    $subtype = Yoga::MAHAPURUSHA_DAINYA;
                } elseif ($graha1Bhava == 3 || $graha2Bhava == 3) {
                    $subtype = Yoga::MAHAPURUSHA_KHALA;
                } else {
                    $subtype = Yoga::MAHAPURUSHA_MAHA;
                }
                return $subtype;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Is there Mahapurusha yoga for the graha.
     * 
     * @param string $key Key of graha.
     * @return bool
     * @throws Exception\InvalidArgumentException
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 75, Verse 1-2.
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 1.
     */
    public function hasMahapurusha($key)
    {
        $panchaGraha = Graha::listGraha(Graha::LIST_PANCHA);
        if (!array_key_exists($key, $panchaGraha)) {
            throw new \Jyotish\Yoga\Exception\InvalidArgumentException("For {$key} Mahapurusha yoga is not available.");
        }
        
        $Graha = Graha::getInstance($key);
        $Graha->setEnvironment($this->Data);
        
        $grahaBhava = $Graha->getBhava();
        $grahaAvastha = $Graha->getRashiAvastha();
        
        if (
            in_array($grahaBhava, Bhava::$bhavaKendra) && 
            in_array($grahaAvastha, [Rashi::GRAHA_UCHA, Rashi::GRAHA_MOOL, Rashi::GRAHA_SWA])
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Gnerate list of present yogas.
     * 
     * @return \Iterator
     */
    public function generateYoga()
    {
        foreach ($this->yogas as $yoga) {
            $hasYoga = 'has'.$yoga;
            
            if ($this->$hasYoga()) {
                yield $yoga;
            }
        }
    }
}