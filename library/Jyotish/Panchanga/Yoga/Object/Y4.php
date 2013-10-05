<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

use Jyotish\Tattva\Jiva\Deva;

/**
 * Class of yoga 4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Y4 extends \Jyotish\Panchanga\Yoga\Yoga {

	static public $yogaDeva = Deva::DEVA_PARVATI_DUGRA;

	public function __construct($options) {
		return $this;
	}

}