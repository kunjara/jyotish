<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Traits;

/**
 * OptionTrait provides a setting options.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
Trait OptionTrait
{
    /**
     * Set options for jyotish calculations.
     * 
     * @param null|array $options Options to set (optional)
     * @return OptionTrait
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $optionName => $optionValue) {
                $option = 'option' . ucfirst($optionName);
                if (isset($this->$option)) {
                    $setOption = 'setOption' . ucfirst($optionName);
                    if (method_exists($this, $setOption)) {
                        $this->$setOption($optionValue);
                    } else {
                        $this->$option = $optionValue;
                    }
                }
            }
        } elseif (!is_null($options)) {
            throw new \Jyotish\Base\Exception\InvalidArgumentException("Options must be an array.");
        }
        
        return $this;
    }
    
    /**
     * Get options are set for jyotish calculations.
     * 
     * @return mixed
     */
    public function getOptions($optionName = null)
    {
        if (is_string($optionName)) {
            $option = 'option' . ucfirst($optionName);
            if (isset($this->$option)) {
                return $this->$option;
            }
        } elseif(is_null($optionName)) {
            $properties = get_object_vars($this);
            $options = [];
            foreach ($properties as $propertyName => $propertyValue) {
                $pos = strpos($propertyName, 'option');
                if ($pos === 0) {
                    $optionName = lcfirst(substr($propertyName, 6));
                    $options[$optionName] = $propertyValue;
                }
            }
            return $options;
        }
        return null;
    }
}
