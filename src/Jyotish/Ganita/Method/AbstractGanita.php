<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use Jyotish\Ganita\Ayanamsha;
use Jyotish\Graha\Graha;

/**
 * Class for calculate the positions of the planets.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractGanita
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
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
     * Set ayanamsha for calculation.
     * 
     * @param string $ayanamsha
     * @return Swetest
     * @throws Exception\InvalidArgumentException
     */
    public function setOptionAyanamsha($ayanamsha)
    {
        if (key_exists($ayanamsha, $this->inputAyanamsha)) {
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
     * @return Swetest
     * @throw Exception\InvalidArgumentException
     */
    public function setOptionRising($rising)
    {
        if (array_search($rising, Graha::$risingType)) {
            $this->rising = $rising;
        } else {
            throw new Exception\InvalidArgumentException("The rising '$rising' is not defined.");
        }
        
        return $this;
    }

    /**
     * Calculation of coordinates and other parameters of planets and houses.
     * 
     * @abstract
     * @param array $params
     * @param array $options
     * @return array
     */
    abstract public function getParams(array $params = null, array $options = null);

    /**
     * Calculation of rising and setting time of planet.
     * 
     * @abstract
     * @param string $graha
     * @param array $options
     * @return array
     */
    abstract public function getRising($graha = Graha::KEY_SY, array $options = null);
}
