<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Varga\Varga;
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

    protected $optionChakraSize = 200;
    protected $optionChakraStyle = Chakra::STYLE_NORTH;
    protected $optionChakraVarga = Varga::KEY_D1;
    
    protected $optionOffsetBorder = 4;
    protected $optionWidthOffsetLabel = 20;
    protected $optionHeightOffsetLabel = 14;
    
    protected $optionLabelGrahaType = 0;
    protected $optionLabelGrahaCallback = '';
    
    protected $optionLabelRashiFont = '';
    protected $optionLabelGrahaFont = '';
    protected $optionLabelExtraFont = '';

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
        
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . ucfirst($this->optionChakraStyle);
        $this->Chakra = new $chakraStyle($Data);

        $bhavaPoints = $this->Chakra->getBhavaPoints($this->optionChakraSize, $x, $y);
        
        foreach ($bhavaPoints as $number => $points) {
            if ($this->optionChakraStyle == Chakra::STYLE_NORTH) {
                $bhava = ' bhava'.$number;
                $rashi = ' rashi'.$Data->getData()['bhava'][$number]['rashi'];
            } else {
                $rashi = ' rashi'.$number;
                $Rashi = Rashi::getInstance($number);
                $Rashi->setEnvironment($Data);
                $bhava = ' bhava'.$Rashi->getBhava();
            }
            
            $attributes = [
                'class' => 'bhava'.$bhava.$rashi,
            ];
            
            $options = array_merge($this->getOptions(), ['attributes' => $attributes]);
            $this->Renderer->drawPolygon($points, $options);
        }
        
        $this->drawRashiLabel($x, $y, $this->getOptions());
        
        $this->drawBodyLabel($x, $y, $this->getOptions());
    }
    
    /**
     * Draw rashi labels.
     * 
     * @param int $x
     * @param int $y
     * @param null|array $options
     */
    private function drawRashiLabel($x, $y, array $options = null)
    {
        if (isset($options['labelRashiFont'])) {
            $this->Renderer->setOptions($options['labelRashiFont']);
        }
        
        $rashiLabelPoints = $this->Chakra->getRashiLabelPoints($this->getOptions());
        foreach ($rashiLabelPoints as $rashi => $point) {
            $this->Renderer->drawText(
                $rashi, 
                $point['x'] + $x, 
                $point['y'] + $y, 
                ['textAlign' => $point['textAlign'], 'textValign' => $point['textValign']]
            );
        }
    }
    
    /**
     * Draw body labels.
     * 
     * @param int $x
     * @param int $y
     * @param null|array $options
     */
    private function drawBodyLabel($x, $y, array $options = null)
    {
        if (isset($options['labelGrahaFont'])) {
            $this->Renderer->setOptions($options['labelGrahaFont']);
        }
        
        $bodyLabelPoints = $this->Chakra->getBodyLabelPoints($this->getOptions());
        
        foreach ($bodyLabelPoints as $body => $point) {
            if (!array_key_exists($body, Graha::$graha) && isset($options['labelExtraFont'])) {
                $this->Renderer->setOptions($options['labelExtraFont']);
            }
            
            $bodyLabel = $this->getBodyLabel($body, [
                'labelGrahaType' => $this->optionLabelGrahaType, 
                'labelGrahaCallback' => $this->optionLabelGrahaCallback
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
    private function getBodyLabel($body, array $options)
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
    
    /**
     * Set chakra varga.
     * 
     * @param string $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\UnexpectedValueException
     */
    public function setOptionChakraVarga($value)
    {
        $valueUcf = ucfirst($value);
        if (!array_key_exists($valueUcf, Varga::$varga)) {
            throw new Exception\UnexpectedValueException(
                    'Varga key is wrong.'
            );
        }
        $this->optionChakraVarga = $valueUcf;
        return $this;
    }

    /**
     * Set chakra size. Chakra size should be greater than or equals 100.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionChakraSize($value)
    {
        if (!is_numeric($value) || intval($value) < 100) {
            throw new Exception\OutOfRangeException(
                    'Chakra size should be greater than or equals 100.'
            );
        }
        $this->optionChakraSize = intval($value);
        return $this;
    }

    /**
     * Set chakra style. Chakra style provided should be 'north', 'south' or 'east'.
     * 
     * @param string $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\UnexpectedValueException
     */
    public function setOptionChakraStyle($value)
    {
        if (!in_array($value, Chakra::$style)) {
            throw new Exception\UnexpectedValueException(
                    "Invalid chakra style provided should be 'north', 'south' or 'east'."
            );
        }
        $this->optionChakraStyle = strtolower($value);
        return $this;
    }

    /**
     * Set border offset. Border offset should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionOffsetBorder($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Border offset should be greater than or equals 0.'
            );
        }
        $this->optionOffsetBorder = intval($value);
        return $this;
    }

    /**
     * Set width offset. Width offset should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionWidthOffsetLabel($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Width offset should be greater than or equals 0.'
            );
        }
        $this->optionWidthOffsetLabel = intval($value);
        return $this;
    }
    
    /**
     * Set height offset. Height offset should be greater than or equals 0.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\OutOfRangeException
     */
    public function setOptionHeightOffsetLabel($value)
    {
        if (!is_numeric($value) || intval($value) < 0) {
            throw new Exception\OutOfRangeException(
                    'Height offset should be greater than or equals 0.'
            );
        }
        $this->optionHeightOffsetLabel = intval($value);
        return $this;
    }

    /**
     * Set graha label type. Label type provided should be 0, 1 or 2.
     * 
     * @param int $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\UnexpectedValueException
     */
    public function setOptionLabelGrahaType($value)
    {
        if (!in_array($value, [0, 1, 2])) {
            throw new Exception\UnexpectedValueException(
                    "Invalid label type provided should be 0, 1 or 2."
            );
        }
        $this->optionLabelGrahaType = $value;
        return $this;
    }

    /**
     * Set callable function.
     * 
     * @param callable $value
     * @return \Jyotish\Draw\Plot\Chakra\Renderer
     * @throws Exception\RuntimeException
     */
    public function setOptionLabelGrahaCallback($value)
    {
        if (!is_callable($value)) {
            throw new Exception\RuntimeException("Function $value not supported.");
        }
        $this->optionLabelGrahaCallback = $value;
        return $this;
    }
}