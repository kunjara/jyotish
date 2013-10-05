<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra;

use Jyotish\Draw\Plot\Chakra\AbstractChakra;
use Jyotish\Graha\Graha;

/**
 * Class for generate South chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class South extends AbstractChakra {

	static public $graha = Graha::GRAHA_GU;
	static private $_bhavaPoints = array(
		1 => array(
			2, 1,
			1, 1,
			1, 0,
			2, 0,
		),
		2 => array(
			2, 1,
			2, 0,
			3, 0,
			3, 1,
		),
		3 => array(
			3, 1,
			3, 0,
			4, 0,
			4, 1
		),
		4 => array(
			3, 2,
			3, 1,
			4, 1,
			4, 2,
		),
		5 => array(
			3, 2,
			4, 2,
			4, 3,
			3, 3,
		),
		6 => array(
			3, 3,
			4, 3,
			4, 4,
			3, 4
		),
		7 => array(
			2, 3,
			3, 3,
			3, 4,
			2, 4,
		),
		8 => array(
			2, 3,
			2, 4,
			1, 4,
			1, 3,
		),
		9 => array(
			1, 3,
			1, 4,
			0, 4,
			0, 3
		),
		10 => array(
			1, 2,
			1, 3,
			0, 3,
			0, 2,
		),
		11 => array(
			1, 2,
			0, 2,
			0, 1,
			1, 1,
		),
		12 => array(
			1, 1,
			0, 1,
			0, 0,
			1, 0,
		),
	);

	static public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0) {
		foreach (self::$_bhavaPoints as $bhavaKey => $bhavaPoints) {
			foreach ($bhavaPoints as $point => $value) {
				if ($value != 0) {
					$myPoints[$bhavaKey][] = $point % 2 ? $value * round($size / 4) + $topOffset : $value * round($size / 4) + $leftOffset;
				} else {
					$myPoints[$bhavaKey][] = $point % 2 ? $topOffset : $leftOffset;
				}
			}
		}

		return $myPoints;
	}

	public function getRashiLabelPoints($size, array $labelRashi, \Jyotish\Draw\Data $drawData) {
		$ratio = round($size / 4);
		$rashis = $drawData->getRashiInBhava();

		foreach ($rashis as $rashi) {
			$bhava = $rashi;

			if ($bhava == 1 or $bhava == 11 or $bhava == 12) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio - $labelRashi['offsetBorder'];
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $labelRashi['offsetBorder'];
				$myPoints[$rashi]['align'] = 'right';
				$myPoints[$rashi]['valign'] = 'bottom';
			} elseif ($bhava == 2 or $bhava == 3 or $bhava == 4) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $labelRashi['offsetBorder'];
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $labelRashi['offsetBorder'];
				$myPoints[$rashi]['align'] = 'left';
				$myPoints[$rashi]['valign'] = 'bottom';
			} elseif ($bhava == 5 or $bhava == 6 or $bhava == 7) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $labelRashi['offsetBorder'];
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $labelRashi['offsetBorder'];
				$myPoints[$rashi]['align'] = 'left';
				$myPoints[$rashi]['valign'] = 'top';
			} else {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio - $labelRashi['offsetBorder'];
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $labelRashi['offsetBorder'];
				$myPoints[$rashi]['align'] = 'right';
				$myPoints[$rashi]['valign'] = 'top';
			}
		}
		return $myPoints;
	}

	public function getGrahaLabelPoints($size, array $labelGraha, \Jyotish\Draw\Data $drawData) {
		$ratio = round($size / 4);
		$offsetBorder = $labelGraha['offsetBorder'];
		$offsetSum = array();
		$grahas = $drawData->getGrahaInRashi();

		foreach ($grahas as $graha => $value) {
			$rashi = $value['rashi'];
			$bhava = $rashi;

			$label = $drawData->getGrahaLabel($graha, $labelGraha['labelType'], $labelGraha['labelCallback']);

			if ($bhava == 1 or $bhava == 11 or $bhava == 12) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio + $offsetBorder + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio - $ratio / 2;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			} elseif ($bhava == 2 or $bhava == 3 or $bhava == 4) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $ratio / 2;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			} elseif ($bhava == 5 or $bhava == 6 or $bhava == 7) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $ratio / 2;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			} else {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][6] * $ratio + $offsetBorder + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][7] * $ratio + $ratio / 2;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			}
		}
		return $myPoints;
	}

}