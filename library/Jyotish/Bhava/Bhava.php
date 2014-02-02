<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava;

/**
 * Class with Bhava names.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bhava {
	static public $BHAVA = array(
		1 => 'Tanu',
		2 => 'Dhana',
		3 => 'Sahaja',
		4 => 'Sukha',
		5 => 'Putra',
		6 => 'Ari',
		7 => 'Yuvati',
		8 => 'Mrityu',
		9 => 'Dharma',
		10 => 'Karma',
		11 => 'Labha',
		12 => 'Vyaya',
	);
	
	/**
	 * Devanagari title 'bhava' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'bha','aa','va'
	);
	
	static public $bhavaPurushartha;

	static public function getInstance($number, $options = null) {
		if (array_key_exists($number, self::$BHAVA)) {
			$bhavaClass = 'Jyotish\\Bhava\\Object\\B' . $number;
			$bhavaObject = new $bhavaClass($options);

			return $bhavaObject;
		} else {
			throw new Exception\InvalidArgumentException("Bhava with the number '$number' does not exist.");
		}
	}

}