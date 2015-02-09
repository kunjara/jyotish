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

    abstract public function getBhavaPoints($size, $left, $top);

    abstract public function getRashiLabelPoints(Data $drawData, array $options);

    abstract public function getBodyLabelPoints(Data $drawData, array $options);
}