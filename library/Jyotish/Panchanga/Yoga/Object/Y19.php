<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

use Jyotish\Tattva\Jiva\Dwipada\Deva;

/**
 * Class of yoga 19.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Y19 extends YogaObject {
	/**
	 * Yoga key
	 * 
	 * @var int
	 */
	protected $yogaKey = 19;
	
	protected $yogaDeva = Deva::DEVA_INDRA;

	public function __construct($options) {
		parent::__construct($options);
	}

}