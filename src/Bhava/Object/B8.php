<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of bhava 8.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B8 extends BhavaObject
{
    /**
     * Bhava key
     * 
     * @var int
     */
    protected $objectKey = 8;
    
    /**
     * Names of the bhava.
     * 
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 15-16.
     */
    protected $objectNames = [
        'Randhra',
    ];

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 9.
     */
    protected $bhavaKarakatva = [
        'longevity',
        'battle',
        'enemies',
        'forts',
        'succession',
    ];

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha = Manusha::PURUSHARTHA_MOKSHA;
}