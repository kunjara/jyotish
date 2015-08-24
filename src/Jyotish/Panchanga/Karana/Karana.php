<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Karana;

/**
 * Data Karana class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Karana
{
    const NAME_BAVA = 'Bava';
    const NAME_BALAVA = 'Balava';
    const NAME_KAULAVA = 'Kaulava';
    const NAME_TAITILA = 'Taitila';
    const NAME_GARA = 'Gara';
    const NAME_VANIJA = 'Vanija';
    const NAME_VISHTI = 'Vishti';
    const NAME_SHAKUNI = 'Shakuni';
    const NAME_CHATUSHPADA = 'Chatushpada';
    const NAME_NAGA	= 'Naga';
    const NAME_KINSTUGNA = 'Kinstugna';

    /**
     * Array of all karanas.
     * 
     * @var array 
     */
    public static $karana = [
        1 => self::NAME_BAVA,
        2 => self::NAME_BALAVA,
        3 => self::NAME_KAULAVA,
        4 => self::NAME_TAITILA,
        5 => self::NAME_GARA,
        6 => self::NAME_VANIJA,
        7 => self::NAME_VISHTI,
        8 => self::NAME_SHAKUNI,
        9 => self::NAME_CHATUSHPADA,
        10 => self::NAME_NAGA,
        11 => self::NAME_KINSTUGNA
    ];
}