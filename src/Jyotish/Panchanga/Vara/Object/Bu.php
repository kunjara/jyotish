<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Vara\Object;

use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Graha\Graha;

/**
 * Budhavar class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends VaraObject {
    /**
     * Vara key.
     * 
     * @var string
     */
    protected $varaKey = Graha::KEY_BU;
    
    /**
     * Vara name.
     * 
     * @var string
     */
    protected $varaName = Vara::NAME_BU;

    public function __construct($options = null) {
        return $this;
    }
}