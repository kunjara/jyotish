<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Graha\Graha;

/**
 * Class for generate East chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class East extends AbstractChakra
{
    /**
     * Chakra graha.
     * 
     * @var string
     */
    protected $chakraGraha = Graha::KEY_SY;
    
    /**
     * Chakra divider.
     * 
     * @var int
     */
    protected $chakraDivider = 3;
    
    /**
     * Coordinates of chakra bhavas.
     * 
     * @var array
     */
    protected $bhavaPoints = [
        1  => [1, 0,   2, 0,   2, 1,   1, 1],
        2  => [0, 0,   1, 0,   1, 1],
        3  => [0, 0,   1, 1,   0, 1],
        4  => [0, 1,   1, 1,   1, 2,   0, 2],
        5  => [0, 3,   0, 2,   1, 2],
        6  => [0, 3,   1, 2,   1, 3],
        7  => [1, 2,   2, 2,   2, 3,   1, 3],
        8  => [2, 2,   3, 3,   2, 3],
        9  => [2, 2,   3, 2,   3, 3],
        10 => [2, 1,   3, 1,   3, 2,   2, 2],
        11 => [3, 0,   3, 1,   2, 1],
        12 => [2, 0,   3, 0,   2, 1],
    ];

    /**
     * Get rashi label points.
     * 
     * @param array $options
     * @return array
     */
    public function getRashiLabelPoints(array $options)
    {
        $ratio = round($options['chakraSize'] / 3);
        $offsetBorder = $options['offsetBorder'];
        $offsetCorner3 = $offsetBorder * 3;
        $offsetCorner4 = $offsetBorder * 4;
        $rashis = $this->Analysis->getRashiInBhava($options['chakraVarga']);

        $myPoints = [];
        foreach ($rashis as $rashi => $bhava) {
            $bhava = $rashi;

            if ($bhava == 1) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][6] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][7] * $ratio - $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 2) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetCorner3;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 3) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetCorner4;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][3] * $ratio - $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 4) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 5) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][4] * $ratio - $offsetCorner4;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][5] * $ratio + $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 6) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][3] * $ratio + $offsetCorner3;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 7) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 8) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetCorner3;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 9) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetCorner4;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 10) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'top';
            } elseif ($bhava == 11) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][4] * $ratio + $offsetCorner4;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetBorder;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } else {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][4] * $ratio + $offsetBorder;
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetCorner3;
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'bottom';
            }
        }
        return $myPoints;
    }

    /**
     * Get body label points.
     * 
     * @param array $options
     * @return array
     */
    public function getBodyLabelPoints(array $options)
    {
        $ratio = round($options['chakraSize'] / 3);
        $offsetBorder = $options['offsetBorder'];
        $offsetCorner = $offsetBorder * 4;
        $offsetSum = [];
        $bodies = $this->Analysis->getBodyInRashi($options['chakraVarga']);

        $myPoints = [];
        foreach ($bodies as $graha => $bhava) {
            if (!isset($offsetSum[$bhava])) $offsetSum[$bhava] = 0;

            if ($bhava == 1 || $bhava == 4 || $bhava == 7 || $bhava == 10) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][6] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][7] * $ratio - $ratio / 2;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 2) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetBorder;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'top';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 3) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'top';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            } elseif ($bhava == 5) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'bottom';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            } elseif ($bhava == 6) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $offsetBorder;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'bottom';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 8) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio - $offsetBorder;
                $myPoints[$graha]['textAlign'] = 'right';
                $myPoints[$graha]['textValign'] = 'bottom';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 9) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][4] * $ratio - $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][5] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['textAlign'] = 'right';
                $myPoints[$graha]['textValign'] = 'bottom';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            } elseif ($bhava == 11) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $offsetBorder;
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $offsetCorner + $offsetSum[$bhava];
                $myPoints[$graha]['textAlign'] = 'right';
                $myPoints[$graha]['textValign'] = 'top';
                $offsetSum[$bhava] += $options['heightOffsetLabel'];
            } else {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio - $offsetCorner - $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio + $offsetBorder;
                $myPoints[$graha]['textAlign'] = 'right';
                $myPoints[$graha]['textValign'] = 'top';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
        }
        return $myPoints;
    }
}