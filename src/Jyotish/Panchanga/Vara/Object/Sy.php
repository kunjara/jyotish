<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Vara\Object;

use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Graha\Graha;

/**
 * Ravivar class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sy extends VaraObject {
    /**
     * Vara key.
     * 
     * @var string
     */
    protected $varaKey = Graha::KEY_SY;
    
    /**
     * Vara name.
     * 
     * @var string
     */
    protected $varaName = Vara::NAME_SY;

    public function __construct($options = null) {
        return $this;
    }
}