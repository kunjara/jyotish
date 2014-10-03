<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Base\Object;

/**
 * Parent class for rashi objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class RashiObject extends Object {
	/**
	 * Object type
	 * 
	 * @var string
	 */
	protected $objectType = 'rashi';
	
	/**
	 * Rashi key
	 * 
	 * @var int
	 */
	protected $objectKey;
	
	/**
	 * Devanagari rashi title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $rashiTranslit;
	
	/**
	 * Unicode of rashi.
	 * 
	 * @var string
	 */
	protected $rashiUnicode;
	
	/**
	 * Limb of Kaal Purush.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
	 */
	protected $rashiLimb;
	
	/**
	 * Bhava of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiBhava;
	
	/**
	 * Gender of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiGender;
	
	/**
	 * Prakriti of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
	 */
	protected $rashiPrakriti;
	
	/**
	 * Type of rashi.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 6-24.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
	 */
	protected $rashiType;

	/**
	 * Bhuta of rashi.
	 * 
	 * @var string
	 */
	protected $rashiBhuta;
	
	/**
	 * Ruler of rashi.
	 * 
	 * @var string
	 */
	protected $rashiRuler;


	/**
	 * Get rashi devanagari name.
	 *
	 * @return array
	 */
	public function getRashiTranslit()
	{
		return $this->rashiTranslit;
	}
	
	/**
	 * Get rashi unicode.
	 * 
	 * @return string
	 */
	public function getRashiUnicode()
	{
		return $this->rashiUnicode;
	}
	
	/**
	 * Get rashi limb.
	 * 
	 * @return string
	 */
	public function getRashiLimb()
	{
		return $this->rashiLimb;
	}
	
	/**
	 * Get rashi bhava.
	 * 
	 * @return string
	 */
	public function getRashiBhava()
	{
		return $this->rashiBhava;
	}
	
	/**
	 * Get rashi gender.
	 * 
	 * @return string
	 */
	public function getRashiGender()
	{
		return $this->rashiGender;
	}
	
	/**
	 * Get rashi prakriti.
	 * 
	 * @return string
	 */
	public function getRashiPrakriti()
	{
		return $this->rashiPrakriti;
	}
	
	/**
	 * Get rashi type.
	 * 
	 * @return string
	 */
	public function getRashiType()
	{
		return $this->rashiType;
	}
	
	/**
	 * Get rashi bhuta.
	 * 
	 * @return string
	 */
	public function getRashiBhuta()
	{
		return $this->rashiBhuta;
	}
	
	/**
	 * Get rashi ruler.
	 * 
	 * @return string
	 */
	public function getRashiRuler()
	{
		return $this->rashiRuler;
	}
	
	/**
	 * Get rashi varna.
	 * 
	 * @return string
	 */
	public function getRashiVarna()
	{
		return $this->rashiVarna;
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
