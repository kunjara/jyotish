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
trait EnvironmentTrait
{
    /**
     * Instance of Data.
     * 
     * @var \Jyotish\Base\Data
     */
    protected $Data = null;
    
    /**
     * Rashi, where object is located.
     * 
     * @var int
     */
    protected $objectRashi = null;

    /**
     * Set environment.
     * 
     * @param \Jyotish\Base\Data $Data
     * @return \Jyotish\Base\BaseObject
     */
    public function setEnvironment(\Jyotish\Base\Data $Data)
    {
        $this->Data = $Data;
        
        if (!isset($this->Data->getData()['graha'])) {
            $this->Data->calcParams();
        }

        if ($this->objectType == 'rashi') {
            $this->objectRashi = $this->objectKey;
        } else {
            $this->objectRashi = $this->Data->getData()[$this->objectType][$this->objectKey]['rashi'];
        }
        
        return $this;
    }
    
    /**
     * Get environment.
     * 
     * @return array
     */
    public function getEnvironment()
    {
        return $this->Data->getData();
    }
    
    /**
     * Get aspect by grahas.
     * 
     * @param null|array $options Options to set (optional)
     * @return array
     */
    public function isAspectedByGraha($options = null)
    {
        $isAspected = [];
        foreach (Graha::$graha as $key => $name) {
            $Graha = Graha::getInstance($key, $options);
            $grahaDrishti = $Graha->grahaDrishti;

            $distanse = Math::distanceInCycle(
                $this->getEnvironment()['graha'][$key]['rashi'], 
                $this->objectRashi
            );
            
            if ($key == $this->objectKey || !isset($grahaDrishti[$distanse])) {
                $isAspected[$key] = null;
            } else {
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
        $isAspected = [];
        
        $isAspected['rashi'] = [];
        foreach (Rashi::$rashi as $key => $name) {
            if ($key == $this->objectKey) continue;
            
            $Rashi = Rashi::getInstance($key);
            $rashiDrishti = $Rashi->rashiDrishti;
            
            if (isset($rashiDrishti[$this->objectRashi])) {
                $isAspected['rashi'][$key] = $rashiDrishti[$this->objectRashi];
            }
        }
        
        $isAspected['graha'] = [];
        foreach (Graha::$graha as $key => $name) {
            $grahaRashi = $this->getEnvironment()['graha'][$key]['rashi'];
            if (array_key_exists($grahaRashi, $isAspected['rashi'])) {
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
        $isConjuncted = [];

        foreach (Graha::$graha as $key => $name) {
            if ($key == $this->objectKey) continue;

            if ($this->getEnvironment()['graha'][$key]['rashi'] == $this->objectRashi) {
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
        $isHemmed = [];
        $p = 'prev';
        $n = 'next';

        $$p = Math::numberPrev($this->objectRashi);
        $$n = Math::numberNext($this->objectRashi);

        foreach (Graha::$graha as $key => $name) {
            if ($key == $this->objectKey) continue;

            if ($this->getEnvironment()['graha'][$key]['rashi'] == ${$n})
                $isHemmed[$key] = $n;
            elseif ($this->getEnvironment()['graha'][$key]['rashi'] == ${$p})
                $isHemmed[$key] = $p;
        }

        if (!(array_search($p, $isHemmed) && array_search($n, $isHemmed)))
            $isHemmed = [];

        return $isHemmed;
    }
    
    /**
     * Determine if the jyotish object is affected.
     * 
     * @param null|string $feature Feature of graha (optional)
     * @param null|string $value Value of feature (optional)
     * @return bool|array
     */
    public function isAffected($feature = null, $value = null)
    {
        if (is_null($feature)) {
            $grahas = Graha::$graha;
        } else {
            $grahas = Graha::listGrahaByFeature($feature, $value);
        }
        
        $grahaAspected = array_intersect_key($this->isAspectedByGraha(), $grahas);
        $grahaAspected1 = array_intersect($grahaAspected, [1]);
        if (count($grahaAspected1)) {
            $isAspected = $grahaAspected1;
        } else {
            $isAspected = false;
        }
        
        $grahaConjuncted = array_intersect_key($this->isConjuncted(), $grahas);
        if (count($grahaConjuncted)) {
            $isConjuncted = $grahaConjuncted;
        } else {
            $isConjuncted = false;
        }
        
        $grahaHemmed = array_intersect_key($this->isHemmed(), $grahas);
        if (array_search('prev', $grahaHemmed) && array_search('next', $grahaHemmed)) {
            $isHemmed = $grahaHemmed;
        } else {
            $isHemmed = false;
        }

        if ($isHemmed || $isAspected || $isConjuncted) {
            return [
                'aspect' => $isAspected,
                'conjunct' => $isConjuncted,
                'hem' => $isHemmed,
            ];
        } else {
            return false;
        }
    }
}
