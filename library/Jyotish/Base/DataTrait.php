<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * DataTrait provides a data operations.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait DataTrait {
    /**
     * Analyzed data.
     * 
     * @var array
     */
    protected $ganitaData = array();
    
    /**
     * Set data.
     * 
     * @param \Jyotish\Base\Data|array $data
     * @throws Exception\InvalidArgumentException
     */
    public function setData($data) {
        if(
            (is_object($data) && !($data instanceof \Jyotish\Base\Data)) ||
            (!is_object($data) && !is_array($data))
        ){
            throw new Exception\InvalidArgumentException(
                "Data should be an array or instance of Jyotish\\Base\\Data"
            );
        }

        if (is_object($data)) {
            $this->ganitaData = $data->getData();
        }else{
            $this->ganitaData = $data;
        }
    }
    
    /**
     * Get data.
     * 
     * @return array
     */
    public function getData()
    {
        return $this->ganitaData;
    }
}
