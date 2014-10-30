<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use Jyotish\Ganita\Time;
use Jyotish\Ganita\Ayanamsha;
use Jyotish\Graha\Graha;

/**
 * Class for calculate the positions of the planets.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractGanita {
    /**
     * Birth data.
     * 
     * @var array
     */
    protected $data = array(
        'date'      => null,
        'time'      => null,
        'timezone'  => 'UTC',
        'offset'    => 0,
        'longitude' => 0,
        'latitude'  => 0,
    );

    /**
     * Ayanamsha option.
     * 
     * @var string
     */
    protected $ayanamsha = Ayanamsha::AYANAMSHA_LAHIRI;

    /**
     * Rising option.
     * 
     * @var string
     */
    protected $rising = Graha::RISING_HINDU;

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
     * Set options.
     * 
     * @param array $options
     * @throws Exception\InvalidArgumentException
     * @return Swetest
     */
    public function setOptions(array $options = array()) {
        foreach ($options as $key => $value) {
            $method = 'set' . $key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                $this->$key = $value;
            }
        }
        return $this;
    }

    /**
     * Set ayanamsha for calculation.
     * 
     * @param string $ayanamsha
     * @throws Exception\InvalidArgumentException
     * @return Swetest
     */
    public function setAyanamsha($ayanamsha)
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
    public function setRising($rising)
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
     * @param array $data
     * @throws Exception\UnexpectedValueException
     */
    public function setData(array $data)
    {
        if(!is_array($data)) {
            throw new Exception\UnexpectedValueException("Data must be an array.");
        }

        foreach ($data as $dataName => $dataValue) {
            $dataName = strtolower($dataName);

            if (array_key_exists($dataName, $this->data)) {
                if(!empty($dataValue)) $this->data[$dataName] = $dataValue;
            } else {
                throw new Exception\UnexpectedValueException("Unknown data: $dataName = $dataValue");
            }

            if (empty($this->data['date']))
                $this->data['date'] = Time::getDateNow();
            if (empty($this->data['time']))
                $this->data['time'] = Time::getTimeNow();
        }
    }

    /**
     * Get user data.
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get coordinates and other parameters of planets and houses.
     * 
     * @abstract
     * @param array $options
     * @return array
     */
    abstract public function getParams(array $options);

    /**
     * Get the time of sunrise and sunset of planet.
     * 
     * @abstract
     * @param string $graha
     * @param array $options
     * @return array
     */
    abstract public function getRisings($graha, array $options);
}
