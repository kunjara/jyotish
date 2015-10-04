<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

/**
 * Parent class for yoga objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class YogaObject extends \Jyotish\Panchanga\AngaObject
{
    use \Jyotish\Base\Traits\GetTrait;

    /**
     * Anga type.
     * 
     * @var string
     */
    protected $angaType = 'yoga';
    
    /**
     * Yoga key.
     * 
     * @var int
     */
    protected $yogaKey;
    
    /**
     * Yoga name.
     * 
     * @var string
     */
    protected $yogaName;

    /**
     * Deva of yoga.
     * 
     * @var string
     */
    protected $yogaDeva;
}
