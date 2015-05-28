<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Base\Data;

/**
 * Class for generate Chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractChakra {
    /**
     * North Indian style
     */
    const STYLE_NORTH = 'north';
    /**
     * South Indian style
     */
    const STYLE_SOUTH = 'south';
    /**
     * Eastern Indian Style
     */
    const STYLE_EAST = 'east';

    static public $styles = array(
        self::STYLE_NORTH,
        self::STYLE_SOUTH,
        self::STYLE_EAST,
    );
    
    protected $bhavaPoints = array();
    
    protected $divider = null;

    public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0) {
        foreach ($this->bhavaPoints as $bhavaKey => $bhavaPoints) {
            foreach ($bhavaPoints as $point => $value) {
                if ($value != 0) {
                    if($point % 2){
                        $myPoints[$bhavaKey][] = $value * round($size / $this->divider) + $topOffset;
                    }else{
                        $myPoints[$bhavaKey][] = $value * round($size / $this->divider) + $leftOffset;
                    }
                } else {
                    $myPoints[$bhavaKey][] = $point % 2 ? $topOffset : $leftOffset;
                }
            }
        }

        return $myPoints;
    }

    abstract public function getRashiLabelPoints(Data $drawData, array $options);

    abstract public function getBodyLabelPoints(Data $drawData, array $options);
}