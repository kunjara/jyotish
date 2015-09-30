<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of nakshatra 28.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N28 extends NakshatraObject
{
    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey = 28;

    /**
     * Devanagari title 'abhijit' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = ['_a','bha','i','ja','ii','ta'];

    /**
     * Deva of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva = Deva::DEVA_BRAHMA;

    /**
     * Type of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraType = Nakshatra::TYPE_KSHIPRA;

    /**
     * Graha of nakshatra.
     * 
     * @var string
     */
    protected $nakshatraRuler = null;

    protected $nakshatraEnergy = null;
    protected $nakshatraGana = Manusha::GANA_DEVA;
    protected $nakshatraGender = null;
    protected $nakshatraGuna = null;
    protected $nakshatraPurushartha = null;
    protected $nakshatraVarna = null;
    protected $nakshatraPrakriti = null;
    protected $nakshatraYoni = null;
    protected $nakshatraRajju = null;
}