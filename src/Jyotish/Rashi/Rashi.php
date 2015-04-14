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
class Rashi {
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
    static public $rashi = array(
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
    );
    
    /**
     * Pushkara bhaga.
     * 
     * @var array
     * @see Vaidyanatha Dikshita. Jataka Parijata. Chapter 1, Verse 58.
     */
    static public $pushkaraBhaga = array(
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
        12 => 9
    );
    
    /**
     * Pushkara navamsha.
     * 
     * @var array
     */
    static public $pushkaraNavamsha = array(
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
        12 => [1, 3]
    );

    /**
     * Trimsamsa is division of each sign into thirty equal parts, each part 
     * being a degree.
     * 
     * @var array
     */
    static private $trimshamshaRuler = array(
        Graha::KEY_MA => 5,
        Graha::KEY_SA => 5,
        Graha::KEY_GU => 8,
        Graha::KEY_BU => 7,
        Graha::KEY_SK => 5
    );
    
    /**
     * Devanagari 'rashi' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    static public $translit = ['ra','aa','sha','i'];

    /**
     * Returns the requested instance of rashi class.
     * 
     * @param int $key The number of rashi
     * @param null|array $options Options to set (optional)
     * - `rashi5Vana`: set type of jiva for 5th rashi as vana (wild)
     * @return the requested instance of rashi class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key, array $options = null) {
        if (!array_key_exists($key, self::$rashi)) {
            throw new Exception\InvalidArgumentException("Rashi with the key '$key' does not exist.");
        }
        
        $rashiClass = 'Jyotish\\Rashi\\Object\\R' . $key;
        $rashiObject = new $rashiClass($options);

        return $rashiObject;
    }
    
    /**
     * Get trimshamsha rulers.
     * 
     * @param int $key Rashi key
     * @return array Trimshamsha rulers
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 7.
     */
    static public function trimshamshaRulerList($key)
    {
        $rulers = $key % 2 ? self::$trimshamshaRuler : array_reverse(self::$trimshamshaRuler);
        
        return $rulers;
    }
}