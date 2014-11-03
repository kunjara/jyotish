<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use Jyotish\Base\Utils;
use Jyotish\Graha\Graha;
use Jyotish\Dasha\Dasha;
use Jyotish\Tattva\Kala\Samvatsara;
use Jyotish\Panchanga\Nakshatra\Nakshatra;

/**
 * Class of Vimshottari Dasha
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 46, Verse 12-16.
 */
class Vimshottari extends AbstractDasha {
    /**
     * Dasha key
     * 
     * @var string
     */
    protected $dashaKey = Dasha::DASHA_VIMSHOTTARI;

    /**
     * Duration of dasha.
     * 
     * @var int
     */
    protected $durationTotal = 120;

    /**
     * Duration of dasha by subperiods.
     * 
     * @var array
     */
    protected $durationGraha = array(
        Graha::GRAHA_SY => 6,
        Graha::GRAHA_CH => 10,
        Graha::GRAHA_MA => 7,
        Graha::GRAHA_RA => 18,
        Graha::GRAHA_GU => 16,
        Graha::GRAHA_SA => 19,
        Graha::GRAHA_BU => 17,
        Graha::GRAHA_KE => 7,
        Graha::GRAHA_SK => 20,
    );



    public function __construct()
    {
        $nakshatras = Nakshatra::nakshatraList();

        $this->orderNakshatra = Utils::shiftArray($nakshatras, 3, true);
    }

    /**
     * Get start period.
     * 
     * @param array $nakshatra
     * @return array
     */
    public function getStartPeriod(array $nakshatra)
    {
        $N = Nakshatra::getInstance((int)$nakshatra['number']);

        $result['graha'] = $N->nakshatraGraha;
        $result['total'] = round($this->durationTotal() * Samvatsara::DUR_GREGORIAN * 86400);

        $durationGraha     = $this->durationGraha();
        $durationNakshatra = $durationGraha[$result['graha']] * Samvatsara::DUR_GREGORIAN * 86400;
        $result['start']   = round($durationNakshatra * (100 - $nakshatra['left']) / 100);

        return $result;
    }

    /**
     * Get the order of the grahas.
     * 
     * @param string $graha
     * @param int $nesting
     * @return array
     */
    public function getOrderGraha($graha, $nesting = null)
    {
        $result = Utils::shiftArray($this->durationGraha(), $graha);

        return $result;
    }
}