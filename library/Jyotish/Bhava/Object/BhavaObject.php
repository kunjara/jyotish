<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Base\Object;
use Jyotish\Rashi\Rashi;

/**
 * Parent class for bhava objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class BhavaObject extends Object {
	/**
	 * Object type
	 * 
	 * @var string
	 */
	protected $objectType = 'bhava';
	
	/**
	 * Bhava key
	 * 
	 * @var int
	 */
	protected $objectKey;
	
	/**
	 * Devanagari bhava title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $bhavaTranslit;
	
	/**
	 * Indications of bhava.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 2-13.
	 */
	protected $bhavaIndications = array();

	/**
	 * Purushartha of bhava.
	 * 
	 * @var string
	 */
	protected $bhavaPurushartha;
	
	/**
	 * Get bhava purushartha.
	 * 
	 * @return string
	 */
	public function getBhavaPurushartha()
	{
		return $this->bhavaPurushartha;
	}
	
	/**
	 * Get bhava ruler (lord).
	 * 
	 * @return string
	 */
	public function getRuler()
	{
		$this->checkEnvironment();
		
		$rashi = $this->ganitaData['bhava'][$this->objectKey]['rashi'];
		$Rashi = Rashi::getInstance((int)$rashi);
		$ruler = $Rashi->getRashiRuler();
		
		return $ruler;
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
