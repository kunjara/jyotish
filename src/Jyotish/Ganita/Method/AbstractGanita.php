<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use Jyotish\Ganita\Time;
use Jyotish\Ganita\Ayanamsha;
use Jyotish\Graha\Graha;
use DateTime;

/**
 * Class for calculate the positions of the planets.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractGanita {
    
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Data array.
     * 
     * @var array
     */
    protected $data = [
        'user' => [
            'date'      => null,
            'time'      => null,
            'timezone'  => null,
            'offset'    => 0,
            'longitude' => 0,
            'latitude'  => 0,
        ]
    ];
    
    /**
     * Options of ganita object.
     * 
     * @var array
     */
    protected $options = array(
        'ayanamsha' => Ayanamsha::AYANAMSHA_LAHIRI,
        'rising' => Graha::RISING_HINDU,
    );

    /**
     * Date format.
     * 
     * @var string
     */
    protected $formatDate = Time::FORMAT_DATA_DATE;

    /**
     * Time format.
     * 
     * @var string
     */
    protected $formatTime = Time::FORMAT_DATA_TIME;

    /**
     * Set ayanamsha for calculation.
     * 
     * @param string $ayanamsha
     * @throws Exception\InvalidArgumentException
     * @return Swetest
     */
    public function setOptionAyanamsha($ayanamsha)
    {
        if(key_exists($ayanamsha, $this->inputAyanamsha)) {
            $this->ayanamsha = $ayanamsha;
        } else {
            throw new Exception\InvalidArgumentException("The ayanamsha '$ayanamsha' is not defined.");
        }
        
        return $this;
    }

    /**
     * Set rising (setting) type for calculation.
     * 
     * @param string $rising
     * $throw Exception\InvalidArgumentException
     * @return Swetest
     */
    public function setOptionRising($rising)
    {
        if(array_search($rising, Graha::$risingType)) {
            $this->rising = $rising;
        } else {
            throw new Exception\InvalidArgumentException("The rising '$rising' is not defined.");
        }
        
        return $this;
    }

    /**
     * Set user data.
     * 
     * @param array $userData
     * @throws Exception\UnexpectedValueException
     */
    public function setData(array $userData)
    {
        if(!is_array($userData)) {
            throw new Exception\UnexpectedValueException("Data must be an array.");
        }

        foreach ($userData as $dataName => $dataValue) {
            $dataName = strtolower($dataName);

            if (array_key_exists($dataName, $this->data['user'])) {
                if(!empty($dataValue)) $this->data['user'][$dataName] = $dataValue;
            } else {
                throw new Exception\UnexpectedValueException("Unknown data: $dataName = $dataValue");
            }
        }
        
        $datetime = new DateTime();
        
        if (empty($this->data['user']['date'])){
            $this->data['user']['date'] = $datetime->format(Time::FORMAT_DATA_DATE);
        }
            
        if (empty($this->data['user']['time'])){
            $this->data['user']['time'] = $datetime->format(Time::FORMAT_DATA_TIME);
        }
        
        return $this;
    }

    /**
     * Get data.
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Calculation of coordinates and other parameters of planets and houses.
     * 
     * @abstract
     * @param array $options
     * @return array
     */
    abstract public function calcParams(array $options = null);

    /**
     * Calculation of rising and setting time of planet.
     * 
     * @abstract
     * @param string $graha
     * @param array $options
     * @return array
     */
    abstract public function calcRising($graha, array $options = null);
}
