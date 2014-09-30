<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Graha\Graha;
use Jyotish\Base\Data;

/**
 * Class for generate North chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class North extends AbstractChakra {

	static public $graha = Graha::GRAHA_SK;
	static private $_bhavaPoints = array(
		1 => array(
			2, 2,
			1, 1,
			2, 0,
			3, 1,
		),
		2 => array(
			1, 1,
			0, 0,
			2, 0,
		),
		3 => array(
			1, 1,
			0, 2,
			0, 0,
		),
		4 => array(
			2, 2,
			1, 3,
			0, 2,
			1, 1,
		),
		5 => array(
			1, 3,
			0, 4,
			0, 2,
		),
		6 => array(
			1, 3,
			2, 4,
			0, 4,
		),
		7 => array(
			2, 2,
			3, 3,
			2, 4,
			1, 3,
		),
		8 => array(
			3, 3,
			4, 4,
			2, 4,
		),
		9 => array(
			3, 3,
			4, 2,
			4, 4,
		),
		10 => array(
			2, 2,
			3, 1,
			4, 2,
			3, 3,
		),
		11 => array(
			3, 1,
			4, 0,
			4, 2,
		),
		12 => array(
			3, 1,
			2, 0,
			4, 0,
		),
	);

	public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0) {
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

	public function getRashiLabelPoints($size, array $labelRashi, Data $drawData) {
		$ratio = round($size / 4);
		$rashis = $drawData->getRashiInBhava();
		$offsetCorner = sqrt(2 * $labelRashi['offsetBorder'] * $labelRashi['offsetBorder']);

		foreach ($rashis as $rashi => $bhava) {
			if ($bhava == 1 or $bhava == 2 or $bhava == 12) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio;
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $offsetCorner;
				$myPoints[$rashi]['align'] = 'center';
				$myPoints[$rashi]['valign'] = 'bottom';
			} elseif ($bhava == 3 or $bhava == 4 or $bhava == 5) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio - $offsetCorner;
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio;
				$myPoints[$rashi]['align'] = 'right';
				$myPoints[$rashi]['valign'] = 'middle';
			} elseif ($bhava == 6 or $bhava == 7 or $bhava == 8) {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio;
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetCorner;
				$myPoints[$rashi]['align'] = 'center';
				$myPoints[$rashi]['valign'] = 'top';
			} else {
				$myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetCorner;
				$myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio;
				$myPoints[$rashi]['align'] = 'left';
				$myPoints[$rashi]['valign'] = 'middle';
			}
		}
		return $myPoints;
	}

	public function getGrahaLabelPoints($size, array $labelGraha, Data $drawData) {
		$ratio = round($size / 4);
		$offsetBorder = $labelGraha['offsetBorder'];
		$offsetCorner = $offsetBorder * 5;
		$offsetSum = array();
		$grahas = $drawData->getGrahaInBhava();

		foreach ($grahas as $graha => $value) {
			$bhava = $value['bhava'];
			$myPoints[$graha]['bhava'] = $bhava;

			if ($bhava == 1) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $offsetCorner - $offsetSum[$bhava];
				$myPoints[$graha]['align'] = 'center';
				$myPoints[$graha]['valign'] = 'bottom';
				$offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
			}
			if ($bhava == 2 or $bhava == 12) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio + $offsetCorner + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'top';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			}
			if ($bhava == 3 or $bhava == 5) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio + $offsetBorder;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio + $offsetCorner + $offsetSum[$bhava];
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'top';
				$offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
			}
			if ($bhava == 4) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio - $offsetSum[$bhava] - $offsetCorner;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio;
				$myPoints[$graha]['align'] = 'right';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			}
			if ($bhava == 6 or $bhava == 8) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio + $offsetCorner + $offsetSum[$bhava];
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'bottom';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			}
			if ($bhava == 7) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
				$myPoints[$graha]['align'] = 'center';
				$myPoints[$graha]['valign'] = 'top';
				$offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
			}
			if ($bhava == 9 or $bhava == 11) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio + $offsetCorner + $offsetSum[$bhava];
				$myPoints[$graha]['align'] = 'right';
				$myPoints[$graha]['valign'] = 'top';
				$offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
			}
			if ($bhava == 10) {
				$myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetSum[$bhava] + $offsetCorner;
				$myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio;
				$myPoints[$graha]['align'] = 'left';
				$myPoints[$graha]['valign'] = 'middle';
				$offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
			}
		}
		return $myPoints;
	}

}