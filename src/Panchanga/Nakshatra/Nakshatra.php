<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra;

use Jyotish\Ganita\Math;

/**
 * Class with Nakshatra names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Nakshatra
{
    /**
     * Movable constellation
     */
    const TYPE_CHARANA = 'charana';
    /**
     * Fixed constellation
     */
    const TYPE_DHRUVA = 'dhruva';
    /**
     * Small constellation
     */
    const TYPE_KSHIPRA = 'kshipra';
    /**
     * Delicate & Friendly constellation
     */
    const TYPE_MRIDU = 'mridu';
    /**
     * Mixed constellation
     */
    const TYPE_SADHARANA = 'sadharana';
    /**
     * Sharp & Horrible constellation
     */
    const TYPE_TIKSHNA = 'tikshna';
    /**
     * Cruel constellation
     */
    const TYPE_UGRA = 'ugra';

    const ENERGY_SRISHTI = 'srishti';
    const ENERGY_STHITI = 'sthiti';
    const ENERGY_LAYA = 'laya';

    const LIFT_AROHA = 'aroha';
    const LIFT_AVAROHA = 'avaroha';

    const LIMB_KANTHA = 'kantha';
    const LIMB_KATI = 'kati';
    const LIMB_PADA = 'pada';
    const LIMB_SHIRO = 'shiro';
    const LIMB_NABHI = 'nabhi';

    /**
     * Array of all nakshatras.
     * 
     * @var array 
     */
    public static $nakshatra = [
        1 => 'Ashwini',
        2 => 'Bharani',
        3 => 'Krittika',
        4 => 'Rohini',
        5 => 'Mrigashirsha',
        6 => 'Ardra',
        7 => 'Punarvasu',
        8 => 'Pushya',
        9 => 'Ashlesha',
        10 => 'Magha',
        11 => 'Poorva Phalguni',
        12 => 'Uttara Phalguni',
        13 => 'Hasta',
        14 => 'Chitra',
        15 => 'Swati',
        16 => 'Vishakha',
        17 => 'Anuradha',
        18 => 'Jyeshtha',
        19 => 'Moola',
        20 => 'Purva Ashadha',
        21 => 'Uttara Ashadha',
        22 => 'Shravana',
        23 => 'Dhanishta',
        24 => 'Shatabhisha',
        25 => 'Purva Bhadrapada',
        26 => 'Uttara Bhadrapada',
        27 => 'Revati',
        28 => 'Abhijit',
    ];

    /**
     * Array of navatara (nine stars).
     * 
     * @var array 
     */
    public static $navatara = [
        1 => 'Janma',
        2 => 'Sampat',
        3 => 'Vipat',
        4 => 'Kshema',
        5 => 'Pratyak',
        6 => 'Saadhana',
        7 => 'Naidhana',
        8 => 'Mitra',
        9 => 'Atimitra'
    ];
    
    /**
     * List of nakshatra types.
     * 
     * @var array
     */
    public static $type = [
        self::TYPE_CHARANA,
        self::TYPE_DHRUVA,
        self::TYPE_KSHIPRA,
        self::TYPE_MRIDU,
        self::TYPE_SADHARANA,
        self::TYPE_TIKSHNA,
        self::TYPE_UGRA,
    ];

    /**
     * Devanagari title 'nakshatra' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    public static $translit = ['na','ka','virama','ssa','ta','virama','ra'];
    
    /**
     * Arc value of nakshatra.
     * 
     * @var array 
     */
    public static $arc = ['d' => 13, 'm' => 20, 's' => 0];
    
    /**
     * Returns the requested instance of nakshatra class.
     * 
     * @param int $key The key of nakshatra
     * @param null|array $options Options to set (optional)
     * - `withAbhijit`: with Abhijit
     * @return the requested instance of nakshatra class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($key, array $options = null)
    {
        if (!array_key_exists($key, self::$nakshatra)) {
            throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Nakshatra with the key '$key' does not exist.");
        }

        $nakshatraClass = 'Jyotish\\Panchanga\\Nakshatra\\Object\\N' . $key;
        $nakshatraObject = new $nakshatraClass($options);

        return $nakshatraObject;
    }

    /**
     * Returns the list of nakshatras.
     * 
     * @param bool $withAbhijit
     * @return array
     */
    public static function listNakshatra($withAbhijit = false)
    {
        $nakshatras = self::$nakshatra;

        if ($withAbhijit) {
            $result = 
                array_slice($nakshatras, 0, 21, true) +
                array_slice($nakshatras, -1, 1, true) + 
                array_slice($nakshatras, 21, 6, true); 
        } else {
            unset($nakshatras[28]);
            $result = $nakshatras;
        }
        return $result;
    }
    
    /**
     * Returns the list of navataras for nakshatra. Will be very useful when 
     * choosing Muhurta.
     * 
     * @param string $nakshatraKey Nakshatra key
     * @return array
     */
    public static function listNakshatraNavatara($nakshatraKey)
    {
        if (!array_key_exists($nakshatraKey, self::listNakshatra())) {
            throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Nakshatra with the key '$nakshatraKey' does not exist.");
        }
        
        $nakshatas = Math::shiftArray(self::listNakshatra(), $nakshatraKey);

        $number = 1;
        $block = 1;
        
        $navataras = [];
        foreach ($nakshatas as $key => $name) {
            $navataras[$key] = [
                'block' => $block,
                'number' => $number,
                'name' => self::$navatara[$number]
            ];
            
            $number++;
            if ($number > 9) {
                $block += 1;
                $number = 1;
            }
        }
        
        return $navataras;
    }
}