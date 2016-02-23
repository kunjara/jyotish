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

    /**
     * Draw polygon.
     * 
     * @param array $points An array containing the polygon's vertices.
     * @param null|array $options
     */
    public function drawPolygon(array $points, array $options = null)
    {
        $this->setOptions($options);
        
        $colorRgb = Utility::htmlToRgb($this->optionStrokeColor);
        $color = $this->allocateColor($this->Resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

        imagesetthickness($this->Resource, $this->optionStrokeWidth);

        $numPoints = count($points) / 2;

        imagepolygon($this->Resource, $points, $numPoints, $color);
    }

    /**
     * Draw text string.
     * 
     * @param string $text Text for drawing
     * @param int $x x-coordinate
     * @param int $y y-coordinate
     * @param array $options
     * @throws Exception\RuntimeException
     */
    public function drawText($text, $x = 0, $y = 0, array $options = null)
    {
        $this->setOptions($options);
        
        $colorRgb = Utility::htmlToRgb($this->optionFontColor);
        $color = $this->allocateColor($this->Resource, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

        if ($this->optionFontName == null) {
            $this->optionFontName = 3;
        }

        if (is_numeric($this->optionFontName)) {
            if ($this->optionTextOrientation) {
                throw new Exception\RuntimeException(
                        'No orientation possible with GD internal font.'
                );
            }
            $fontWidth = imagefontwidth($this->optionFontName);
            $fontHeight = imagefontheight($this->optionFontName);

            switch ($this->optionTextAlign) {
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

            switch ($this->optionTextValign) {
                case 'top':
                    $positionY = $y;
                    break;
                case 'middle':
                    $positionY = $y - $fontHeight / 2;
                    break;
                case 'bottom':
                    $positionY = $y - $fontHeight + 1;
                    break;
            }

            imagestring(
                    $this->Resource, 
                    $this->optionFontName, 
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

            $box = imagettfbbox($this->optionFontSize, 0, $this->optionFontName, $text);

            switch ($this->optionTextAlign) {
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

            switch ($this->optionTextValign) {
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
                    $this->optionFontSize, 
                    $this->optionTextOrientation, 
                    $x - ($width * cos(pi() * $this->optionTextOrientation / 180)) + ($height * sin(pi() * $this->optionTextOrientation / 180)), 
                    $y + ($height * cos(pi() * $this->optionTextOrientation / 180)) + ($width * sin(pi() * $this->optionTextOrientation / 180)), 
                    $color, 
                    $this->optionFontName, 
                    $text
            );
        }
    }

    /**
     * Set font name.
     * 
     * @param null|int|string $value
     * @return \Jyotish\Draw\Renderer\Image
     * @throws Exception\InvalidArgumentException
     */
    public function setOptionFontName($value)
    {
        if (!is_null($value) && !is_int($value) && !is_string($value)) {
            throw new Exception\InvalidArgumentException("Options 'fontName' should be null, integer or name of font.");
        } else {
            if (is_string($value) && !file_exists($value)) {
                throw new Exception\InvalidArgumentException("The font '$value' does not exist.");
            }
        }
        $this->optionFontName = $value;
        return $this;
    }
    
    /**
     * Render the drawing.
     */
    public function render()
    {
        header('Content-type: image/png');
        imagepng($this->Resource);
        imagedestroy($this->Resource);
    }

    private function allocateColor($image, $r, $g, $b, $alpha = 100)
    {
        $alphaValue = (127 / 100) * (100 - $alpha);
        return(imagecolorallocatealpha($image, $r, $g, $b, $alphaValue));
    }
}