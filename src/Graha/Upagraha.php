<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;

/**
 * Upagraha calculation class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Upagraha
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * Key of Dhooma
     */
    const KEY_DH = 'Dh';
    /**
     * Key of Vyatipata
     */
    const KEY_VY = 'Vy';
    /**
     * Key of Parivesha
     */
    const KEY_PA = 'Pa';
    /**
     * Key of Indrachapa
     */
    const KEY_IN = 'In';
    /**
     * Key of Upaketu
     */
    const KEY_UK = 'Uk';
    
    /**
     * List of Upagrahas.
     * 
     * @var array
     */
    public static $upagraha = [
        self::KEY_DH => 'Dhooma',
        self::KEY_VY => 'Vyatipata',
        self::KEY_PA => 'Parivesha',
        self::KEY_IN => 'Indrachapa',
        self::KEY_UK => 'Upaketu',
    ];
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);
    }
    
    /**
     * Dhooma calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function getDh()
    {
        $this->checkData();
            
        if (!isset($this->temp[self::KEY_DH])) {
            $result = $this->getData()['graha'][Graha::KEY_SY]['longitude'] + 133 + 1/3;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);

            $this->temp[self::KEY_DH] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->temp[self::KEY_DH];
    }
    
    /**
     * Vyatipata calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function getVy()
    {
        if (!isset($this->temp[self::KEY_VY])) {
            $lng = 360 - $this->getDh()['longitude'];
            $unit = Math::partsToUnits($lng);
            
            $this->temp[self::KEY_VY] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->temp[self::KEY_VY];
    }
    
    /**
     * Parivesha calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function getPa()
    {
        if (!isset($this->temp[self::KEY_PA])) {
            $result = $this->getVy()['longitude'] + 180;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);
            
            $this->temp[self::KEY_PA] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->temp[self::KEY_PA];
    }
    
    /**
     * Indrachapa calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function getIn()
    {
        if (!isset($this->temp[self::KEY_IN])) {
            $lng = 360 - $this->getPa()['longitude'];
            $unit = Math::partsToUnits($lng);
            
            $this->temp[self::KEY_IN] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->temp[self::KEY_IN];
    }
    
    /**
     * Upaketu calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function getUk()
    {
        if (!isset($this->temp[self::KEY_UK])) {
            $result = $this->getIn()['longitude'] + 16 + 2/3;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);

            $this->temp[self::KEY_UK] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->temp[self::KEY_UK];
    }
    
    /**
     * Generation of Upagrahas.
     * 
     * @param null|array $upagrahaKeys Array of upagraha keys
     * @throws Exception\InvalidArgumentException
     */
    public function generateUpagraha(array $upagrahaKeys = null)
    {
        if (is_null($upagrahaKeys)) {
            $upagrahaKeys = array_keys(self::$upagraha);
        }
        
        foreach ($upagrahaKeys as $key) {
            if (!array_key_exists($key, self::$upagraha)) {
                throw new Exception\InvalidArgumentException("Upagraha with the key '$key' does not exist.");
            }
            
            $getUpagraha = 'get'.$key;
            yield $key => $this->$getUpagraha();
        }
    }
}
