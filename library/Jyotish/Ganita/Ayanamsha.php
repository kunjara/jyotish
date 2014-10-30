<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

/**
 * Class with ayanamshas.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ayanamsha {

    const AYANAMSHA_FAGAN        = 'Fagan';
    const AYANAMSHA_LAHIRI       = 'Lahiri';
    const AYANAMSHA_DELUCE       = 'Deluce';
    const AYANAMSHA_RAMAN        = 'Raman';
    const AYANAMSHA_USHASHASHI   = 'Ushashashi';
    const AYANAMSHA_KRISHNAMURTI = 'Krishnamurti';
    const AYANAMSHA_DJWHALKHUL   = 'Djwhalkhul';
    const AYANAMSHA_YUKTESHWAR   = 'Yukteshwar';
    const AYANAMSHA_JNBHASIN     = 'Jnbhasin';
    const AYANAMSHA_SASSANIAN    = 'Sassanian';

    static public $ayanamshas = array(
        self::AYANAMSHA_FAGAN,
        self::AYANAMSHA_LAHIRI,
        self::AYANAMSHA_DELUCE,
        self::AYANAMSHA_RAMAN,
        self::AYANAMSHA_USHASHASHI,
        self::AYANAMSHA_KRISHNAMURTI,
        self::AYANAMSHA_DJWHALKHUL,
        self::AYANAMSHA_YUKTESHWAR,
        self::AYANAMSHA_JNBHASIN,
        self::AYANAMSHA_SASSANIAN,
    );
}