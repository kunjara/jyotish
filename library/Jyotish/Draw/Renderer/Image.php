<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Renderer;

use Jyotish\Draw\Plot\Chakra\AbstractChakra;
use Jyotish\Base\Utils;

/**
 * Class for rendering basic elements as image.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Image extends AbstractRenderer implements \Jyotish\Draw\Renderer\ImageInterface {

	public function __construct($width, $height) {
		$this->resource = imagecreatetruecolor($width, $height);

		$color = $this->allocateColor($this->resource, 255, 255, 255);

		imagefill(
				$this->resource, 0, 0, $color
		);
	}

	public function drawPolygon($points) {
		$colorRgb = Utils::htmlToRgb($this->strokeColor);
		$color = $this->allocateColor($this->resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

		imagesetthickness($this->resource, $this->strokeWidth);

		$numPoints = count($points) / 2;

		imagepolygon(
				$this->resource, $points, $numPoints, $color
		);
	}

	public function drawText($text, $x = 0, $y = 0, $options = array()) {
		$colorRgb = Utils::htmlToRgb($this->fontColor);
		$color = $this->allocateColor($this->resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);
		
		if ($this->fontName == null) {
			$this->fontName = 3;
		}
		
		if(!isset($options['orientation'])) $options['orientation'] = 0;
		if (is_numeric($this->fontName)) {
			if ($options['orientation']) {
				throw new Exception\RuntimeException(
						'No orientation possible with GD internal font.'
				);
			}
			$fontWidth = imagefontwidth($this->fontName);
			$fontHeight = imagefontheight($this->fontName);
			
			switch ($options['align']) {
				case 'left':
					$positionX = $x;
					break;
				case 'center':
					$positionX = $x - ceil(($fontWidth * strlen($text)) / 2);
					break;
				case 'right':
					$positionX = $x - ($fontWidth * strlen($text));
					break;
			}
			
			switch ($options['valign']) {
				case 'top':
					$positionY = $y;
					break;
				case 'middle':
					$positionY = $y - $fontHeight / 2;
					break;
				case 'bottom' :
					$positionY = $y - $fontHeight + 1;
					break;
			}
			
			imagestring($this->resource, $this->fontName, $positionX, $positionY, $text, $this->fontColor);
		} else {
			if (!function_exists('imagettfbbox')) {
				throw new Exception\RuntimeException(
						'A font was provided, but this instance of PHP does not have TTF (FreeType) support');
			}

			$box = imagettfbbox($this->fontSize, 0, $this->fontName, $text);
			
			if(!isset($options['align'])) $options['align'] = 'left';
			switch ($options['align']) {
				case 'center':
					$width = ($box[2] - $box[0]) / 2;
					break;
				case 'right':
					$width = ($box[2] - $box[0]);
					break;
				case 'left':
				default:
					$width = 0;
					break;
			}
			
			if(!isset($options['valign'])) $options['valign'] = 'bottom';
			switch ($options['valign']) {
				case 'top':
					$height = ($box[1] - $box[7]);
					break;
				case 'middle':
					$height = ($box[1] - $box[7]) / 2;
					break;
				case 'bottom':
				default:
					$height = 0;
					break;
			}
			
			imagettftext(
					$this->resource, 
					$this->fontSize, 
					$options['orientation'], 
					$x - ($width * cos(pi() * $options['orientation'] / 180)) + ($height * sin(pi() * $options['orientation'] / 180)), 
					$y + ($height * cos(pi() * $options['orientation'] / 180)) + ($width * sin(pi() * $options['orientation'] / 180)), 
					$color, 
					$this->fontName, 
					$text
			);
		}
	}

	public function setFontName($value) {
		if (empty($value)) {
			throw new Exception\InvalidArgumentException("Options 'fontName' is required and must be name of font.");
		}

		if (!file_exists($value)) {
			throw new Exception\InvalidArgumentException("The font '{$value}' does not exist.");
		}

		$this->fontName = $value;
		return $this;
	}

	public function allocateColor($image, $r, $g, $b, $alpha = 100) {
		$alpha = $this->_convertAlpha($alpha);
		return(imagecolorallocatealpha($image, $r, $g, $b, $alpha));
	}

	public function render() {
		header('Content-type: image/png');
		imagepng($this->resource);
		imagedestroy($this->resource);
	}

	private function _convertAlpha($alphaValue) {
		return((127 / 100) * (100 - $alphaValue));
	}

}