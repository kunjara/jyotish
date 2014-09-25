<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Class of yoga 8.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Y8 extends YogaObject {
	/**
	 * Yoga key
	 * 
	 * @var int
	 */
	protected $yogaKey = 8;
	
	protected $yogaDeva = Deva::DEVA_RATRI;

	public function __construct($options) {
		parent::__construct($options);
	}

}