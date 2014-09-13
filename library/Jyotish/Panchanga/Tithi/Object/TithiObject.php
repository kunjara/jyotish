<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

/**
 * Parent class for tithi objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class TithiObject {
	/**
	 * Tithi key
	 * 
	 * @var int
	 */
	protected $tithiKey;
	
	/**
	 * Devanagari tithi title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $tithiTranslit = array();
	
	/**
	 * Deva of tithi.
	 * 
	 * @var string
	 */
	protected $tithiDeva;
	
	/**
	 * Paksha of tithi.
	 * 
	 * @var string
	 */
	protected $tithiPaksha;
	
	/**
	 * Type of tithi.
	 * 
	 * @var string
	 */
	protected $tithiType;
	
	/**
	 * Karana of tithi.
	 * 
	 * @var string
	 */
	protected $tithiKarana = array();

	/**
	 * Get tithi translit.
	 * 
	 * @return array
	 */
	public function getTithiTranslit()
	{
		return $this->tithiTranslit;
	}
	
	/**
	 * Get tithi deva.
	 * 
	 * @return string
	 */
	public function getTithiDeva()
	{
		return $this->tithiDeva;
	}
	
	/**
	 * Get tithi paksha.
	 * 
	 * @return string
	 */
	public function getTithiPaksha()
	{
		return $this->tithiPaksha;
	}
	
	/**
	 * Get tithi type.
	 * 
	 * @return string
	 */
	public function getTithiType()
	{
		return $this->tithiType;
	}
	
	/**
	 * Get tithi karana.
	 * 
	 * @return array
	 */
	public function getTithiKarana()
	{
		return $this->tithiKarana;
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
