<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Jiva\Pasu;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of nakshatra 25.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N25 extends NakshatraObject
{
    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey = 25;

    /**
     * Devanagari title 'purva bhadrapada' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = ['pa','uu','ra','virama','va',' ','bha','aa','da','virama','ra','pa','da','aa'];
    
    /**
     * The number of taras (stars) of the nakshatra.
     * 
     * @var int
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 1-3.
     */
    protected $nakshatraTara = 2;

    /**
     * Deva of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva = Deva::DEVA_AJIKAPADA;

    /**
     * Type of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 8.
     */
    protected $nakshatraType = Nakshatra::TYPE_UGRA;

    /**
     * Graha of nakshatra.
     * 
     * @var string
     * @see Satyacharya. Satya Jatakam. Chapter 1, Verse 9.
     */
    protected $nakshatraRuler = Graha::KEY_GU;

    protected $nakshatraEnergy = Nakshatra::ENERGY_SRISHTI;
    protected $nakshatraGana = Manusha::GANA_MANUSHA;
    protected $nakshatraGender = Manusha::GENDER_MALE;
    protected $nakshatraGuna = Maha::GUNA_SATTVA;
    protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
    protected $nakshatraVarna = Manusha::VARNA_BRAHMANA;
    protected $nakshatraPrakriti = Ayurveda::PRAKRITI_VATA;
    protected $nakshatraYoni = [
        'animal' => Pasu::ANIMAL_LION,
        'gender' => Manusha::GENDER_MALE,
    ];
    protected $nakshatraRajju = [
        'lift' => Nakshatra::LIFT_AVAROHA,
        'limb' => Nakshatra::LIMB_NABHI,
    ];
}