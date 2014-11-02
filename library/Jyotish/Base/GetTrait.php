<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * GetTrait provides a common implementation of the 'get' interface.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait GetTrait {
    /**
     * Get object property.
     * 
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if(property_exists($this, $property)){
            return($this->$property);
        }else{
            throw new Exception\InvalidArgumentException("Property '$property' does not exist.");
        }
    }

    /**
     * Overloading 'getProperty' methods in jyotish objects.
     * 
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
        if(substr($name, 0, 3) == 'get'){
            $property = lcfirst(substr($name, 3));

            return $this->$property;
        }
    }
}
