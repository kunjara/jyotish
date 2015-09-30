<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 18.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T18 extends TithiObject
{
    /**
     * Tithi key
     * 
     * @var int
     */
    protected $tithiKey = 18;

    /**
     * Devanagari number 3 in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $tithiTranslit = ['d3'];

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