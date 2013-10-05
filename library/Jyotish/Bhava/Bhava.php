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

	const BHAVA_1 = 1;
	const BHAVA_2 = 2;
	const BHAVA_3 = 3;
	const BHAVA_4 = 4;
	const BHAVA_5 = 5;
	const BHAVA_6 = 6;
	const BHAVA_7 = 7;
	const BHAVA_8 = 8;
	const BHAVA_9 = 9;
	const BHAVA_10 = 10;
	const BHAVA_11 = 11;
	const BHAVA_12 = 12;

	static public $BHAVA = array(
		self::BHAVA_1 => 'Tanu',
		self::BHAVA_2 => 'Dhana',
		self::BHAVA_3 => 'Sahaja',
		self::BHAVA_4 => 'Sukha',
		self::BHAVA_5 => 'Putra',
		self::BHAVA_6 => 'Ari',
		self::BHAVA_7 => 'Yuvati',
		self::BHAVA_8 => 'Mrityu',
		self::BHAVA_9 => 'Dharma',
		self::BHAVA_10 => 'Karma',
		self::BHAVA_11 => 'Labha',
		self::BHAVA_12 => 'Vyaya',
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