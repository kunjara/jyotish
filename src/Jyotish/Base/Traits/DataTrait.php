<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Traits;

/**
 * DataTrait provides a data operations.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait DataTrait {
    /**
     * Instance of Data.
     * 
     * @var Data
     */
    protected $Data = null;
    
    /**
     * Temporary data.
     * 
     * @var array;
     */
    protected $temp = null;

    /**
     * Set Data
     * 
     * @param \Jyotish\Base\Data $Data
     * @return type
     */
    public function setData(\Jyotish\Base\Data $Data)
    {
        $this->Data = $Data;
        
        return $this;
    }

    /**
     * Get data
     * 
     * @return array
     */
    public function getData()
    {
        return $this->Data->getData();
    }
}
