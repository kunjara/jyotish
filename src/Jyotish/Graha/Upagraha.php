<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

use Jyotish\Ganita\Math;
use Jyotish\Graha\Graha;

/**
 * Upagraha calculation class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Upagraha {
    
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
    static public $upagraha = array(
        self::KEY_DH => 'Dhooma',
        self::KEY_VY => 'Vyatipata',
        self::KEY_PA => 'Parivesha',
        self::KEY_IN => 'Indrachapa',
        self::KEY_UK => 'Upaketu',
    );
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data|array $data
     */
    public function __construct($data) {
        $this->setData($data);
    }
    
    /**
     * Dhooma calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function calcDh()
    {
        if(!isset($this->ganitaData['upagraha'][self::KEY_DH])){
            $result = $this->ganitaData['graha'][Graha::KEY_SY]['longitude'] + 133 + 1/3;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);

            $this->ganitaData['upagraha'][self::KEY_DH] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->ganitaData['upagraha'][self::KEY_DH];
    }
    
    /**
     * Vyatipata calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function calcVy()
    {
        if(!isset($this->ganitaData['upagraha'][self::KEY_VY])){
            $lng = 360 - $this->calcDh()['longitude'];
            $unit = Math::partsToUnits($lng);
            
            $this->ganitaData['upagraha'][self::KEY_VY] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->ganitaData['upagraha'][self::KEY_VY];
    }
    
    /**
     * Parivesha calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function calcPa()
    {
        if(!isset($this->ganitaData['upagraha'][self::KEY_PA])){
            $result = $this->calcVy()['longitude'] + 180;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);
            
            $this->ganitaData['upagraha'][self::KEY_PA] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->ganitaData['upagraha'][self::KEY_PA];
    }
    
    /**
     * Indrachapa calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function calcIn()
    {
        if(!isset($this->ganitaData['upagraha'][self::KEY_IN])){
            $lng = 360 - $this->calcPa()['longitude'];
            $unit = Math::partsToUnits($lng);
            
            $this->ganitaData['upagraha'][self::KEY_IN] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->ganitaData['upagraha'][self::KEY_IN];
    }
    
    /**
     * Upaketu calculation.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 25, Verse 5.
     */
    public function calcUk()
    {
        if(!isset($this->ganitaData['upagraha'][self::KEY_UK])){
            $result = $this->calcIn()['longitude'] + 16 + 2/3;
            $lng = $result > 360 ? $result - 360 : $result;
            $unit = Math::partsToUnits($lng);

            $this->ganitaData['upagraha'][self::KEY_UK] = [
                'longitude' => $lng,
                'rashi' => $unit['units'],
                'degree' => $unit['parts']
            ];
        }
        return $this->ganitaData['upagraha'][self::KEY_UK];
    }
    
    /**
     * Generation of Upagrahas.
     * 
     * @param null|array $upagrahaKeys Array of upagraha keys
     * @throws Exception\InvalidArgumentException
     */
    public function generateUpagraha(array $upagrahaKeys = null)
    {
        if(is_null($upagrahaKeys)){
            $upagrahaKeys = array_keys(self::$upagraha);
        }
        
        foreach ($upagrahaKeys as $key){
            if (!array_key_exists($key, self::$upagraha)){
                throw new Exception\InvalidArgumentException("Upagraha with the key '$key' does not exist.");
            }
            
            $calcUpagraha = 'calc'.$key;
            yield $key => $this->$calcUpagraha();
        }
    }
}
