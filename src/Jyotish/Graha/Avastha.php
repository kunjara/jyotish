<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

/**
 * Avastha data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Avastha {
    /**
     * Infant state
     */
    const NAME_BALA = 'bala';
    /**
     * Youthful state
     */
    const NAME_KUMARA = 'kumara';
    /**
     * Adolescent state
     */
    const NAME_YUVA = 'yuva';
    /**
     * Old state
     */
    const NAME_VRIDHA = 'vridha';
    /**
     * Dead state
     */
    const NAME_MRITA = 'mrita';
    
    /**
     * Awakening state
     */
    const NAME_JAGRITA = 'jagrita';
    /**
     * Dreaming state
     */
    const NAME_SVAPNA = 'svapna';
    /**
     * Sleeping state
     */
    const NAME_SUSHUPTA = 'sushupta';
    
    /**
     * Graha in its exaltation sign.
     */
    const NAME_DIPTA = 'dipta';
    /**
     * Graha in own sign.
     */
    const NAME_SWASTHA = 'swastha';
    /**
     * Graha in best friend's sign.
     */
    const NAME_PRAMUDITA = 'pramudita';
    /**
     * Graha in friend's sign.
     */
    const NAME_SHANTA = 'shanta';
    /**
     * Graha in neutral sign.
     */
    const NAME_DINA = 'dina';
    /**
     * Graha in enemys's sign.
     */
    const NAME_DUKHITA = 'dukhita';
    /**
     * Graha in the company of a malefic.
     */
    const NAME_VIKALA = 'vikala';
    /**
     * Graha in unfavorable sign.
     */
    const NAME_KHALA = 'khala';
    /**
     * Graha, which is connected to the Surya.
     */
    const NAME_KOPA = 'kopa';
    
    /**
     * Ashamed state
     */
    const NAME_LAJJITA = 'lajjita';
    /**
     * Proud state
     */
    const NAME_GARVITA = 'garvita';
    /**
     * Hungry state
     */
    const NAME_KSHUDHITA = 'kshudhita';
    /**
     * Thirsty state
     */
    const NAME_TRUSHITA = 'trushita';
    /**
     * Joyful state
     */
    const NAME_MUDITA = 'mudita';
    /**
     * Excited state
     */
    const NAME_KSHOBHITA = 'kshobhita';
    
    /**
     * Resting state
     */
    const NAME_SAYANA = 'sayana';
    /**
     * Seated state
     */
    const NAME_UPAVESHANA = 'upaveshana';
    /**
     * Literally 'eyes and hands'
     */
    const NAME_NETRAPANI = 'netrapani';
    /**
     * Shining state
     */
    const NAME_PRAKASHANA = 'prakashana';
    /**
     * Going state
     */
    const NAME_GAMANA = 'gamana';
    /**
     * Returning state
     */
    const NAME_AGAMANA = 'agamana';
    /**
     * Dealing state
     */
    const NAME_SABHA = 'sabha';
    /**
     * Coming state
     */
    const NAME_AGAMA = 'agama';
    /**
     * Dinner state
     */
    const NAME_BHOJANA = 'bhojana';
    /**
     * Dancing state
     */
    const NAME_NRITYALIPSAYA = 'nrityalipsaya';
    /**
     * Tending state
     */
    const NAME_KAUTUKA = 'kautuka';
    /**
     * Sleeping state
     */
    const NAME_NIDRA = 'nidra';

    /**
     * Results of age avasthas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 4.
     */
    public static $avasthaAge = [
        self::NAME_BALA => .25,
        self::NAME_KUMARA => .5,
        self::NAME_YUVA => 1,
        self::NAME_VRIDHA => .125,
        self::NAME_MRITA => 0
    ];
    
    /**
     * Results of wake avasthas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 6.
     */
    public static $avasthaWake = [
        self::NAME_JAGRITA => 1,
        self::NAME_SVAPNA => .5,
        self::NAME_SUSHUPTA => 0
    ];
    
    /**
     * Results of mood avasthas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 8-10.
     */
    public static $avasthaMood = [
        self::NAME_DIPTA => 1,
        self::NAME_SWASTHA => 1,
        self::NAME_PRAMUDITA => 1,
        self::NAME_SHANTA => .5,
        self::NAME_DINA => .5,
        self::NAME_DUKHITA => .125,
        self::NAME_VIKALA => .125,
        self::NAME_KHALA => .125,
        self::NAME_KOPA => .125
    ];
    
    /**
     * Avasthas associated with tone.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 11-18.
     */
    public static $avasthaTone = [
        self::NAME_LAJJITA,
        self::NAME_GARVITA,
        self::NAME_KSHUDHITA,
        self::NAME_TRUSHITA,
        self::NAME_MUDITA,
        self::NAME_KSHOBHITA
    ];
    
    /**
     * Avasthas associated with action.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 30-37.
     */
    public static $avasthaAction = [
        self::NAME_SAYANA,
        self::NAME_UPAVESHANA,
        self::NAME_NETRAPANI,
        self::NAME_PRAKASHANA,
        self::NAME_GAMANA,
        self::NAME_AGAMANA,
        self::NAME_SABHA,
        self::NAME_AGAMA,
        self::NAME_BHOJANA,
        self::NAME_NRITYALIPSAYA,
        self::NAME_KAUTUKA,
        self::NAME_NIDRA
    ];
}
