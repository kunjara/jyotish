<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of bhava 5.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B5 extends BhavaObject {
	/**
	 * Bhava key
	 * 
	 * @var int
	 */
	protected $bhavaKey = 5;
	
	/**
	 * Indications of bhava.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 6.
	 */
	protected $bhavaIndications = array(
		'amulets',
		'sacred spells',
		'learning',
		'knowledge',
		'sons',
		'royalty',
		'fall of position',
	);
	
	/**
	 * Purushartha of bhava.
	 * 
	 * @var string
	 */
	protected $bhavaPurushartha = Manusha::PURUSHARTHA_DHARMA;

	public function __construct($options) {
		parent::__construct($options);
	}

}