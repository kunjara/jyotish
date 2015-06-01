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
abstract class AbstractRender {
    
    use \Jyotish\Base\Traits\OptionTrait;

    /**
     * Drawing resource.
     * 
     * @var img|svg 
     */
    protected $resource = null;

    protected $options = [
        'topOffset' => 0,
        'leftOffset' => 0,
        
        'fontSize' => 10,
        'fontName' => '',
        'fontColor' => '000',
        
        'textAlign' => 'left',
        'textValign' => 'bottom',
        'textOrientation' => 0,
        
        'strokeWidth' => 1,
        'strokeColor' => '000',
        
        'fillColor' => 'fff',
    ];

    public function setOptionTopOffset($value) {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Vertical position must be greater than or equals 0.'
            );
        }
        $this->options['topOffset'] = intval($value);
    }

    public function setOptionLeftOffset($value) {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Horizontal position must be greater than or equals 0.'
            );
        }
        $this->options['leftOffset'] = intval($value);
    }

    public function setOptionFontSize($value) {
        if (!is_numeric($value) || intval($value) < 8) {
            throw new Exception\OutOfRangeException(
                    'Font size must be greater than or equals 8.'
            );
        }
        $this->options['fontSize'] = intval($value);
    }

    public function setOptionFontColor($value) {
        $this->options['fontColor'] = $value;
    }

    public function setOptionStrokeWidth($value) {
        if (!is_numeric($value) || floatval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Stroke width must be greater than or equals 0.'
            );
        }
        $this->options['strokeWidth'] = $value;
    }

    abstract public function drawPolygon($points, array $options = null);

    abstract public function drawText($text, $x, $y, array $options = null);

    abstract public function render();
}