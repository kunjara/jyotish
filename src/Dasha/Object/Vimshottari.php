<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use Jyotish\Ganita\Math;
use Jyotish\Graha\Graha;
use Jyotish\Dasha\Dasha;
use Jyotish\Ganita\Astro;
use Jyotish\Panchanga\Nakshatra\Nakshatra;

/**
 * Class of Vimshottari Dasha
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 46, Verse 12-16.
 */
class Vimshottari extends AbstractDasha
{
    /**
     * Dasha key
     * 
     * @var string
     */
    protected $dashaType = Dasha::TYPE_VIMSHOTTARI;

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
    protected $durationGraha = [
        Graha::KEY_SY => 6,
        Graha::KEY_CH => 10,
        Graha::KEY_MA => 7,
        Graha::KEY_RA => 18,
        Graha::KEY_GU => 16,
        Graha::KEY_SA => 19,
        Graha::KEY_BU => 17,
        Graha::KEY_KE => 7,
        Graha::KEY_SK => 20,
    ];

    /**
     * Constructor
     * 
     * @param null|array $options Options to set (optional)
     */
    public function __construct(array $options = null)
    {
        parent::__construct($options);
        
        $nakshatras = Nakshatra::listNakshatra();
        $this->orderNakshatra = Math::shiftArray($nakshatras, 3);
    }

    /**
     * Get start period.
     * 
     * @return array
     */
    public function getStartPeriod()
    {
        $nakshatra = $this->getData()['panchanga']['nakshatra'];
        $N = Nakshatra::getInstance($nakshatra['key']);

        $result['graha'] = $N->nakshatraRuler;
        $result['total'] = $this->durationTotal * Astro::DURATION_YEAR_GREGORIAN * 86400;
        
        $duration = $this->durationGraha[$result['graha']] * Astro::DURATION_YEAR_GREGORIAN * 86400;
        $result['start'] = round($duration * (100 - $nakshatra['left']) / 100);

        return $result;
    }
}