<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha {
	const GRAHA_SY = 'Sy';
	const GRAHA_CH = 'Ch';
	const GRAHA_MA = 'Ma';
	const GRAHA_BU = 'Bu';
	const GRAHA_GU = 'Gu';
	const GRAHA_SK = 'Sk';
	const GRAHA_SA = 'Sa';
	const GRAHA_RA = 'Ra';
	const GRAHA_KE = 'Ke';
	
	const LAGNA = 'Lg';
	
	const CHARACTER_BENEFIC = 'benefic';
	const CHARACTER_MALEFIC = 'malefic';
	const CHARACTER_MISHA   = 'mishra';
	
	const RISING_NOREFRAC   = 'norefrac';
	const RISING_DISCCENTER = 'disccenter';
	const RISING_HINDU      = 'hindu';
	
	/**
	 * Names of Grahas.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
	 */
	static public $graha = array(
		self::GRAHA_SY => 'Surya',
		self::GRAHA_CH => 'Chandra',
		self::GRAHA_MA => 'Mangala',
		self::GRAHA_BU => 'Budha',
		self::GRAHA_GU => 'Guru',
		self::GRAHA_SK => 'Shukra',
		self::GRAHA_SA => 'Shani',
		self::GRAHA_RA => 'Rahu',
		self::GRAHA_KE => 'Ketu'
	);
	
	/**
	 * Specifications for risings and settings.
	 * 
	 * @var array
	 */
	static public $risingType = array(
		self::RISING_NOREFRAC,
		self::RISING_DISCCENTER,
		self::RISING_HINDU,
	);
	
	/**
	 * Devanagari 'graha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'ga','virama','ra','ha'
	);

	/**
	 * Returns the requested instance of graha class.
	 * 
	 * @param string $key The acronym of graha
	 * @param null|array $options (Optional) Options to set
	 * @return the requested instance of graha class
	 * @throws Exception\InvalidArgumentException
	 */
	static public function getInstance($key, $options = null) {
		if (array_key_exists($key, self::$graha)) {
			$grahaClass = 'Jyotish\Graha\Object\\' . $key;
			$grahaObject = new $grahaClass($options);

			return $grahaObject;
		} else {
			throw new Exception\InvalidArgumentException("Graha with the key '$key' does not exist.");
		}
	}

}