<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Service;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;

/**
 * Jyotish Factory class.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Factory {

	public static $graha = null;
	public static $rashi = null;

	public static function getGraha($abbr, array $options = null) {
		if (!self::$graha) {
			self::$graha = Graha::getInstance($abbr, $options);
		}

		return self::$graha;
	}

	public static function getRashi($num, array $options = null) {
		if (!self::$rashi) {
			self::$rashi = Rashi::getInstance($num, $options);
		}

		return self::$rashi;
	}

}