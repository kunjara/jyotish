<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Graha\Graha;

/**
 * Class for generate South chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
final class South extends AbstractChakra
{
    /**
     * Chakra graha.
     * 
     * @var string
     */
    protected $chakraGraha = Graha::KEY_GU;
    
    /**
     * Chakra divider.
     * 
     * @var int
     */
    protected $chakraDivider = 4;
    
    /**
     * Coordinates of chakra bhavas.
     * 
     * @var array
     */
    protected $bhavaPoints = [
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
    ];

    /**
     * Get rashi label points.
     * 
     * @param array $options
     * @return array
     */
    public function getRashiLabelPoints(array $options)
    {
        $ratio = round($options['chakraSize'] / 4);
        $rashis = $this->Analysis->getRashiInBhava($options['chakraVarga']);

        $myPoints = [];
        foreach ($rashis as $rashi) {
            $bhava = $rashi;

            if ($bhava == 1 || $bhava == 11 || $bhava == 12) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 2 || $bhava == 3 || $bhava == 4) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'bottom';
            } elseif ($bhava == 5 || $bhava == 6 || $bhava == 7) {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['textAlign'] = 'left';
                $myPoints[$rashi]['textValign'] = 'top';
            } else {
                $myPoints[$rashi]['x'] = $this->bhavaPoints[$bhava][0] * $ratio - $options['offsetBorder'];
                $myPoints[$rashi]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $options['offsetBorder'];
                $myPoints[$rashi]['textAlign'] = 'right';
                $myPoints[$rashi]['textValign'] = 'top';
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
        $ratio = round($options['chakraSize'] / 4);
        $offsetBorder = $options['offsetBorder'];
        $offsetSum = [];
        $bodies = $this->Analysis->getBodyInRashi($options['chakraVarga']);

        $myPoints = [];
        foreach ($bodies as $graha => $bhava) {
            if (!isset($offsetSum[$bhava])) $offsetSum[$bhava] = 0;

            if ($bhava == 1 || $bhava == 11 || $bhava == 12) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][2] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][3] * $ratio - $ratio / 2;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 2 || $bhava == 3 || $bhava == 4) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio - $ratio / 2;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } elseif ($bhava == 5 || $bhava == 6 || $bhava == 7) {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][0] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][1] * $ratio + $ratio / 2;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            } else {
                $myPoints[$graha]['x'] = $this->bhavaPoints[$bhava][6] * $ratio + $offsetBorder + $offsetSum[$bhava];
                $myPoints[$graha]['y'] = $this->bhavaPoints[$bhava][7] * $ratio + $ratio / 2;
                $myPoints[$graha]['textAlign'] = 'left';
                $myPoints[$graha]['textValign'] = 'middle';
                $offsetSum[$bhava] += $options['widthOffsetLabel'];
            }
        }
        return $myPoints;
    }
}