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
class Object {

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
     * @var mixed
     */
    protected $objectKey = null;
    
    /**
     * Rashi, where object is located.
     * 
     * @var int
     */
    protected $objectRashi = null;

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
    }
}
