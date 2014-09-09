<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi;

/**
 * Class with Rashi names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Rashi {
	const BHAVA_CHARA = 'chara';
	const BHAVA_STHIRA = 'sthira';
	const BHAVA_DVISVA = 'dvisva';

	/**
	 * Array of all rashis.
	 * 
	 * @var array 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
	 */
	static public $RASHI = array(
		1 => 'Mesha',
		2 => 'Vrishabha',
		3 => 'Mithuna',
		4 => 'Karka',
		5 => 'Simha',
		6 => 'Kanya',
		7 => 'Tula',
		8 => 'Vrishchika',
		9 => 'Dhanu',
		10 => 'Makara',
		11 => 'Kumbha',
		12 => 'Meena',
	);
	
	/**
	 * Devanagari 'rashi' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'ra','aa','sha','i'
	);
	
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
	 * Returns the requested instance of rashi class.
	 * 
	 * @param int $number The number of rashi.
	 * @param array $options
	 * @return the requested instance of rashi class.
	 */
	static public function getInstance($number, array $options = null) {
		if (array_key_exists($number, self::$RASHI)) {
			$rashiClass = 'Jyotish\\Rashi\\Object\\R' . $number;
			$rashiObject = new $rashiClass($options);

			return $rashiObject;
		} else {
			throw new Exception\InvalidArgumentException("Rashi with the number '$number' does not exist.");
		}
	}
}