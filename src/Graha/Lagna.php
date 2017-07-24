<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

use Jyotish\Ganita\Math;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;

/**
 * Extra lagna class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Lagna
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * Key of Janma lagna (Ascendant)
     */
    const KEY_LG = 'Lg';
    /**
     * Key of Patala lagna 
     */
    const KEY_PLG = 'PLg';
    /**
     * Key of Astha lagna
     */
    const KEY_ALG = 'ALg';
    /**
     * Key of Madhya lagna
     */
    const KEY_MLG = 'MLg';
    
    /**
     * Key of Indu lagna
     */
    const KEY_IL = 'IL';
    /**
     * Key of Shree lagna
     */
    const KEY_SL = 'SL';
    
    /**
     * Name of Ascendant
     */
    const NAME_LG = 'Lagna';
    
    /**
     * List of extra lagnas.
     * 
     * @var array
     */
    public static $lagna = [
        self::KEY_IL => 'Indu Lagna',
        self::KEY_SL => 'Shree Lagna',
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
     * Indu lagna calculation.
     * 
     * @return array
     * @see Kalidas. Uttara Kalamritam. Chapter 4, Verse 27.
     */
    public function getIL()
    {
        $this->checkData(__FUNCTION__);
        
        $kala = [
            Graha::KEY_SY => 30,
            Graha::KEY_CH => 16,
            Graha::KEY_MA => 6,
            Graha::KEY_BU => 8,
            Graha::KEY_GU => 10,
            Graha::KEY_SK => 12,
            Graha::KEY_SA => 1
        ];
        $rashiRuler = function ($rashi) {
            $Rashi = Rashi::getInstance($rashi);
            return $Rashi->rashiRuler;
        };
        
        $ruler9FromLg = $rashiRuler($this->getData()['bhava'][9]['rashi']);
        $ruler9FromCh = $rashiRuler(Math::numberInCycle($this->getData()['graha'][Graha::KEY_CH]['rashi'], 9));
        
        $distance = ($kala[$ruler9FromLg] + $kala[$ruler9FromCh]) % 12;
        if ($distance == 0) $distance = 12;
        
        $rashiIL  = Math::numberInCycle($this->getData()['graha'][Graha::KEY_CH]['rashi'], $distance);
        $degreeIL = $this->getData()['graha'][Graha::KEY_CH]['degree'];
        $lngIL    = ($rashiIL - 1) * 30 + $degreeIL;
        
        return [
            'longitude' => $lngIL,
            'rashi' => $rashiIL,
            'degree' => $degreeIL
        ];
    }
    
     /**
     * Shree lagna calculation.
     * 
     * @return array
     * @see Maharishi Jaimini. Jaimini Upadesha Sutras. Chapter 2, Quarter 4, Verse 27.
     */
    public function getSL()
    {
        $this->checkData(__FUNCTION__);
        
        $nakshatra = $this->getData()['panchanga']['nakshatra'];
        
        $result1 = (1 - $nakshatra['left'] / 100) * 360;
        $result2 = $result1 + $this->getData()['lagna'][Graha::KEY_LG]['longitude'];
        $lngSL   = $result2 > 360 ? $result2 - 360 : $result2;
        $unitSL  = Math::partsToUnits($lngSL);
        
        return [
            'longitude' => $lngSL,
            'rashi' => $unitSL['units'],
            'degree' => $unitSL['parts']
        ];
    }
    
    /**
     * Generation of lagnas.
     * 
     * @param null|array $lagnaKeys Array of lagna keys
     * @throws Exception\InvalidArgumentException
     */
    public function generateLagna(array $lagnaKeys = null)
    {
        if (is_null($lagnaKeys)) {
            $lagnaKeys = array_keys(self::$lagna);
        }
        
        foreach ($lagnaKeys as $key) {
            if (!array_key_exists($key, self::$lagna)) {
                throw new Exception\InvalidArgumentException("Lagna with the key '$key' does not exist.");
            }
            
            $getLagna = 'get'.$key;
            yield $key => $this->$getLagna();
        }
    }
    
    /**
     * Check data.
     * 
     * @param null|string $function Function name
     * @return void
     */
    private function checkData($function = null)
    {
        if (!isset($this->getData()['graha'])) {
            $this->Data->calcParams();
        }

        if ($function == 'getSL' && !isset($this->getData()['panchanga']['nakshatra'])) {
            $this->Data->calcPanchanga(['nakshatra']);
        }
    }
}
