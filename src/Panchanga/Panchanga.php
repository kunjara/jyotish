<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

/**
 * Panchanga data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Panchanga
{
    /**
     * Tithi anga
     */
    const ANGA_TITHI     = 'tithi';
    /**
     * Nakshatra anga
     */
    const ANGA_NAKSHATRA = 'nakshatra';
    /**
     * Yoga anga
     */
    const ANGA_YOGA      = 'yoga';
    /**
     * Vara anga
     */
    const ANGA_VARA      = 'vara';
    /**
     * Karana anga
     */
    const ANGA_KARANA    = 'karana';
    
    /**
     * List of angas.
     * 
     * @var array
     */
    public static $anga = [
        self::ANGA_TITHI,
        self::ANGA_NAKSHATRA,
        self::ANGA_YOGA,
        self::ANGA_VARA,
        self::ANGA_KARANA
    ];
    
    /**
     * Returns the requested instance of anga.
     * 
     * @param string $anga The requested anga
     * @param int|string $key The key of anga
     * @param null|array $options Options to set (optional)
     * @return the requested instance of anga
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($anga, $key, array $options = null)
    {
        if (!defined('self::ANGA_'.  strtoupper($anga))) {
            throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Anga '$anga' does not exist.");
        }
        
        $angaClass = 'Jyotish\\Panchanga\\' . ucfirst($anga) . '\\' . ucfirst($anga);
        
        if (!method_exists($angaClass, 'getInstance')) {
            throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Instance of '$anga' can not be created.");
        }
        
        $Instance = $angaClass::getInstance($key, $options);
        
        return $Instance;
    }
}
