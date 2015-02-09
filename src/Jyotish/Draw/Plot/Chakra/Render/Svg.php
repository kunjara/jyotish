<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

/**
 * Class for rendering chakra as svg.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Svg extends AbstractRender implements \Jyotish\Draw\Renderer\SvgInterface {
    /**
     * Constructor
     * 
     * @param Svg $adapterObject
     */
    public function __construct($adapterObject) {
        parent::__construct($adapterObject);
    }
}