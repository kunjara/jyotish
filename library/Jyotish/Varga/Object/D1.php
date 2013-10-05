<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Rashi\Rashi;

/**
 * Class of varga D1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D1 extends \Jyotish\Varga\Varga {

	static public $vargaAmsha = 1;

	public function __construct($options) {
		return $this;
	}
	
	public function getVargaRashi(array $ganitaRashi) {
		return $ganitaRashi;
	}

}