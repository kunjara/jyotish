<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi\Object;

use Jyotish\Panchanga\Karana\Karana;

/**
 * Class of tithi 1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class T1 extends TithiObject
{
    /**
     * Tithi key
     * 
     * @var int
     */
    protected $tithiKey = 1;

    /**
     * Devanagari number 1 in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $tithiTranslit = ['d1'];

    /**
     * Karana of tithi.
     * 
     * @var string
     */
    protected $tithiKarana = [
        1 => Karana::NAME_KINSTUGNA,
        2 => Karana::NAME_BAVA
    ];
}