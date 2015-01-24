<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Graha\Graha;
use Jyotish\Base\Data;

/**
 * Class for generate East chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class East extends AbstractChakra {

    static public $graha = Graha::KEY_SY;
    static private $_bhavaPoints = array(
        1 => array(
            1, 0,
            2, 0,
            2, 1,
            1, 1,
        ),
        2 => array(
            0, 0,
            1, 0,
            1, 1,
        ),
        3 => array(
            0, 0,
            1, 1,
            0, 1,
        ),
        4 => array(
            0, 1,
            1, 1,
            1, 2,
            0, 2,
        ),
        5 => array(
            0, 3,
            0, 2,
            1, 2,
        ),
        6 => array(
            0, 3,
            1, 2,
            1, 3,
        ),
        7 => array(
            1, 2,
            2, 2,
            2, 3,
            1, 3,
        ),
        8 => array(
            2, 2,
            3, 3,
            2, 3,
        ),
        9 => array(
            2, 2,
            3, 2,
            3, 3,
        ),
        10 => array(
            2, 1,
            3, 1,
            3, 2,
            2, 2,
        ),
        11 => array(
            3, 0,
            3, 1,
            2, 1,
        ),
        12 => array(
            2, 0,
            3, 0,
            2, 1,
        ),
    );

    public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0) {
        foreach (self::$_bhavaPoints as $bhavaKey => $bhavaPoints) {
            foreach ($bhavaPoints as $point => $value) {
                if ($value != 0) {
                    $myPoints[$bhavaKey][] = $point % 2 ? $value * round($size / 3) + $topOffset : $value * round($size / 3) + $leftOffset;
                } else {
                    $myPoints[$bhavaKey][] = $point % 2 ? $topOffset : $leftOffset;
                }
            }
        }

        return $myPoints;
    }

    public function getRashiLabelPoints($size, array $labelRashi, Data $drawData) {
        $ratio = round($size / 3);
        $offsetBorder = $labelRashi['offsetBorder'];
        $offsetCorner3 = $offsetBorder * 3;
        $offsetCorner4 = $offsetBorder * 4;
        $rashis = $drawData->getRashiInBhava();

        foreach ($rashis as $rashi => $bhava) {
            $bhava = $rashi;

            if ($bhava == 1) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][6] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][7] * $ratio - $offsetBorder;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 2) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetCorner3;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 3) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetCorner4;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio - $offsetBorder;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 4) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 5) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio - $offsetCorner4;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio + $offsetBorder;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 6) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio + $offsetCorner3;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 7) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 8) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetCorner3;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 9) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetCorner4;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 10) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'top';
            } elseif ($bhava == 11) {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio + $offsetCorner4;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'bottom';
            } else {
                $myPoints[$rashi]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetCorner3;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'bottom';
            }
        }
        return $myPoints;
    }

    public function getGrahaLabelPoints($size, array $labelGraha, Data $drawData) {
        $ratio = round($size / 3);
        $offsetBorder = $labelGraha['offsetBorder'];
        $offsetCorner = $offsetBorder * 4;
        $offsetSum = array();
        $grahas = $drawData->getGrahaInRashi();

        foreach ($grahas as $graha => $value) {
            $bhava = $value['rashi'];
            if(!isset($offsetSum[$bhava])) $offsetSum[$bhava] = 0;

            if ($bhava == 1 or $bhava == 4 or $bhava == 7 or $bhava == 10) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][6] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][7] * $ratio - $ratio / 2;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
            } elseif ($bhava == 2) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
            } elseif ($bhava == 3) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
            } elseif ($bhava == 5) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
            } elseif ($bhava == 6) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio - $offsetBorder;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
            } elseif ($bhava == 8) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio - $offsetBorder;
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
            } elseif ($bhava == 9) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][5] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
            } elseif ($bhava == 11) {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][0] * $ratio - $offsetBorder;
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $labelGraha['heightOffsetLabel'];
            } else {
                $myPoints[$graha]['x'] = self::$_bhavaPoints[$bhava][2] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['y'] = self::$_bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $labelGraha['widthOffsetLabel'];
            }
        }
        return $myPoints;
    }
}