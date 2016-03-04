<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * Base class for Jyotish objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Object
{
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Type of object.
     * 
     * @var string
     */
    protected $objectType = null;

    /**
     * Abbreviation of the object.
     * 
     * @var string|int
     */
    protected $objectKey = null;

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
    protected $objectNames = [];

    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        $this->setOptions($options);
        
        $this->setObjectName();
        $this->setObjectNames();
    }
    
    /**
     * Set main name of the object.
     * 
     * @return void
     */
    protected function setObjectName()
    {
        $objectType = $this->objectType;
        $objectName = ucfirst($objectType);
        $className = 'Jyotish\\' . $objectName . '\\' . $objectName;
        
        $list = $className::$$objectType;
        
        $this->objectName = $list[$this->objectKey];
    }
    
    /**
     * Set names of the object.
     * 
     * @return void
     */
    protected function setObjectNames()
    {
        $this->objectNames = array_merge([$this->objectName], $this->objectNames);
    }
}
