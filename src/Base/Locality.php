<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * Locality class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Locality
{
    protected $longitude = null;
    protected $latitude = null;
    protected $altitude = 0.0;
    
    /**
     * Constructor
     * 
     * @param array $locality Locality to set
     */
    public function __construct(array $locality)
    {
        if (isset($locality['longitude'])) {
            $this->setLongitude($locality['longitude']);
        }
        if (isset($locality['latitude'])) {
            $this->setLatitude($locality['latitude']);
        }
        if (isset($locality['altitude'])) {
            $this->setAltitude($locality['altitude']);
        }
    }
    
    /**
     * Set longitude.
     * 
     * @param float $longitude
     * @return Locality
     * @throws Exception\InvalidArgumentException
     */
    public function setLongitude($longitude)
    {
        if (!is_numeric($longitude) || abs($longitude) >= 180) {
            throw new Exception\InvalidArgumentException("Longitude should be numeric and module less than 180.");
        }
        
        $this->longitude = (float)$longitude;
        
        return $this;
    }
    
    /**
     * Set latitude.
     * 
     * @param float $latitude
     * @return Locality
     * @throws Exception\InvalidArgumentException
     */
    public function setLatitude($latitude)
    {
        if (!is_numeric($latitude) || abs($latitude) >= 90) {
            throw new Exception\InvalidArgumentException("Latitude should be numeric and module less than 90.");
        }
        
        $this->latitude = (float)$latitude;
        
        return $this;
    }
    
    /**
     * Set altitude.
     * 
     * @param float $altitude
     * @return Locality
     * @throws Exception\InvalidArgumentException
     */
    public function setAltitude($altitude)
    {
        if (!is_numeric($altitude)) {
            throw new Exception\InvalidArgumentException("Altitude should be numeric.");
        }
        
        $this->altitude = (float)$altitude;
        
        return $this;
    }
    
    /**
     * Get longitude.
     * 
     * @return float
     */
    public function getLongitude()
    {
        if (is_null($this->longitude)) {
            throw new Exception\UnderflowException("Longitude is not setted.");
        }
        
        return $this->longitude;
    }
    
    /**
     * Get latitude.
     * 
     * @return float
     */
    public function getLatitude()
    {
        if (is_null($this->latitude)) {
            throw new Exception\UnderflowException("Latitude is not setted.");
        }
        
        return $this->latitude;
    }
    
    /**
     * Get altitude.
     * 
     * @return float
     */
    public function getAltitude()
    {
        return $this->altitude;
    }
}
