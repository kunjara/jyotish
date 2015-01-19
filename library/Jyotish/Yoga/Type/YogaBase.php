<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Graha\Graha;
use Jyotish\Bhava\Bhava;
use Jyotish\Base\Analysis;

/**
 * Base class for yoga combinations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class YogaBase implements \Iterator, \Countable{
    
    use \Jyotish\Base\Traits\DataTrait;
    
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
    protected $yogas = array();
    
    /**
     * Constructor
     */
    public function __construct($data) {
        $this->setData($data);
    }
    
    /**
     * Whether parivarthana yoga.
     * 
     * @param string $graha1 Key of graha
     * @param string $graha2 Key of graha
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 32.
     */
    public function yogaParivarthana($graha1, $graha2)
    {
        $Graha1 = Graha::getInstance($graha1);
        $Graha2 = Graha::getInstance($graha2);
        foreach ($Graha1->grahaSwa as $key => $data) $rashi1Swa[] = $data['rashi']; 
        foreach ($Graha2->grahaSwa as $key => $data) $rashi2Swa[] = $data['rashi']; 
        
        if(
            in_array($this->ganitaData['graha'][$graha1]['rashi'], $rashi2Swa) and
            in_array($this->ganitaData['graha'][$graha2]['rashi'], $rashi1Swa)
        )
            return true;
        else
            return false;
    }
    
    /**
     * If the lord of a kendras establishes relationship with a trikonas lord, 
     * a Rajayoga will obtain.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 28.
     */
    public function yogaRaja()
    {
        $Analysis = new Analysis($this->ganitaData);
        
        $kendraRulers = $Analysis->getBhavaRulers(Bhava::$bhavaKendra);
        $trikonaRulers = $Analysis->getBhavaRulers(Bhava::$bhavaTrikona);
        
        $isParivarthana = false;
        $isConjuncted = false;
        $isAspected = false;
        
        foreach ($kendraRulers as $kendraRuler){
            foreach ($trikonaRulers as $trikonaRuler){
                $KendraRuler = Graha::getInstance($kendraRuler);
                $KendraRuler->setEnvironment($this->ganitaData);
                $TrikonaRuler = Graha::getInstance($trikonaRuler);
                $TrikonaRuler->setEnvironment($this->ganitaData);
                
                // Parivarthana
                if($this->yogaParivarthana($kendraRuler, $trikonaRuler)){
                    $isParivarthana = true;
                    break;
                }
                
                // Conjunct
                $kendraRulerIsConjuncted = $KendraRuler->isConjuncted();
                if(isset($kendraRulerIsConjuncted[$trikonaRuler])){
                    $isConjuncted = true;
                    break;
                }
                
                // Ascpect
                $kendraRulerIsAspected = $KendraRuler->isAspectedByGraha();
                $trikonaRulerIsAspected = $TrikonaRuler->isAspectedByGraha();
                if(
                    $kendraRulerIsAspected[$trikonaRuler] == 1 and
                    $trikonaRulerIsAspected[$kendraRuler] == 1
                ){
                    $isAspected = true;
                    break;
                }
            }
        }
        
        if($isParivarthana or $isConjuncted or $isAspected)
            return true;
        else
            return false;
    }

    /**
     * rewind(): defined by Iterator interface.
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * current(): defined by Iterator interface.
     *
     * @return bool
     */
    public function current()
    {
        $yoga = 'yoga'.$this->yogas[$this->position];
        return $this->$yoga();
    }

    /**
     * key(): defined by Iterator interface.
     *
     * @return string
     */
    public function key()
    {
        return $this->yogas[$this->position];
    }

    /**
     * next(): defined by Iterator interface.
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * valid(): defined by Iterator interface.
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->yogas[$this->position]);
    }

    /**
     * Returns the number of yogas.
     * 
     * @return int
     */
    public function count()
    {
        return count($this->yogas);
    }
}