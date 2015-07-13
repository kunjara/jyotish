<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use Jyotish\Ganita\Math;
use Jyotish\Ganita\Astro;
use Jyotish\Tattva\Kala\Samvatsara;
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
     * Coincidence of ayanamsha.
     * 
     * @var array
     */
    static public $coincidence = [
        self::AYANAMSHA_DELUCE       => -1,
        self::AYANAMSHA_DJWHALKHUL   => -41,
        self::AYANAMSHA_FAGAN        => 221,
        self::AYANAMSHA_JNBHASIN     => 364,
        self::AYANAMSHA_KRISHNAMURTI => 292,
        self::AYANAMSHA_LAHIRI       => 285,
        self::AYANAMSHA_RAMAN        => 389,
        self::AYANAMSHA_SASSANIAN    => 564,
        self::AYANAMSHA_USHASHASHI   => 559,
        self::AYANAMSHA_YUKTESHWAR   => 292,
    ];

    /**
     * Get approximate ayanamsha value.
     * 
     * @param DateTime $Date
     * @param string $ayanamsha
     * @return array
     */
    static public function getAyanamsha(DateTime $Date = null, $ayanamsha = self::AYANAMSHA_LAHIRI)
    {
        if(is_null($Date)){
            $Date = new DateTime('now');
        }
        
        $TimeZone = $Date->getTimezone();
        
        $yearMatching = sprintf('%04d', abs(self::$coincidence[$ayanamsha]));
        $eraMatching = strval(self::$coincidence[$ayanamsha])[0] == '-' ? '-' : '';
        
        $dateMatching = $eraMatching . $yearMatching . '-01-01';
        $DateMatching = new DateTime($dateMatching, $TimeZone);
        
        $Interval = $DateMatching->diff($Date);
        
        $factor = $Interval->days / Samvatsara::DUR_GREGORIAN;
        $ayanamshaValue = Math::dmsMulti(['d' => 0, 'm' => 0, 's' => Astro::getPrecessionSpeed()], $factor);
        
        return $ayanamshaValue;
    }
}