<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Renderer;

use Jyotish\Base\Utility;
use DOMDocument;
use DOMElement;
use DOMText;

/**
 * Class for rendering basic elements as svg.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Svg extends AbstractRenderer
{
    /**
     * Renderer name.
     * 
     * @var string
     */
    protected $rendererName = \Jyotish\Draw\Draw::RENDERER_SVG;
    
    /**
     * SVG eletment.
     * 
     * @var DOMElement
     */
    protected $svg;

    protected $optionAttributes = [];
    
    /**
     * Constructor
     * 
     * @param int $width Width of drawing
     * @param int $height Height of drawing
     */
    public function __construct($width, $height)
    {
        $this->Resource = new DOMDocument('1.0', 'utf-8');
        $this->Resource->formatOutput = true;
        
        $this->svg = $this->Resource->createElement('svg');
        $this->svg->setAttribute('xmlns', "http://www.w3.org/2000/svg");
        $this->svg->setAttribute('version', '1.1');
        $this->svg->setAttribute('width', $width);
        $this->svg->setAttribute('height', $height);
        $this->svg->setAttribute('class', 'chakra');
        $this->svg->setAttribute('viewBox', "0 0 {$width} {$height}");

        $this->Resource->appendChild($this->svg);

        $this->appendRootElement('style', ['type' => 'text/css'], '
            polygon:hover {fill: #eee;}
            text {font-family: Arial;}
        ');
        $this->appendRootElement('rect', ['width' => $width, 'height' => $height, 'fill' => 'white']);
    }

    /**
     * Draw polygon.
     * 
     * @param array $points An array containing the polygon's vertices.
     * @param null|array $options
     */
    public function drawPolygon(array $points, array $options = null)
    {
        $this->setOptions($options);
        
        $colorSrokeRgb = Utility::htmlToRgb($this->optionStrokeColor);
        $colorStrokeString = 'rgb(' . implode(', ', $colorSrokeRgb) . ')';

        $colorFillRgb = Utility::htmlToRgb($this->optionFillColor);
        $colorFillString = 'rgb(' . implode(', ', $colorFillRgb) . ')';

        $pointsString = implode(' ', $points);

        $attributes['points'] = $pointsString;
        $attributes['fill'] = $colorFillString;
        $attributes['stroke'] = $colorStrokeString;
        $attributes['stroke-width'] = $this->optionStrokeWidth;
        $attributes['stroke-linejoin'] = 'round';
        
        if (isset($this->optionAttributes) && is_array($this->optionAttributes)) {
            foreach ($this->optionAttributes as $name => $value) {
                $attributes[$name] = $value;
            }
        }

        $this->appendRootElement('polygon', $attributes);
    }

    /**
     * Draw text string.
     * 
     * @param string $text Text for drawing
     * @param int $x x-coordinate
     * @param int $y y-coordinate
     * @param null|array $options
     */
    public function drawText($text, $x = 0, $y = 0, array $options = null)
    {
        $this->setOptions($options);
        
        $colorRgb = Utility::htmlToRgb($this->optionFontColor);
        $color = 'rgb(' . implode(', ', $colorRgb) . ')';

        $attributes['x'] = $x;
        $attributes['y'] = $y;
        $attributes['fill'] = $color;
        $attributes['font-size'] = $this->optionFontSize * 1.2;
        
        switch ($this->optionTextAlign) {
            case 'center':
                $textAnchor = 'middle';
                break;
            case 'right':
                $textAnchor = 'end';
                break;
            case 'left':
            default:
                $textAnchor = 'start';
                break;
        }

        switch ($this->optionTextValign) {
            case 'top':
                $attributes['y'] += $this->optionFontSize;
                break;
            case 'middle':
                $attributes['y'] += $this->optionFontSize / 2;
                break;
            case 'bottom':
            default:
                $attributes['y'] += 0;
                break;
        }

        $attributes['style'] = 'text-anchor: ' . $textAnchor;

        $attributes['transform'] = 'rotate('
                . (- $this->optionTextOrientation)
                . ', '
                . ($x)
                . ', ' . ($y)
                . ')';

        $this->appendRootElement('text', $attributes, html_entity_decode($text, ENT_COMPAT | ENT_HTML5, 'UTF-8'));
    }
    
    /**
     * Render the drawing.
     */
    public function render()
    {
        header("Content-Type: image/svg+xml");
        echo $this->Resource->saveXML();
    }

    private function appendRootElement($tagName, array $attributes = [], $textContent = null)
    {
        $newElement = $this->createElement($tagName, $attributes, $textContent);
        $this->svg->appendChild($newElement);
    }

    private function createElement($tagName, array $attributes = [], $textContent = null)
    {
        $element = $this->Resource->createElement($tagName);
        foreach ($attributes as $k => $v) {
            $element->setAttribute($k, $v);
        }
        if ($textContent !== null) {
            $element->appendChild(new DOMText((string) $textContent));
        }
        return $element;
    }
}