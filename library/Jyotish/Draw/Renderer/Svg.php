<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Renderer;

use Jyotish\Draw\Plot\Chakra\AbstractChakra;
use Jyotish\Service\Utils;
use DOMDocument;
use DOMElement;
use DOMText;

/**
 * Class for rendering basic elements as svg.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Svg extends AbstractRenderer implements \Jyotish\Draw\Renderer\SvgInterface {

	public function __construct($width, $height) {
		$this->resource = new DOMDocument('1.0', 'utf-8');
		$this->resource->formatOutput = true;
		$this->svg = $this->resource->createElement('svg');
		$this->svg->setAttribute('xmlns', "http://www.w3.org/2000/svg");
		$this->svg->setAttribute('version', '1.1');
		$this->svg->setAttribute('width', $width);
		$this->svg->setAttribute('height', $height);
		$this->svg->setAttribute('class', 'chakra');
		$this->svg->setAttribute('viewBox', "0 0 {$width} {$height}");

		$this->resource->appendChild($this->svg);
		
		$this->appendRootElement('style', array('type' => 'text/css'), '
			polygon:hover {fill: #eee;}
			text {font-family: Arial;}
		');
		$this->appendRootElement('rect', array('width' => $width, 'height' => $height, 'fill' => 'white'));
	}

	public function drawPolygon($points) {
		$colorSrokeRgb = Utils::htmlToRgb($this->strokeColor);
		$colorStrokeString = 'rgb(' . implode(', ', $colorSrokeRgb) . ')';

		$colorFillRgb = Utils::htmlToRgb($this->fillColor);
		$colorFillString = 'rgb(' . implode(', ', $colorFillRgb) . ')';

		$pointsString = implode(' ', $points);

		$attributes['points'] = $pointsString;
		$attributes['fill'] = $colorFillString;
		$attributes['stroke'] = $colorStrokeString;
		$attributes['stroke-width'] = $this->strokeWidth;
		$attributes['stroke-linejoin'] = 'round';

		$this->appendRootElement('polygon', $attributes);
	}

	public function drawText($text, $x = 0, $y = 0, $options = array()) {
		$colorRgb = Utils::htmlToRgb($this->fontColor);
		$color = 'rgb(' . implode(', ', $colorRgb) . ')';
		
		$attributes['x'] = $x;
		$attributes['y'] = $y;
		$attributes['fill'] = $color;
		$attributes['font-size'] = $this->fontSize * 1.2;
		
		switch ($options['align']) {
			case 'left':
				$textAnchor = 'start';
				break;
			case 'right':
				$textAnchor = 'end';
				break;
			case 'center':
				$textAnchor = 'middle';
				break;
		}
		
		switch ($options['valign']) {
			case 'top':
				$attributes['y'] += $this->fontSize;
				break;
			case 'bottom':
				$attributes['y'] += 0;
				break;
			case 'middle':
				$attributes['y'] += $this->fontSize / 2;
				break;
		}
		
		$attributes['style'] = 'text-anchor: ' . $textAnchor;
		$attributes['transform'] = 'rotate('
				. (- $options['orientation'])
				. ', '
				. ($x)
				. ', ' . ($y)
				. ')';
		
		$this->appendRootElement('text', $attributes, html_entity_decode($text, ENT_COMPAT | ENT_HTML5, 'UTF-8'));
	}

	protected function appendRootElement($tagName, $attributes = array(), $textContent = null) {
		$newElement = $this->createElement($tagName, $attributes, $textContent);
		$this->svg->appendChild($newElement);
	}

	protected function createElement($tagName, $attributes = array(), $textContent = null) {
		$element = $this->resource->createElement($tagName);
		foreach ($attributes as $k => $v) {
			$element->setAttribute($k, $v);
		}
		if ($textContent !== null) {
			$element->appendChild(new DOMText((string) $textContent));
		}
		return $element;
	}

	public function setFontName($value) {
		return;
	}

	public function render() {
		header("Content-Type: image/svg+xml");
		echo $this->resource->saveXML();
	}

}