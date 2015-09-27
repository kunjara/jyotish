<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of bhava 1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B1 extends BhavaObject
{
    /**
     * Bhava key
     * 
     * @var int
     */
    protected $objectKey = 1;
    
    /**
     * Names of the bhava.
     * 
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 15-16.
     */
    protected $objectNames = [
        'Kalpa',
    ];

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 2.
     */
    protected $bhavaKarakatva = [
        'physique',
        'appearance',
        'intellect',
        'vigour',
        'weakness',
        'happiness',
        'grief',
        'innate nature',
    ];

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha = Manusha::PURUSHARTHA_DHARMA;
}