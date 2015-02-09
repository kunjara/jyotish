<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

/**
 * Class for rendering chakra as image.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Image extends AbstractRender implements \Jyotish\Draw\Renderer\ImageInterface {
    /**
     * Constructor
     * 
     * @param Image $adapterObject
     */
    public function __construct($adapterObject) {
        parent::__construct($adapterObject);
    }
}