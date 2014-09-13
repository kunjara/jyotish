<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Tattva\Jiva\Manusha;

/**
 * Class of bhava 2.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B2 extends BhavaObject {
	/**
	 * Bhava key
	 * 
	 * @var int
	 */
	protected $bhavaKey = 2;
	
	/**
	 * Indications of bhava.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 3.
	 */
	protected $bhavaIndications = array(
		'wealth',
		'food',
		'family',
		'death',
		'enemies',
		'metals',
		'precious stones',
	);
	
	/**
	 * Purushartha of bhava.
	 * 
	 * @var string
	 */
	protected $bhavaPurushartha = Manusha::PURUSHARTHA_ARTHA;

	public function __construct($options) {
		parent::__construct($options);
	}

}