<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Tattva\Jiva\Dwipada\Manusha;

/**
 * Class of bhava 7.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B7 extends BhavaObject {
	/**
	 * Bhava key
	 * 
	 * @var int
	 */
	protected $bhavaKey = 7;
	
	/**
	 * Indications of bhava.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 8.
	 */
	protected $bhavaIndications = array(
		'wife',
		'travel',
		'trade',
		'loss of sight',
		'death',
	);
	
	/**
	 * Purushartha of bhava.
	 * 
	 * @var string
	 */
	protected $bhavaPurushartha = Manusha::PURUSHARTHA_KAMA;

	public function __construct($options) {
		parent::__construct($options);
	}

}