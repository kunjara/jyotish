<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Bhava\Bhava;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of bhava 4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class B4 extends BhavaObject {
    /**
     * Bhava key
     * 
     * @var int
     */
    protected $objectKey = 4;
    
    /**
     * Main name of bhava.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 37-38.
     */
    protected $objectName = Bhava::NAME_4;

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 5.
     */
    protected $bhavaKarakatva = array(
        'conveyances',
        'relatives',
        'mother',
        'happiness',
        'treasure',
        'lands',
        'buildings',
    );

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha = Manusha::PURUSHARTHA_MOKSHA;

    public function __construct($options = null) {
        parent::__construct($options);
    }
}