<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Base\BaseObject;

/**
 * Parent class for bhava objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class BhavaObject extends BaseObject {
    
    use BhavaEnvironment;
    
    /**
     * Object type
     * 
     * @var string
     */
    protected $objectType = 'bhava';

    /**
     * Devanagari bhava title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $bhavaTranslit;

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 2-13.
     */
    protected $bhavaKarakatva = [];

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha;
}
