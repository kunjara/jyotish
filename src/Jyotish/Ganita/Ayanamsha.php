<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use DateTime;

/**
 * Class with ayanamshas.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ayanamsha {
    const AYANAMSHA_DELUCE       = 'Deluce';
    const AYANAMSHA_DJWHALKHUL   = 'Djwhalkhul';
    const AYANAMSHA_FAGAN        = 'Fagan';
    const AYANAMSHA_JNBHASIN     = 'Jnbhasin';
    const AYANAMSHA_KRISHNAMURTI = 'Krishnamurti';
    const AYANAMSHA_LAHIRI       = 'Lahiri';
    const AYANAMSHA_RAMAN        = 'Raman';
    const AYANAMSHA_SASSANIAN    = 'Sassanian';
    const AYANAMSHA_USHASHASHI   = 'Ushashashi';
    const AYANAMSHA_YUKTESHWAR   = 'Yukteshwar';

    /**
     * List of ayanamshas.
     * 
     * @var array
     */
    static public $ayanamsha = [
        self::AYANAMSHA_DELUCE,
        self::AYANAMSHA_DJWHALKHUL,
        self::AYANAMSHA_FAGAN,
        self::AYANAMSHA_JNBHASIN,
        self::AYANAMSHA_KRISHNAMURTI,
        self::AYANAMSHA_LAHIRI,
        self::AYANAMSHA_RAMAN,
        self::AYANAMSHA_SASSANIAN,
        self::AYANAMSHA_USHASHASHI,
        self::AYANAMSHA_YUKTESHWAR,
    ];
    
    /**
     * Precession of ayanamsha.
     * 
     * @var array
     */
    static public $precession = [
        self::AYANAMSHA_FAGAN        => 50.25,
        self::AYANAMSHA_KRISHNAMURTI => 50.2388475,
        self::AYANAMSHA_LAHIRI       => 50.2719,
        self::AYANAMSHA_RAMAN        => 50.33,
        self::AYANAMSHA_YUKTESHWAR   => 53.9906,
    ];
    
    /**
     * Matching of ayanamsha.
     * 
     * @var array
     */
    static public $matching = [
        self::AYANAMSHA_FAGAN        => 221,
        self::AYANAMSHA_KRISHNAMURTI => 291,
        self::AYANAMSHA_LAHIRI       => 285,
        self::AYANAMSHA_RAMAN        => 397,
        self::AYANAMSHA_YUKTESHWAR   => 499,
    ];
}