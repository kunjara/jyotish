<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 25.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T25 extends TithiObject
{
    /**
     * Tithi key
     * 
     * @var int
     */
    protected $tithiKey = 25;

    /**
     * Devanagari number 10 in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $tithiTranslit = ['d1', 'd0'];

    /**
     * Karana of tithi.
     * 
     * @var string
     */
    protected $tithiKarana = [
        1 => Karana::NAME_VANIJA,
        2 => Karana::NAME_VISHTI
    ];
}