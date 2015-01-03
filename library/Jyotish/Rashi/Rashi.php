<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi;

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
     * @param null|array $options (Optional) Options to set
     * - `rashi5Vana`: set type of jiva for 5 rashi as vana (wild)
     * @return the requested instance of rashi class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key, $options = null) {
        if (array_key_exists($key, self::$rashi)) {
            $rashiClass = 'Jyotish\\Rashi\\Object\\R' . $key;
            $rashiObject = new $rashiClass($options);

            return $rashiObject;
        } else {
            throw new Exception\InvalidArgumentException("Rashi with the key '$key' does not exist.");
        }
    }
}