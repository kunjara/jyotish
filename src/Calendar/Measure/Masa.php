<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar\Measure;

/**
 * Masa class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Masa
{
    /**
     * March-April
     */
    const NAME_1 = 'Chaitra';
    /**
     * April-May
     */
    const NAME_2 = 'Vaishakha';
    /**
     * May-June
     */
    const NAME_3 = 'Jyeshtha';
    /**
     * June-July
     */
    const NAME_4 = 'Ashadha';
    /**
     * July-August
     */
    const NAME_5 = 'Shravana';
    /**
     * August-September
     */
    const NAME_6 = 'Bhadrapada';
    /**
     * September-October
     */
    const NAME_7 = 'Ashvina';
    /**
     * October-November
     */
    const NAME_8 = 'Kartika';
    /**
     * November-December
     */
    const NAME_9 = 'Margashirsha';
    /**
     * December-January
     */
    const NAME_10 = 'Pausha';
    /**
     * January-February
     */
    const NAME_11 = 'Magha';
    /**
     * February-March
     */
    const NAME_12 = 'Phalguna';
    /**
     * Extra month
     */
    const NAME_ADHIKA = 'Adhika';
    /**
     * Lost month
     */
    const NAME_KSHAYA = 'Kshaya';
    
    /**
     * List of Masa.
     * 
     * @var array
     */
    public static $masa = [
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
     * Vaishnava names of masa.
     * 
     * @var array
     */
    public static $masaVaishnava = [
        self::NAME_1 => 'Vishnu',
        self::NAME_2 => 'Madhusudana',
        self::NAME_3 => 'Trivikrama',
        self::NAME_4 => 'Vamana',
        self::NAME_5 => 'Shridhara',
        self::NAME_6 => 'Hrishikesha',
        self::NAME_7 => 'Padmanabha',
        self::NAME_8 => 'Damodara',
        self::NAME_9 => 'Keshava',
        self::NAME_10 => 'Narayana',
        self::NAME_11 => 'Madhava',
        self::NAME_12 => 'Govinda',
        self::NAME_ADHIKA => 'Purushottama',
    ];
}