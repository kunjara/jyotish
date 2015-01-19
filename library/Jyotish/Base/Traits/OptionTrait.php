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
    protected function setOptions($options)
    {
        if (is_array($options)){
            foreach ($options as $optionName => $optionValue) {
                if (isset($this->options[$optionName])) {
                    $this->options[$optionName] = $optionValue;
                }else{
                    throw new \Jyotish\Base\Exception\InvalidArgumentException("Option '$optionName' does not exist.");
                }
            }
        }elseif(!is_null($options)){
            throw new \Jyotish\Base\Exception\InvalidArgumentException("Options must be an array.");
        }
    }
}
