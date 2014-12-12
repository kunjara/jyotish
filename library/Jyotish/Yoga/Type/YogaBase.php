<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

/**
 * Base class for yoga combinations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class YogaBase implements \Iterator, \Countable{
    
    use \Jyotish\Base\DataTrait;
    
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
