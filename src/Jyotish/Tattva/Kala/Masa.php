<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Kala;

/**
 * Masa class with month names.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Masa {
    /**
     * Duration of the sidereal month measured in days.
     */
    const DUR_SIDEREAL	= 27.3216610;
    /**
     * Duration of the synodic month measured in days.
     */
    const DUR_SYNODIC	= 29.5305882;

    /**
     * List of Masa.
     * 
     * @var array
     */
    static public $masa = array(
        1 => 'Chaitra',
        2 => 'Vaishakha',
        3 => 'Jyeshtha',
        4 => 'Ashadha',
        5 => 'Shravana',
        6 => 'Bhadrapada',
        7 => 'Ashvin',
        8 => 'Kartika',
        9 => 'Margashirsha',
        10 => 'Pausha',
        11 => 'Magha',
        12 => 'Phalguna'
    );
}