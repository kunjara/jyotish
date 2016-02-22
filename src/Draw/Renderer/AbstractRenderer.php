<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Renderer;

/**
 * Abstract class for rendering.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractRenderer
{
    use \Jyotish\Base\Traits\OptionTrait;
    use \Jyotish\Base\Traits\GetTrait;

    /**
     * Renderer name.
     * 
     * @var string
     */
    protected $rendererName;

    /**
     * Drawing Resource.
     * 
     * @var mixed 
     */
    protected $Resource = null;
    
    protected $optionTopOffset = 0;
    protected $optionLeftOffset = 0;
    
    protected $optionFontSize = 10;
    protected $optionFontName = null;
    protected $optionFontColor = '000';
    
    protected $optionTextAlign = 'left';
    protected $optionTextValign = 'bottom';
    protected $optionTextOrientation = 0;
    
    protected $optionStrokeWidth = 1;
    protected $optionStrokeColor = '000';
    
    protected $optionFillColor = 'fff';

    public function setOptionTopOffset($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Vertical position must be greater than or equals 0.'
            );
        }
        $this->optionTopOffset = intval($value);
    }

    public function setOptionLeftOffset($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Horizontal position must be greater than or equals 0.'
            );
        }
        $this->optionLeftOffset = intval($value);
    }

    public function setOptionFontSize($value)
    {
        if (!is_numeric($value) || intval($value) < 8) {
            throw new Exception\OutOfRangeException(
                    'Font size must be greater than or equals 8.'
            );
        }
        $this->optionFontSize = intval($value);
    }

    public function setOptionFontColor($value)
    {
        $this->optionFontColor = $value;
    }

    public function setOptionStrokeWidth($value)
    {
        if (!is_numeric($value) || floatval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Stroke width must be greater than or equals 0.'
            );
        }
        $this->optionStrokeWidth = $value;
    }

    abstract public function drawPolygon($points, array $options = null);

    abstract public function drawText($text, $x, $y, array $options = null);

    abstract public function render();
}