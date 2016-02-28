<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw;

/**
 * Class for drawing.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Draw
{
    /**
     * Image renderer
     */
    const RENDERER_IMAGE = 'image';
    /**
     * Svg renderer
     */
    const RENDERER_SVG = 'svg';
    
    /**
     * Renderer object.
     * 
     * @var Image|Svg
     */
    protected $Renderer = null;

    /**
     * Constructor
     * 
     * @param int $width Width of drawing
     * @param int $height Height of drawing
     * @param string $renderer Renderer name (optional)
     * @throws Exception\UnexpectedValueException
     */
    public function __construct($width, $height, $renderer = self::RENDERER_IMAGE) {
        if (!in_array(strtolower($renderer), [self::RENDERER_IMAGE, self::RENDERER_SVG])) {
            throw new Exception\UnexpectedValueException(
                "Invalid renderer provided must be 'image' or 'svg'."
            );
        }

        $rendererClass = 'Jyotish\Draw\Renderer\\' . ucfirst($renderer);
        $this->Renderer = new $rendererClass($width, $height);
    }

    /**
     * Set options.
     * 
     * @param array $options Options to set
     * @return Draw
     */
    public function setOptions($options) {
        $this->Renderer->setOptions($options);
        
        return $this;
    }

    /**
     * Draw text.
     * 
     * @param string $text
     * @param int $x
     * @param int $y
     * @param null|array $options Options to set (optional)
     */
    public function drawText($text, $x, $y, array $options = null) {
        $this->Renderer->drawText($text, $x, $y, $options);
    }
    
    /**
     * Draw polygon.
     * 
     * @param array $points An array containing the polygon's vertices.
     * @param null|array $options Options to set (optional)
     */
    public function drawPolygon(array $points, array $options = null)
    {
        $this->Renderer->drawPolygon($points, $options);
    }

    /**
     * Draw chakra.
     * 
     * @param \Jyotish\Base\Data $Data
     * @param int $x
     * @param int $y
     * @param null|array $options Options to set (optional)
     */
    public function drawChakra(\Jyotish\Base\Data $Data, $x, $y, array $options = null) {
        $this->setOptions($options);
        
        $ChakraRenderer = new \Jyotish\Draw\Plot\Chakra\Renderer($this->Renderer);
        $ChakraRenderer->drawChakra($Data, $x, $y, $options);
    }

    /**
     * Render the drawing with correct headers.
     * 
     * @return mixed
     */
    public function render() {
        $this->Renderer->render();
    }
}