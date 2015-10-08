<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Renderer;

use Jyotish\Base\Utility;

/**
 * Class for rendering basic elements as image.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Image extends AbstractRenderer
{
    /**
     * Renderer name.
     * 
     * @var string
     */
    protected $rendererName = \Jyotish\Draw\Draw::RENDERER_IMAGE;
    
    /**
     * Constructor
     * 
     * @param int $width Width of drawing
     * @param int $height Height of drawing
     */
    public function __construct($width, $height)
    {
        $this->Resource = imagecreatetruecolor($width, $height);

        $color = $this->allocateColor($this->Resource, 255, 255, 255);

        imagefill($this->Resource, 0, 0, $color);
    }

    public function drawPolygon($points, array $options = null)
    {
        if (isset($options)) {
            $this->setOptions($options);
        }
        
        $colorRgb = Utility::htmlToRgb($this->options['strokeColor']);
        $color = $this->allocateColor($this->Resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

        imagesetthickness($this->Resource, $this->options['strokeWidth']);

        $numPoints = count($points) / 2;

        imagepolygon(
                $this->Resource, $points, $numPoints, $color
        );
    }

    public function drawText($text, $x = 0, $y = 0, array $options = null)
    {
        if (isset($options)) {
            $this->setOptions($options);
        }
        
        $colorRgb = Utility::htmlToRgb($this->options['fontColor']);
        $color = $this->allocateColor($this->Resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

        if ($this->options['fontName'] == null) {
            $this->options['fontName'] = 3;
        }

        if (is_numeric($this->options['fontName'])) {
            if ($this->options['textOrientation']) {
                throw new Exception\RuntimeException(
                        'No orientation possible with GD internal font.'
                );
            }
            $fontWidth = imagefontwidth($this->options['fontName']);
            $fontHeight = imagefontheight($this->options['fontName']);

            switch ($this->options['textAlign']) {
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

            switch ($this->options['textValign']) {
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

            imagestring(
                    $this->Resource, 
                    $this->options['fontName'], 
                    $positionX, 
                    $positionY, 
                    $text, 
                    $color
            );
        } else {
            if (!function_exists('imagettfbbox')) {
                throw new Exception\RuntimeException(
                        'A font was provided, but this instance of PHP does not have TTF (FreeType) support');
            }

            $box = imagettfbbox($this->options['fontSize'], 0, $this->options['fontName'], $text);

            switch ($this->options['textAlign']) {
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

            switch ($this->options['textValign']) {
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
                    $this->Resource, 
                    $this->options['fontSize'], 
                    $this->options['textOrientation'], 
                    $x - ($width * cos(pi() * $this->options['textOrientation'] / 180)) + ($height * sin(pi() * $this->options['textOrientation'] / 180)), 
                    $y + ($height * cos(pi() * $this->options['textOrientation'] / 180)) + ($width * sin(pi() * $this->options['textOrientation'] / 180)), 
                    $color, 
                    $this->options['fontName'], 
                    $text
            );
        }
    }

    public function setOptionFontName($value)
    {
        if (!is_null($value) && !is_int($value) && !is_string($value)) {
            throw new Exception\InvalidArgumentException("Options 'fontName' must be null, integer or name of font.");
        } else {
            if (is_string($value) && !file_exists($value)) {
                throw new Exception\InvalidArgumentException("The font '$value' does not exist.");
            }
        }
        $this->options['fontName'] = $value;
        
    }

    public function allocateColor($image, $r, $g, $b, $alpha = 100)
    {
        $alpha = $this->_convertAlpha($alpha);
        return(imagecolorallocatealpha($image, $r, $g, $b, $alpha));
    }

    public function render()
    {
        header('Content-type: image/png');
        imagepng($this->Resource);
        imagedestroy($this->Resource);
    }

    private function _convertAlpha($alphaValue)
    {
        return((127 / 100) * (100 - $alphaValue));
    }
}