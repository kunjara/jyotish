<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * Base class for Jyotish objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Object {

    use \Jyotish\Base\GetTrait;
    
    /**
     * Next position
     */
    const POS_NEXT = 'next';
    /**
     * Previous position
     */
    const POS_PREV = 'prev';
    
    /**
     * Options of jyotish object.
     * 
     * @var array
     */
    protected $options = array();
    
    /**
     * Type of object.
     * 
     * @var string
     */
    protected $objectType = null;

    /**
     * Abbreviation of the object.
     * 
     * @var mixed
     */
    protected $objectKey = null;
    
    /**
     * Rashi, where object is located.
     * 
     * @var int
     */
    protected $objectRashi = null;

    /**
     * Main name of the object.
     * 
     * @var string
     */
    protected $objectName = null;

    /**
     * Alternative names of the object.
     * 
     * @var array
     */
    protected $objectAltName = array();

    /**
     * Environment - position of the planets in the format of the ganita output data.
     * 
     * @var array
     */
    protected $ganitaData = null;

    /**
     * Set environment.
     * 
     * @param array $ganitaData
     */
    public function setEnvironment(array $ganitaData)
    {
        $this->ganitaData  = $ganitaData;

        if($this->objectType == 'rashi'){
            $this->objectRashi = $this->objectKey;
        }else{
            $this->objectRashi = $this->ganitaData[$this->objectType][$this->objectKey]['rashi'];
        }
    }

    /**
     * Check the environment.
     * 
     * @throws Exception\UnderflowException
     */
    protected function checkEnvironment()
    {
        if(is_null($this->ganitaData))
            throw new Exception\UnderflowException("Environment for object '{$this->objectType} {$this->objectKey}' must be setted.");
    }
    
    /**
     * Set options for jyotish object.
     * 
     * @param null|array $options
     * @throws Exception\InvalidArgumentException
     */
    protected function setOptions($options)
    {
        if (is_array($options)){
            foreach ($options as $optionName => $optionValue) {
                if (isset($this->options[$optionName])) {
                    $this->options[$optionName] = $optionValue;
                }else{
                    throw new Exception\InvalidArgumentException("Option '$optionName' does not exist.");
                }
            }
        }elseif(!is_null($options)){
            throw new Exception\InvalidArgumentException("Options must be an array.");
        }
    }

    /**
     * Get aspect by grahas.
     * 
     * @param null|array $options (Optional) Options to set
     * @return array
     */
    public function isAspectedByGraha($options = null)
    {
        $this->checkEnvironment();
        
        foreach (Graha::$graha as $key => $name){
            if($key == $this->objectKey) continue;

            $Graha = Graha::getInstance($key, $options);
            $grahaDrishti = $Graha->grahaDrishti;

            $distanse = Math::distanceInCycle(
                $this->ganitaData['graha'][$key]['rashi'], 
                $this->objectRashi
            );
            $isAspected[$key] = isset($grahaDrishti[$distanse]) ? $grahaDrishti[$distanse] : null;
        }
        return $isAspected;
    }
    
    /**
     * Get aspect by rashis.
     * 
     * @return array
     */
    public function isAspectedByRashi()
    {
        $this->checkEnvironment();
        
        foreach (Rashi::$rashi as $key => $name){
            if($key == $this->objectKey) continue;
            
            $Rashi = Rashi::getInstance($key);
            $rashiDrishti = $Rashi->rashiDrishti;
            
            if(isset($rashiDrishti[$this->objectRashi])){
                $isAspected['rashi'][$key] = $rashiDrishti[$this->objectRashi];
            }
        }
        
        $isAspected['graha'] = [];
        foreach (Graha::$graha as $key => $name){
            $grahaRashi = $this->ganitaData['graha'][$key]['rashi'];
            if(array_key_exists($grahaRashi, $isAspected['rashi'])){
                $isAspected['graha'][$key] = 1;
            }
        }
        return $isAspected;
    }

    /**
     * Get connection with other grahas.
     * 
     * @return array
     */
    public function isConjuncted()
    {
        $this->checkEnvironment();

        $isConjuncted = array();

        foreach (Graha::$graha as $key => $name){
            if($key == $this->objectKey) continue;

            if($this->ganitaData['graha'][$key]['rashi'] == $this->objectRashi){
                $isConjuncted[$key] = $name;
            }
        }
        return $isConjuncted;
    }

    /**
     * Returns an array of hemming grahas.
     * 
     * @return array
     */
    public function isHemmed()
    {
        $this->checkEnvironment();

        $isHemmed = array();
        $p = self::POS_PREV;
        $n = self::POS_NEXT;

        $$p = Math::numberPrev($this->objectRashi);
        $$n = Math::numberNext($this->objectRashi);

        foreach (Graha::$graha as $key => $name){
            if($key == $this->objectKey) continue;

            if($this->ganitaData['graha'][$key]['rashi'] == ${$n})
                $isHemmed[$key] = $n;
            elseif($this->ganitaData['graha'][$key]['rashi'] == ${$p})
                $isHemmed[$key] = $p;
        }

        if(!(array_search($p, $isHemmed) and array_search($n, $isHemmed)))
            $isHemmed = array();

        return $isHemmed;
    }
    
    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options = null)
    {
        $this->setOptions($options);
    }
}
