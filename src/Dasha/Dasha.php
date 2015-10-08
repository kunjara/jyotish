<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha;

/**
 * Dasha data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Dasha
{
    /**
     * Vimshottari dasha
     */
    const TYPE_VIMSHOTTARI = 'vimshottari';
    /**
     * Ashtottari dasha
     */
    const TYPE_ASHTOTTARI	= 'ashtottari';
    
    /**
     * Name of period with nesting is equal to 1
     */
    const NESTING_1 = 'mahadasha';
    /**
     * Name of period with nesting is equal to 2
     */
    const NESTING_2 = 'antardasha';
    /**
     * Name of period with nesting is equal to 3
     */
    const NESTING_3 = 'pratyantardasha';
    /**
     * Name of period with nesting is equal to 4
     */
    const NESTING_4 = 'sookshmantardasha';
    /**
     * Name of period with nesting is equal to 5
     */
    const NESTING_5 = 'pranantardasha';
    /**
     * Name of period with nesting is equal to 6
     */
    const NESTING_6 = 'dehantardasha';

    /**
     * Types of dashas.
     * 
     * @var array
     */
    public static $dasha = [
        self::TYPE_VIMSHOTTARI,
        self::TYPE_ASHTOTTARI,
    ];

    /**
     * Returns the requested instance of dasha class.
     * 
     * @param string $type The type of dasha
     * @param null|array $options Options to set (optional)
     * - `nesting`: nesting of periods
     * @return the requested instance of dasha class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($type, array $options = null)
    {
        $typeLower = strtolower($type);
        
        if (!in_array($typeLower, self::$dasha)) {
            throw new Exception\InvalidArgumentException("Dasha '$typeLower' does not exist.");
        }

        $dashaClass = 'Jyotish\Dasha\Object\\' . ucfirst($typeLower);
        $dashaObject = new $dashaClass($options);

        return $dashaObject;
    }
}