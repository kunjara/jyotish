<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi;

use Jyotish\Graha\Graha;

/**
 * Class with Rashi names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Rashi
{
    /**
     * Movable
     */
    const BHAVA_CHARA   = 'chara';
    /**
     * Fixed
     */
    const BHAVA_STHIRA  = 'sthira';
    /**
     * Dual
     */
    const BHAVA_DVISVA  = 'dvisva';

    const BALA_RATRI    = 'ratri';
    const BALA_DINA     = 'dina';

    const DAYA_SIRSHA   = 'sirsha';
    const DAYA_PRUSHTA  = 'prushta';
    const DAYA_UBHAYA   = 'ubhaya';
    
    /**
     * Ucha (exaltation)
     */
    const GRAHA_UCHA = 'ucha';
    /**
     * Moolatrikona (trinal strength)
     */
    const GRAHA_MOOL = 'mool';
    /**
     * Swakshetra (own)
     */
    const GRAHA_SWA = 'swa';
    /**
     * Friend
     */
    const GRAHA_FRIEND  = 'friend';
    /**
     * Neutral
     */
    const GRAHA_NEUTRAL = 'neutral';
    /**
     * Enemy
     */
    const GRAHA_ENEMY   = 'enemy';
    /**
     * Neecha (debilitation)
     */
    const GRAHA_NEECHA = 'neecha';
    
    const NAME_1 = 'Mesha';
    const NAME_2 = 'Vrishabha';
    const NAME_3 = 'Mithuna';
    const NAME_4 = 'Karka';
    const NAME_5 = 'Simha';
    const NAME_6 = 'Kanya';
    const NAME_7 = 'Tula';
    const NAME_8 = 'Vrishchika';
    const NAME_9 = 'Dhanu';
    const NAME_10 = 'Makara';
    const NAME_11 = 'Kumbha';
    const NAME_12 = 'Meena';

    /**
     * List of rashis.
     * 
     * @var array 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 3.
     */
    public static $rashi = [
        1 => self::NAME_1,
        2 => self::NAME_2,
        3 => self::NAME_3,
        4 => self::NAME_4,
        5 => self::NAME_5,
        6 => self::NAME_6,
        7 => self::NAME_7,
        8 => self::NAME_8,
        9 => self::NAME_9,
        10 => self::NAME_10,
        11 => self::NAME_11,
        12 => self::NAME_12,
    ];
    
    /**
     * States of the planet, depending on location in the rashis.
     * 
     * @var array
     */
    public static $grahaAvastha = [
        self::GRAHA_UCHA,
        self::GRAHA_MOOL,
        self::GRAHA_SWA,
        self::GRAHA_FRIEND,
        self::GRAHA_NEUTRAL,
        self::GRAHA_ENEMY,
        self::GRAHA_NEECHA,
    ];
    
    /**
     * Pushkara bhaga.
     * 
     * @var array
     * @see Vaidyanatha Dikshita. Jataka Parijata. Chapter 1, Verse 58.
     */
    public static $pushkaraBhaga = [
        1 => 21,
        2 => 14,
        3 => 18,
        4 => 8,
        5 => 19,
        6 => 9,
        7 => 24,
        8 => 11,
        9 => 23,
        10 => 14,
        11 => 19,
        12 => 9,
    ];
    
    /**
     * Pushkara navamsha.
     * 
     * @var array
     */
    public static $pushkaraNavamsha = [
        1 => [7, 9],
        2 => [3, 5],
        3 => [6, 8],
        4 => [1, 3],
        5 => [7, 9],
        6 => [3, 5],
        7 => [6, 8],
        8 => [1, 3],
        9 => [7, 9],
        10 => [3, 5],
        11 => [6, 8],
        12 => [1, 3],
    ];

    /**
     * Trimsamsa is division of each sign into thirty equal parts, each part 
     * being a degree.
     * 
     * @var array
     */
    private static $trimshamshaRuler = [
        Graha::KEY_MA => 5,
        Graha::KEY_SA => 5,
        Graha::KEY_GU => 8,
        Graha::KEY_BU => 7,
        Graha::KEY_SK => 5,
    ];

    /**
     * Devanagari 'rashi' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    public static $translit = ['ra','aa','sha','i'];

    /**
     * Returns the requested instance of rashi class.
     * 
     * @param int $key The number of rashi
     * @param null|array $options Options to set (optional)
     * - `rashi5IsVana`: set type of jiva for 5th rashi as vana (wild)
     * @return the requested instance of rashi class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($key, array $options = null)
    {
        if (!array_key_exists($key, self::$rashi)) {
            throw new Exception\InvalidArgumentException("Rashi with the key '$key' does not exist.");
        }
        
        $rashiClass = 'Jyotish\\Rashi\\Object\\R' . $key;
        $rashiObject = new $rashiClass($options);

        return $rashiObject;
    }
    
    /**
     * Get list of rashis by feature.
     * 
     * @param string $feature Feature of rashi
     * @param string $value Value of feature
     * @return array
     */
    public static function listRashiByFeature($feature, $value)
    {
        $result = [];

        foreach (self::$rashi as $key => $name) {
            $Rashi = self::getInstance($key);
            
            $rashiFeature = 'rashi' . ucfirst(strtolower($feature));
            
            if (!property_exists($Rashi, $rashiFeature)) {
                throw new Exception\UnexpectedValueException("Rashi feature '$rashiFeature' does not exist.");
            }
            
            $Rashi->$rashiFeature == $value ? $result[$key] = $name : null;
        }
        return $result;
    }
    
    /**
     * Get trimshamsha rulers.
     * 
     * @param int $key Rashi key
     * @return array Trimshamsha rulers
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 27-28.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 7.
     */
    public static function listTrimshamshaRuler($key)
    {
        $rulers = $key % 2 ? self::$trimshamshaRuler : array_reverse(self::$trimshamshaRuler);
        
        return $rulers;
    }
}