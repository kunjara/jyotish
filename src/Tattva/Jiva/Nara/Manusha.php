<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva\Nara;

/**
 * Class of Manusha gana.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Manusha extends \Jyotish\Tattva\Jiva\Nara {
    /**
     * Priests, teachers and preachers
     */
    const VARNA_BRAHMANA = 'brahmana';
    /**
     * Kings, governors, warriors and soldiers
     */
    const VARNA_KSHATRIYA = 'kshatriya';
    /**
     * Cattle herders, agriculturists, businessmen, artisans and merchants
     */
    const VARNA_VAISHYA = 'vaishya';
    /**
     * Labourers and service providers
     */
    const VARNA_SHUDRA = 'shudra';
    /**
     * Peoples conquered by Vedic (Aryan) tribes
     */
    const VARNA_DASYA = 'dasya';
    /**
     * Peoples impure in habits
     */
    const VARNA_MLECHHA = 'mlechha';
    /**
     * Butchers or executioners
     */
    const VARNA_UGRA = 'ugra';
    
    /**
     * Student life
     */
    const ASHRAM_BRAHMACHARYA = 'brahmacharya';
    /**
     * Household life
     */
    const ASHRAM_GRIHASTHA = 'grihastha';
    /**
     * Retired life
     */
    const ASHRAM_VANAPRASTHA = 'vanaprastha';
    /**
     * Renounced life
     */
    const ASHRAM_SANNYASA = 'sannyasa';
    
    /**
     * Righteousness
     */
    const PURUSHARTHA_DHARMA = 'dharma';
    /**
     * Wealth
     */
    const PURUSHARTHA_ARTHA = 'artha';
    /**
     * Desire
     */
    const PURUSHARTHA_KAMA = 'kama';
    /**
     * Salvation or liberation
     */
    const PURUSHARTHA_MOKSHA = 'moksha';

    /**
     * List of varnas.
     * 
     * @var array
     */
    public static $varna = [
        self::VARNA_BRAHMANA,
        self::VARNA_KSHATRIYA,
        self::VARNA_VAISHYA,
        self::VARNA_SHUDRA,
        self::VARNA_DASYA,
        self::VARNA_MLECHHA,
        self::VARNA_UGRA,
    ];
    
    /**
     * List of ashrams.
     * 
     * @var array
     */
    public static $ashram = [
        self::ASHRAM_BRAHMACHARYA,
        self::ASHRAM_GRIHASTHA,
        self::ASHRAM_VANAPRASTHA,
        self::ASHRAM_SANNYASA,
    ];

    /**
     * List of purusharthas.
     * 
     * @var array
     */
    public static $purushartha = [
        self::PURUSHARTHA_DHARMA,
        self::PURUSHARTHA_ARTHA,
        self::PURUSHARTHA_KAMA,
        self::PURUSHARTHA_MOKSHA,
    ];

        /**
     * Get list of varnas.
     * 
     * @param null|int $option The option to list varnas.
     * @return array List of varnas.
     */
    public static function listVarna($option = null)
    {
        switch ($option) {
            case 4:
                $list = array_slice(self::$varna, 0, 4);
                break;
            default:
                $list = self::$varna;
        }
        return $list;
    }
}
