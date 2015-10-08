<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Base\Utility;
use Jyotish\Draw\Plot\Chakra\Style\AbstractChakra as Chakra;

/**
 * Class for rendering Chakra.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Renderer
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Renderer object.
     * 
     * @var Image|Svg
     */
    protected $Renderer = null;
    
    /**
     * Chakra object.
     * 
     * @var North|South|East
     */
    protected $Chakra = null;

    /**
     * Options to set.
     * 
     * @var array
     */
    protected $options = [
        'chakraSize' => 200,
        'chakraStyle' => Chakra::STYLE_NORTH,
        
        'offsetBorder' => 4,
        'widthOffsetLabel' => 20,
        'heightOffsetLabel' => 14,
        
        'labelGrahaType' => 0,
        'labelGrahaCallback' => '',
        
        'labelRashiFont' => [],
        'labelGrahaFont' => [],
        'labelExtraFont' => [],
    ];

    /**
     * Constructor
     * 
     * @param Image|Svg $Renderer
     */
    public function __construct($Renderer)
    {
        $this->Renderer = $Renderer;
    }
    
    /**
     * Draw chakra.
     * 
     * @param \Jyotish\Base\Data $Data
     * @param int $x
     * @param int $y
     * @param null|array $options Options to set (optional)
     */
    public function drawChakra(\Jyotish\Base\Data $Data, $x, $y, array $options = null)
    {
        $this->setData($Data);
        $this->setOptions($options);
        
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . ucfirst($this->options['chakraStyle']);
        $this->Chakra = new $chakraStyle($Data);

        $bhavaPoints = $this->Chakra->getBhavaPoints($this->options['chakraSize'], $x, $y);
        
        foreach ($bhavaPoints as $number => $points) {
            if ($this->options['chakraStyle'] == Chakra::STYLE_NORTH) {
                $bhava = ' bhava'.$number;
                $rashi = ' rashi'.$Data->getData()['bhava'][$number]['rashi'];
            } else {
                $rashi = ' rashi'.$number;
                $Rashi = Rashi::getInstance($number);
                $Rashi->setEnvironment($Data);
                $bhava = ' bhava'.$Rashi->getBhava();
            }
            
            $this->options['attributes'] = [
                'class' => 'bhava'.$bhava.$rashi,
            ];
            
            $this->Renderer->drawPolygon($points, $this->options);
        }
        
        $this->drawRashiLabel($x, $y, $this->options);
        
        $this->drawBodyLabel($x, $y, $this->options);
    }
    
    protected function drawRashiLabel($x, $y, $options)
    {
        if (isset($options['labelRashiFont'])) {
            $this->Renderer->setOptions($options['labelRashiFont']);
        }
        
        $rashiLabelPoints = $this->Chakra->getRashiLabelPoints($this->options);
        foreach ($rashiLabelPoints as $rashi => $point) {
            $this->Renderer->drawText(
                $rashi, 
                $point['x'] + $x, 
                $point['y'] + $y, 
                ['textAlign' => $point['textAlign'], 'textValign' => $point['textValign']]
            );
        }
    }
    
    protected function drawBodyLabel($x, $y, $options)
    {
        if (isset($options['labelGrahaFont'])) {
            $this->Renderer->setOptions($options['labelGrahaFont']);
        }
        
        $bodyLabelPoints = $this->Chakra->getBodyLabelPoints($this->options);
        
        foreach ($bodyLabelPoints as $body => $point) {
            if (!array_key_exists($body, Graha::$graha) && isset($options['labelExtraFont'])) {
                $this->Renderer->setOptions($options['labelExtraFont']);
            }
            
            $bodyLabel = $this->getBodyLabel($body, [
                'labelGrahaType' => $this->options['labelGrahaType'], 
                'labelGrahaCallback' => $this->options['labelGrahaCallback']
            ]);

            $this->Renderer->drawText(
                $bodyLabel,
                $point['x'] + $x,
                $point['y'] + $y,
                ['textAlign' => $point['textAlign'], 'textValign' => $point['textValign']]
            );
        }
    }
    
    /**
     * Return body label.
     * 
     * @param string $body
     * @param array $options
     * @return string
     */
    protected function getBodyLabel($body, array $options)
    {
        switch ($options['labelGrahaType']) {
            case 0:
                $label = $body;
                break;
            case 1:
                if (array_key_exists($body, Graha::$graha)) {
                    $grahaObject = Graha::getInstance($body);
                    $label = Utility::unicodeToHtml($grahaObject->grahaUnicode);
                } else {
                    $label = $body;
                }
                break;
            case 2:
                $label = call_user_func($options['labelGrahaCallback'], $body);
                break;
            default:
                $label = $body;
                break;
        }
        
        $data = $this->Data->getData();

        if (array_key_exists($body, Graha::listGraha(Graha::LIST_SAPTA))) {
            $vakraCheshta = $data['graha'][$body]['speed'] < 0 ? true : false;
        } else {
            $vakraCheshta = false;
        }
        
        $grahaLabel = $vakraCheshta ? '(' . $label . ')' : $label;
        
        return $grahaLabel;
    }

    public function setOptionChakraSize($value)
    {
        if (!is_numeric($value) || intval($value) < 100) {
            throw new Exception\OutOfRangeException(
                    'Chakra size must be greater than 100.'
            );
        }
        $this->options['chakraSize'] = intval($value);
    }

    public function setOptionChakraStyle($value)
    {
        if (!in_array($value, Chakra::$style)) {
            throw new Exception\UnexpectedValueException(
                    "Invalid chakra style provided must be 'north', 'south' or 'east'."
            );
        }
        $this->options['chakraStyle'] = strtolower($value);
    }

    public function setOptionOffsetBorder($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Border offset must be greater than or equals 0.'
            );
        }
        $this->options['offsetBorder'] = intval($value);
    }

    public function setOptionWidthOffsetLabel($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Label offset must be greater than or equals 0.'
            );
        }
        $this->options['widthOffsetLabel'] = intval($value);
    }
    
    public function setOptionHeightOffsetLabel($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Label offset must be greater than or equals 0.'
            );
        }
        $this->options['heightOffsetLabel'] = intval($value);
    }

    public function setOptionLabelGrahaType($value)
    {
        if (!in_array($value, [0, 1, 2])) {
            throw new Exception\UnexpectedValueException(
                    "Invalid label type provided must be 0, 1 or 2."
            );
        }
        $this->options['labelGrahaType'] = $value;
    }

    public function setOptionLabelGrahaCallback($value)
    {
        if (!is_callable($value)) {
            throw new Exception\RuntimeException("Function $value not supported.");
        }
        $this->options['labelGrahaCallback'] = $value;
    }
}