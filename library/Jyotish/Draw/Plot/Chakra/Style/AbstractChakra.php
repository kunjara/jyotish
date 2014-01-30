<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

/**
 * Class for generate Chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractChakra {

	const STYLE_NORTH = 'north';
	const STYLE_SOUTH = 'south';
	const STYLE_EAST = 'east';

	static public $styles = array(
		self::STYLE_NORTH,
		self::STYLE_SOUTH,
		self::STYLE_EAST,
	);
	static private $_bhavaPoints = array();

	abstract static public function getBhavaPoints($size, $left, $top);

	abstract public function getRashiLabelPoints($size, array $labelRashi, \Jyotish\Draw\Data $drawData);

	abstract public function getGrahaLabelPoints($size, array $labelGraha, \Jyotish\Draw\Data $drawData);
}