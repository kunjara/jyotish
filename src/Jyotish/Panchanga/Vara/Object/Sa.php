<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Vara\Object;

use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Graha\Graha;

/**
 * Shanivar class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sa extends VaraObject {
    /**
     * Vara key.
     * 
     * @var string
     */
    protected $varaKey = Graha::KEY_SA;
    
    /**
     * Vara name.
     * 
     * @var string
     */
    protected $varaName = Vara::NAME_SA;

    public function __construct($options = null) {
        return $this;
    }
}