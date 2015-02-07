<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw;

use Jyotish\Base\Data;

/**
 * Class for drawing.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Draw {
    const ADAPTER_IMAGE = 'image';
    const ADAPTER_SVG = 'svg';
    
    /**
     * Adapter name.
     * 
     * @var string
     */
    protected $adapterName = null;
    
    /**
     * Adapter object.
     * 
     * @var Image|Svg
     */
    protected $adapterObject = null;

    /**
     * Constructor
     * 
     * @param int $width Width of drawing
     * @param int $height Height of drawing
     * @param string $adapter Adapter name
     * @throws Exception\UnexpectedValueException
     */
    public function __construct($width, $height, $adapter = self::ADAPTER_IMAGE) {
        if (!in_array(strtolower($adapter), [self::ADAPTER_IMAGE, self::ADAPTER_SVG])) {
            throw new Exception\UnexpectedValueException(
                    "Invalid renderer provided must be 'image' or 'svg'."
            );
        }

        $this->adapterName = ucwords(strtolower($adapter));
        $adapterClass = 'Jyotish\Draw\Renderer\\' . $this->adapterName;
        $this->adapterObject = new $adapterClass($width, $height);
    }

    /**
     * Set options.
     * 
     * @param array $options Options to set
     */
    public function setOptions($options) {
        $this->adapterObject->setOptions($options);
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
        $this->adapterObject->drawText($text, $x, $y, $options);
    }

    /**
     * Draw chakra.
     * 
     * @param Data $Data
     * @param int $x
     * @param int $y
     * @param null|array $options Options to set (optional)
     */
    public function drawChakra(Data $Data, $x, $y, array $options = null) {
        $chakraAdapterClass = 'Jyotish\Draw\Plot\Chakra\Render\\' . $this->adapterName;
        $chakraAdapterObject = new $chakraAdapterClass($this->adapterObject);

        $this->setOptions($options);
        $chakraAdapterObject->setOptions($options);
        $chakraAdapterObject->drawChakra($Data, $x, $y, $options);
    }

    /**
     * Render the drawing with correct headers.
     * 
     * @return mixed
     */
    public function render() {
        $this->adapterObject->render();
    }
}