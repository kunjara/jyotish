<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga;

/**
 * Data Yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Yoga
{
    public static $yoga = [
        1 => 'Vishkambha',
        2 => 'Preeti',
        3 => 'Ayushman',
        4 => 'Soubhagya',
        5 => 'Shobhana',
        6 => 'Athiganda',
        7 => 'Sukarma',
        8 => 'Dhriti',
        9 => 'Shoola',
        10 => 'Ganda',
        11 => 'Vriddhi',
        12 => 'Dhruva',
        13 => 'Vyaghata',
        14 => 'Harshana',
        15 => 'Vajra',
        16 => 'Siddhi',
        17 => 'Vyateepat',
        18 => 'Vareeyana',
        19 => 'Parigha',
        20 => 'Shiva',
        21 => 'Siddha',
        22 => 'Sadhya',
        23 => 'Shubha',
        24 => 'Shukla',
        25 => 'Brahma',
        26 => 'Indra',
        27 => 'Vaidhriti',
    ];

    /**
     * Returns the requested instance of yoga class.
     * 
     * @param int $key The key of yoga
     * @param null|array $options Options to set (optional)
     * @return the requested instance of yoga class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($key, array $options = null)
    {
        if (!array_key_exists($key, self::$yoga)) {
            throw new \Jyotish\Panchanga\Exception\InvalidArgumentException("Yoga with the key '$key' does not exist.");
        }
        
        $yogaClass = 'Jyotish\Panchanga\Yoga\Object\Y' . $key;
        $yogaObject = new $yogaClass($options);

        return $yogaObject;
    }
}