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
	const BHAVA_CHARA   = 'chara';
	const BHAVA_STHIRA  = 'sthira';
	const BHAVA_DVISVA  = 'dvisva';
	
	const BALA_RATRI    = 'ratri';
	const BALA_DINA     = 'dina';
	
	const DAYA_SIRSHA   = 'sirsha';
	const DAYA_PRUSHTA  = 'prushta';
	const DAYA_UBHAYA   = 'ubhaya';

	/**
	 * Array of all rashis.
	 * 
	 * @var array 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
	 */
	static public $rashi = array(
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
	static public $translit = ['ra','aa','sha','i'];

	/**
	 * Returns the requested instance of rashi class.
	 * 
	 * @param int $key The number of rashi
	 * @param null|array $options (Optional) Options to set
	 * @return the requested instance of rashi class
	 * @throws Exception\InvalidArgumentException
	 */
	static public function getInstance($key, $options = null) {
		if (array_key_exists($key, self::$rashi)) {
			$rashiClass = 'Jyotish\\Rashi\\Object\\R' . $key;
			$rashiObject = new $rashiClass($options);

			return $rashiObject;
		} else {
			throw new Exception\InvalidArgumentException("Rashi with the key '$key' does not exist.");
		}
	}
}