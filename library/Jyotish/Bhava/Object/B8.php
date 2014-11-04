<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Bhava\Bhava;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of bhava 8.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B8 extends BhavaObject {
    /**
     * Bhava key
     * 
     * @var int
     */
    protected $objectKey = 8;
    
    /**
     * Main name of bhava.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 37-38.
     */
    protected $objectName = Bhava::NAME_8;

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 9.
     */
    protected $bhavaKarakatva = array(
        'longevity',
        'battle',
        'enemies',
        'forts',
        'succession',
    );

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha = Manusha::PURUSHARTHA_MOKSHA;

    public function __construct($options) {
        parent::__construct($options);
    }
}