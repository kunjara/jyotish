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
	/**
	 * Environment - position of the planets in the format of the ganita output data.
	 * 
	 * @var array
	 */
	protected $ganitaData = null;
	
	/**
	 * Set environment.
	 * 
	 * @param array $ganitaData
	 */
	public function setEnvironment(array $ganitaData)
	{
		$this->ganitaData = $ganitaData;
	}
}
