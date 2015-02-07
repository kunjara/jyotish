<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

use Jyotish\Draw\Plot\Chakra\Style\AbstractChakra;
use Jyotish\Base\Data;

/**
 * Abstract class for rendering Chakra.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractRender {
    /**
     * Adapter object.
     * 
     * @var Image|Svg
     */
    protected $adapterObject = null;
    
    /**
     * Chakra object.
     * 
     * @var North|South|East
     */
    protected $chakraObject = null;
    
    /**
     * Data object.
     * 
     * @var Data
     */
    protected $dataObject = null;

    /**
     * Options to set.
     * 
     * @var array
     */
    protected $options = [
        'chakraSize' => 200,
        'chakraStyle' => AbstractChakra::STYLE_NORTH,
        
        'offsetBorder' => 4,
        'offsetLabel' => 4,
        'widthOffsetLabel' => 20,
        'heightOffsetLabel' => 14,
        
        'labelGrahaType' => 0,
        'labelGrahaCallback' => null,
    ];

    /**
     * Constructor
     * 
     * @param Image|Svg $adapterObject
     */
    public function __construct($adapterObject) {
        $this->adapterObject = $adapterObject;
    }
    
    /**
     * Set options.
     * 
     * @param array $options Options to set
     */
    public function setOptions(array $options) {
        if($options){
            foreach ($options as $key => $value) {
                if (is_array($value)) {
                    //$this->adapterObject->setOptions($value);
                } else {
                    $method = 'set' . $key;
                    if (method_exists($this, $method)) {
                        $this->$method($value);
                    }
                }
            }
        }
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
        $this->dataObject = $Data;
        
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . ucfirst($this->options['chakraStyle']);
        $this->chakraObject = new $chakraStyle();

        $bhavaPoints = $this->chakraObject->getBhavaPoints($this->options['chakraSize'], $x, $y);

        foreach ($bhavaPoints as $points) {
            $this->adapterObject->drawPolygon($points);
        }

        if (isset($options['labelRashiFont'])){
            $this->adapterObject->setOptions($options['labelRashiFont']);
        }
        $this->drawRashiLabel($x, $y);

        if (isset($options['labelGrahaFont'])){
            $this->adapterObject->setOptions($options['labelGrahaFont']);
        }
        $this->drawGrahaLabel($x, $y);
    }

    public function setChakraSize($value) {
        if (!is_numeric($value) || intval($value) < 100) {
            throw new Exception\OutOfRangeException(
                    'Chakra size must be greater than 100.'
            );
        }
        $this->options['chakraSize'] = intval($value);
    }

    public function setChakraStyle($value) {
        if (!in_array($value, AbstractChakra::$styles)) {
            throw new Exception\UnexpectedValueException(
                    "Invalid chakra style provided must be 'north', 'south' or 'east'."
            );
        }
        $this->options['chakraStyle'] = strtolower($value);
    }

    public function setOffsetBorder($value) {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Border offset must be greater than or equals 0.'
            );
        }
        $this->options['offsetBorder'] = intval($value);
    }

    public function setOffsetLabel($value) {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Label offset must be greater than or equals 0.'
            );
        }
        $this->options['offsetLabel'] = intval($value);
    }

    public function setLabelGrahaType($value) {
        if (!in_array($value, array(0, 1, 2))) {
            throw new Exception\UnexpectedValueException(
                    "Invalid label type provided must be 0, 1 or 2."
            );
        }
        $this->options['labelGrahaType'] = $value;
    }

    public function setLabelGrahaCallback($value) {
        if (!is_callable($value)) {
            throw new Exception\RuntimeException("Function $value not supported.");
        }
        $this->options['labelGrahaCallback'] = $value;
    }
}