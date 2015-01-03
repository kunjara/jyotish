<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga;

/**
 * Class with Yoga names.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Yoga {
    static public $yoga = array(
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
    );

    /**
     * Returns the requested instance of yoga class.
     * 
     * @param int $number The number of yoga
     * @param null|array $options (Optional) Options to set
     * @return the requested instance of yoga class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($number, $options = null) {
        if (!array_key_exists($number, self::$yoga)) {
            throw new Exception\InvalidArgumentException("Yoga with the number '$number' does not exist.");
        }
        
        $yogaClass = 'Jyotish\\Panchanga\\Yoga\\Object\\Y' . $number;
        $yogaObject = new $yogaClass($options);

        return $yogaObject;
    }
}