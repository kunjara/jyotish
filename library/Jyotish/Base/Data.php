<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Graha\Graha;
use Jyotish\Bhava\Bhava;
use Jyotish\Graha\Lagna;
use Jyotish\Ganita\Math;

/**
 * Data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Data {
    /**
     * Graha block
     */
    const BLOCK_GRAHA = 'graha';
    /**
     * Extra block
     */
    const BLOCK_EXTRA = 'extra';
    /**
     * Bhava block
     */
    const BLOCK_BHAVA = 'bhava';
    /**
     * User block
     */
    const BLOCK_USER  = 'user';
    /**
     * More block
     */
    const BLOCK_MORE  = 'more';

    /**
     * Data template.
     * 
     * @var array
     */
    protected $dataTemplate = [
        self::BLOCK_GRAHA => [
            'element' => ['longitude', 'latitude', 'speed']
        ],
        self::BLOCK_EXTRA => [
            'element' => ['longitude']
        ],
        self::BLOCK_BHAVA => [
            'element' => ['longitude']
        ],
        self::BLOCK_USER => ['gender']
    ];

    protected $dataRequired = [
        self::BLOCK_GRAHA, 
        self::BLOCK_EXTRA
    ];

    /**
     * Analyzed data.
     * 
     * @var array
     */
    protected $ganitaData;

    /**
     * Array with values ​​of the rashis in the bhavas.
     * 
     * @var array
     */
    protected $rashiInBhava = array();

    /**
     * Array with values ​​of the grahas in the bhavas.
     * 
     * @var array
     */
    protected $grahaInBhava = array();

    /**
     * Array with values ​​of the grahas in the rashis.
     * 
     * @var array
     */
    protected $grahaInRashi = array();

    /**
     * Constructor
     * 
     * @param array $ganitaData
     */
    public function __construct(array $ganitaData) {
        $this->checkData($ganitaData);

        foreach ($this->dataRequired as $block){
            foreach($this->ganitaData[$block] as $key => $params){
                if(!isset($params['rashi'])){
                    $units = Math::partsToUnits($params['longitude']);
                    $this->ganitaData[$block][$key]['rashi'] = $units['units'];
                    $this->ganitaData[$block][$key]['degree'] = $units['parts'];
                }
            }
        }

        if(!isset($this->ganitaData['bhava'])){
            $longitude = $this->ganitaData['extra'][Graha::KEY_LG]['longitude'];
            for($b = 1; $b <= 12; $b++){
                $this->ganitaData['bhava'][$b]['longitude'] = $longitude < 360 ? $longitude : $longitude - 360;
                $units = Math::partsToUnits($this->ganitaData['bhava'][$b]['longitude']);
                $this->ganitaData['bhava'][$b]['rashi'] = $units['units'];
                $this->ganitaData['bhava'][$b]['degree'] = $units['parts'];
                $longitude += 30;
            }
        }

        $this->rashiInBhava = $this->getRashiInBhava();
    }

    /**
     * Check incoming data.
     * 
     * @throws Exception\InvalidArgumentException
     */
    protected function checkData($ganitaData)
    {
        foreach ($this->dataRequired as $block){
            if(!key_exists($block, $ganitaData))
                throw new Exception\InvalidArgumentException("Block '$block' is not found in the data.");
        }

        $checkBlock = function($block, $value){
            if($block == self::BLOCK_GRAHA) $elements = Graha::$graha;
            elseif($block == self::BLOCK_BHAVA) $elements = Bhava::$bhava;
            elseif($block == self::BLOCK_EXTRA) $elements = [Graha::KEY_LG => 'Lagna'];
            else $elements = array();

            foreach ($elements as $key => $name){
                if(!isset($value[$key]))
                    throw new Exception\InvalidArgumentException("Key '$key' in block '$block' is not found.");

                foreach ($this->dataTemplate[$block]['element'] as $propName){
                    if(!array_key_exists($propName, $value[$key]))
                        throw new Exception\InvalidArgumentException("Property '$propName' in element '$key $block' is not found.");
                }
            }
        };

        foreach ($ganitaData as $block => $value){
            if(defined('self::BLOCK_'.strtoupper($block))){
                $checkBlock($block, $value);
                $this->ganitaData[$block] = $value;
            }else{
                continue;
            }

        }
    }

    /**
     * Get Ganita data.
     */
    public function getData()
    {
        return $this->ganitaData;
    }
    
    /**
     * Calculation of extra lagnas.
     * 
     * @param null|array $lagnas Array of lagna keys
     * @throws Exception\InvalidArgumentException
     */
    public function calcExtraLagna(array $lagnas = null)
    {
        $Lagna = new Lagna($this->ganitaData);
        
        if(is_null($lagnas)){
            $lagnas = array_keys(Lagna::$lagna);
        }
        
        foreach ($lagnas as $key){
            if (!array_key_exists($key, Lagna::$lagna)){
                throw new Exception\InvalidArgumentException("Lagna with the key '$key' does not exist.");
            }
            $calcLagna = 'calc'.$key;
            $this->ganitaData['extra'][$key] = $Lagna->$calcLagna();
        }
    }

    /**
     * Get rashi in bhava.
     * 
     * @return array
     */
    public function getRashiInBhava() {
        foreach ($this->ganitaData['bhava'] as $bhava => $params) {
            $rashi = $params['rashi'];
            $this->rashiInBhava[$rashi] = $bhava;
        }
        return $this->rashiInBhava;
    }

    /**
     * Get graha in bhava.
     * 
     * @return array
     */
    public function getGrahaInBhava() {
        foreach ($this->ganitaData['graha'] as $graha => $params) {
            $rashi = $params['rashi'];

            $bhava = $this->rashiInBhava[$rashi];
            $direction = $params['speed'] > 0 ? 1 : -1;

            $this->grahaInBhava[$graha] = array(
                'bhava' => $bhava,
                'direction' => $direction,
            );
        }
        return $this->grahaInBhava;
    }

    /**
     * Get graha in rashi.
     * 
     * @return array
     */
    public function getGrahaInRashi() {
        foreach ($this->ganitaData['graha'] as $graha => $params) {
            $rashi = $params['rashi'];
            $direction = $params['speed'] > 0 ? 1 : -1;

            $this->grahaInRashi[$graha] = array(
                'rashi' => $rashi,
                'direction' => $direction,
            );
        }
        $this->grahaInRashi[Graha::KEY_LG]['rashi'] = $this->ganitaData['extra']['Lg']['rashi'];
        $this->grahaInRashi[Graha::KEY_LG]['direction'] = 1;

        return $this->grahaInRashi;
    }
}