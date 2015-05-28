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

    protected $graha = Graha::KEY_SK;
    
    protected $bhavaPoints = array(
        1  => [2, 2,   1, 1,   2, 0,   3, 1],
        2  => [1, 1,   0, 0,   2, 0],
        3  => [1, 1,   0, 2,   0, 0],
        4  => [2, 2,   1, 3,   0, 2,   1, 1],
        5  => [1, 3,   0, 4,   0, 2],
        6  => [1, 3,   2, 4,   0, 4],
        7  => [2, 2,   3, 3,   2, 4,   1, 3],
        8  => [3, 3,   4, 4,   2, 4],
        9  => [3, 3,   4, 2,   4, 4],
        10 => [2, 2,   3, 1,   4, 2,   3, 3],
        11 => [3, 1,   4, 0,   4, 2],
        12 => [3, 1,   2, 0,   4, 0,]
    );
    
    protected $divider = 4;

    public function getRashiLabelPoints(Data $Data, array $options) {
        $ratio = round($options['chakraSize'] / 4);
        $rashis = $Data->getRashiInBhava();
        $offsetCorner = sqrt(2 * $options['offsetBorder'] * $options['offsetBorder']);

        foreach ($rashis as $rashi => $bhava) {
            if ($bhava == 1 or $bhava == 2 or $bhava == 12) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $offsetCorner;
                $myPoints[$rashi]['align'] = 'center';
                $myPoints[$rashi]['valign'] = 'bottom';
            } elseif ($bhava == 3 or $bhava == 4 or $bhava == 5) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $offsetCorner;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio;
                $myPoints[$rashi]['align'] = 'right';
                $myPoints[$rashi]['valign'] = 'middle';
            } elseif ($bhava == 6 or $bhava == 7 or $bhava == 8) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetCorner;
                $myPoints[$rashi]['align'] = 'center';
                $myPoints[$rashi]['valign'] = 'top';
            } else {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetCorner;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio;
                $myPoints[$rashi]['align'] = 'left';
                $myPoints[$rashi]['valign'] = 'middle';
            }
        }
        return $myPoints;
    }

    public function getBodyLabelPoints(Data $Data, array $options) {
        $ratio = round($options['chakraSize'] / 4);
        $offsetBorder = $options['offsetBorder'];
        $offsetCorner = $offsetBorder * 5;
        $offsetSum = array();
        $bodies = $Data->getBodyInBhava();

        foreach ($bodies as $graha => $bhava) {
            $myPoints[$graha]['bhava'] = $bhava;
            if(!isset($offsetSum[$bhava])) $offsetSum[$bhava] = 0;
                
            if ($bhava == 1) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'center';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            }
            if ($bhava == 2 or $bhava == 12) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
            if ($bhava == 3 or $bhava == 5) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][4] * $ratio + $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][5] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            }
            if ($bhava == 4) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $offsetSum[$bhava] - $offsetCorner;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio;
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
            if ($bhava == 6 or $bhava == 8) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][4] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'bottom';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
            if ($bhava == 7) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'center';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            }
            if ($bhava == 9 or $bhava == 11) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['align'] = 'right';
                $myPoints[$graha]['valign'] = 'top';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            }
            if ($bhava == 10) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetSum[$bhava] + $offsetCorner;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio;
                $myPoints[$graha]['align'] = 'left';
                $myPoints[$graha]['valign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
        }
        return $myPoints;
    }
}