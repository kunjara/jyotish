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
Trait OptionTrait {
    /**
     * Set options for jyotish calculations.
     * 
     * @param null|array $options Options to set(optional)
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions($options)
    {
        if (is_array($options)){
            foreach ($options as $optionName => $optionValue) {
                if (isset($this->options[$optionName])) {
                    $setOption = 'setOption'.ucfirst($optionName);
                    if(method_exists($this, $setOption)){
                        $this->$setOption($optionValue);
                    }else{
                        $this->options[$optionName] = $optionValue;
                    }
                }
            }
        }elseif(!is_null($options)){
            throw new \Jyotish\Base\Exception\InvalidArgumentException("Options must be an array.");
        }
        
        return $this;
    }
}
