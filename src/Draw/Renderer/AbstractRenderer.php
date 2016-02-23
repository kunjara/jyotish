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

    /**
     * Set top offset. Top offset should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Renderer\AbstractRenderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionTopOffset($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Top offset should be greater than or equals 0.'
            );
        }
        $this->optionTopOffset = intval($value);
        return $this;
    }

    /**
     * Set left offset. Left offset should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Renderer\AbstractRenderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionLeftOffset($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Left offset should be greater than or equals 0.'
            );
        }
        $this->optionLeftOffset = intval($value);
        return $this;
    }

    /**
     * Set font size. Font size should be greater than or equals 8.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Renderer\AbstractRenderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionFontSize($value)
    {
        if (!is_numeric($value) || intval($value) < 8) {
            throw new Exception\OutOfRangeException(
                    'Font size should be greater than or equals 8.'
            );
        }
        $this->optionFontSize = intval($value);
        return $this;
    }

    /**
     * Set font color.
     * 
     * @param string $value
     * @return \Jyotish\Draw\Renderer\AbstractRenderer
     */
    public function setOptionFontColor($value)
    {
        $this->optionFontColor = $value;
        return $this;
    }

    /**
     * Set stroke width. Stroke width should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Renderer\AbstractRenderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionStrokeWidth($value)
    {
        if (!is_numeric($value) || floatval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Stroke width should be greater than or equals 0.'
            );
        }
        $this->optionStrokeWidth = $value;
        return $this;
    }

    /**
     * Draw polygon.
     */
    abstract public function drawPolygon(array $points, array $options = null);

    /**
     * Draw text string.
     */
    abstract public function drawText($text, $x, $y, array $options = null);

    /**
     * Render the drawing.
     */
    abstract public function render();
}