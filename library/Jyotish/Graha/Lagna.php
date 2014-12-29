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
class Lagna {
    
    use \Jyotish\Base\DataTrait;
    
    /**
     * Key of Indu lagna
     */
    const KEY_IL = 'IL';
    /**
     * Key of Shree lagna
     */
    const KEY_SL = 'SL';
    
    /**
     * List of extra lagnas.
     * 
     * @var array
     */
    static public $lagna = array(
        self::KEY_IL => 'Indu Lagna',
        self::KEY_SL => 'Shree Lagna',
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
     * Indu lagna calculation.
     * 
     * @return array
     * @see Kalidas. Uttara Kalamritam. Chapter 4, Verse 27.
     */
    public function calcIL()
    {
        $kala = [
            Graha::KEY_SY => 30,
            Graha::KEY_CH => 16,
            Graha::KEY_MA => 6,
            Graha::KEY_BU => 8,
            Graha::KEY_GU => 10,
            Graha::KEY_SK => 12,
            Graha::KEY_SA => 1
        ];
        $rashiRuler = function($rashi){
            $Rashi = Rashi::getInstance($rashi);
            return $Rashi->rashiRuler;
        };
        
        $ruler9FromLg = $rashiRuler($this->ganitaData['bhava'][9]['rashi']);
        $ruler9FromCh = $rashiRuler(Math::numberInCycle($this->ganitaData['graha'][Graha::KEY_CH]['rashi'], 9));
        
        $distance = ($kala[$ruler9FromLg] + $kala[$ruler9FromCh]) % 12;
        if($distance == 0) $distance = 12;
        
        $rashiIL = Math::numberInCycle($this->ganitaData['graha'][Graha::KEY_CH]['rashi'], $distance);
        $degreeIL = $this->ganitaData['graha'][Graha::KEY_CH]['degree'];
        $longitudeIL = ($rashiIL - 1) * 30 + $degreeIL;
        
        return [
            'longitude' => $longitudeIL,
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
    public function calcSL()
    {
        $Panchanga = new \Jyotish\Panchanga\Panchanga($this->ganitaData);
        $nakshatra = $Panchanga->getNakshatra();
        $nakshatraArc = Math::dmsToDecimal(\Jyotish\Panchanga\Nakshatra\Object\NakshatraObject::$nakshatraArc);
        
        $result1 = (1 - $nakshatra['left'] / 100) * 360;
        $result2 = $result1 + $this->ganitaData['extra'][Graha::KEY_LG]['longitude'];
        $lonSL   = $result2 > 360 ? $result2 - 360 : $result2;
        $unitSL  = Math::partsToUnits($lonSL);
        
        return [
            'longitude' => $lonSL,
            'rashi' => $unitSL['units'],
            'degree' => $unitSL['parts']
        ];
    }
}
