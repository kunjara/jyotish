<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

use Jyotish\Tattva\Jiva\Deva;

/**
 * Class of yoga 15.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Y15 extends YogaObject {
	/**
	 * Yoga key
	 * 
	 * @var int
	 */
	protected $yogaKey = 15;
	
	protected $yogaDeva = Deva::DEVA_HIRANYAGARBHA;

	public function __construct($options) {
		parent::__construct($options);
	}

}