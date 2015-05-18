<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Traits;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * EnvironmentTrait provides operations with environment.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait EnvironmentTrait {
    /**
     * Environment - position of the planets in the format of the ganita output data.
     * 
     * @var array
     */
    protected $ganitaData = array();

    /**
     * Set environment.
     * 
     * @param array $ganitaData
     */
    public function setEnvironment(array $ganitaData)
    {
        $this->ganitaData = $ganitaData;

        if($this->objectType == 'rashi'){
            $this->objectRashi = $this->objectKey;
        }else{
            $this->objectRashi = $this->ganitaData[$this->objectType][$this->objectKey]['rashi'];
        }
        
        return $this;
    }

    /**
     * Check the environment.
     * 
     * @throws Exception\UnderflowException
     */
    protected function checkEnvironment()
    {
        if(empty($this->ganitaData)){
            throw new Exception\UnderflowException("Environment for object '{$this->objectType} {$this->objectKey}' must be setted.");
        }
    }
    
    /**
     * Get aspect by grahas.
     * 
     * @param null|array $options Options to set (optional)
     * @return array
     */
    public function isAspectedByGraha($options = null)
    {
        $this->checkEnvironment();
        
        foreach (Graha::$graha as $key => $name){
            $Graha = Graha::getInstance($key, $options);
            $grahaDrishti = $Graha->grahaDrishti;

            $distanse = Math::distanceInCycle(
                $this->ganitaData['graha'][$key]['rashi'], 
                $this->objectRashi
            );
            
            if($key == $this->objectKey or !isset($grahaDrishti[$distanse])) {
                $isAspected[$key] = null;
            }else{
                $isAspected[$key] =  $grahaDrishti[$distanse];
            }
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
     * Get conjunct with other grahas.
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
        $p = 'prev';
        $n = 'next';

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
}
