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
class YogaObject {
	/**
	 * Yoga key
	 * 
	 * @var int
	 */
	protected $yogaKey;
	
	/**
	 * Deva of yoga.
	 * 
	 * @var string
	 */
	protected $yogaDeva;
	
	/**
	 * Get yoga Deva.
	 * 
	 * @return string
	 */
	public function getYogaDeva()
	{
		return $this->yogaDeva;
	}
	
	/**
	 * Constructor
	 * 
     * @param array $options
     */
	public function __construct($options)
	{
		return $this;
	}
}
