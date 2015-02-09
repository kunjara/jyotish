<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Graha\Graha;
use Jyotish\Base\Data;

/**
 * Class for generate South chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class South extends AbstractChakra {

    protected $graha = Graha::KEY_GU;
    
    protected $bhavaPoints = array(
        1  => [2, 1,   1, 1,   1, 0,   2, 0],
        2  => [2, 1,   2, 0,   3, 0,   3, 1],
        3  => [3, 1,   3, 0,   4, 0,   4, 1],
        4  => [3, 2,   3, 1,   4, 1,   4, 2],
        5  => [3, 2,   4, 2,   4, 3,   3, 3],
        6  => [3, 3,   4, 3,   4, 4,   3, 4],
        7  => [2, 3,   3, 3,   3, 4,   2, 4],
        8  => [2, 3,   2, 4,   1, 4,   1, 3],
        9  => [1, 3,   1, 4,   0, 4,   0, 3],
        10 => [1, 2,   1, 3,   0, 3,   0, 2],
        11 => [1, 2,   0, 2,   0, 1,   1, 1],
        12 => [1, 1,   0, 1,   0, 0,   1, 0],
    );

    public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0) {
        foreach ($this->bhavaPoints as $bhavaKey => $bhavaPoints) {
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

    public function getRashiLabelPoints(Data $Data, array $options) {
        $ratio = round($options['chakraSize'] / 4);
        $rashis = $Data->getRashiInBhava();

        foreach ($rashis as $rashi) {
            $bhava = $rashi;

            if ($bhava == 1 or $bhava == 11 or $bhava == 12) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 2 or $bhava == 3 or $bhava == 4) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 5 or $bhava == 6 or $bhava == 7) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'top';
            } else {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'top';
            }
        }
        return $myPoints;
    }

    public function getBodyLabelPoints(Data $Data, array $options) {
        $ratio = round($options['chakraSize'] / 4);
        $offsetBorder = $options['offsetBorder'];
        $offsetSum = array();
        $bodies = $Data->getBodyInRashi();

        foreach ($bodies as $graha => $bhava) {
            if(!isset($offsetSum[$bhava])) $offsetSum[$bhava] = 0;

            if ($bhava == 1 or $bhava == 11 or $bhava == 12) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio - $ratio / 2;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 2 or $bhava == 3 or $bhava == 4) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $ratio / 2;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 5 or $bhava == 6 or $bhava == 7) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $ratio / 2;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } else {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][6] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][7] * $ratio + $ratio / 2;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
        }
        return $myPoints;
    }
}