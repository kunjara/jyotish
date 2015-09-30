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
 * Class of nakshatra 13.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N13 extends NakshatraObject
{
    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey = 13;

    /**
     * Devanagari title 'hasta' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = ['ha','sa','virama','ta'];
    
    /**
     * The number of taras (stars) of the nakshatra.
     * 
     * @var int
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 1-3.
     */
    protected $nakshatraTara = 5;

    /**
     * Deva of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva = Deva::DEVA_SURYA_SAVITRI;

    /**
     * Type of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 9.
     */
    protected $nakshatraType = Nakshatra::TYPE_KSHIPRA;

    /**
     * Graha of nakshatra.
     * 
     * @var string
     * @see Satyacharya. Satya Jatakam. Chapter 1, Verse 9.
     */
    protected $nakshatraRuler = Graha::KEY_CH;

    protected $nakshatraEnergy = Nakshatra::ENERGY_SRISHTI;
    protected $nakshatraGana = Manusha::GANA_DEVA;
    protected $nakshatraGender = Manusha::GENDER_MALE;
    protected $nakshatraGuna = Maha::GUNA_RAJA;
    protected $nakshatraPurushartha = Manusha::PURUSHARTHA_MOKSHA;
    protected $nakshatraVarna = Manusha::VARNA_VAISHYA;
    protected $nakshatraPrakriti = Ayurveda::PRAKRITI_VATA;
    protected $nakshatraYoni = [
        'animal' => Pasu::ANIMAL_BUFFALO,
        'gender' => Manusha::GENDER_FEMALE,
    ];
    protected $nakshatraRajju = [
        'lift' => Nakshatra::LIFT_AROHA,
        'limb' => Nakshatra::LIMB_KANTHA,
    ];
}