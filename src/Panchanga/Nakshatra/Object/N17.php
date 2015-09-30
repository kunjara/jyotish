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
 * Class of nakshatra 17.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N17 extends NakshatraObject
{
    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey = 17;

    /**
     * Devanagari title 'anuradha' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = ['_a','na','u','ra','aa','dha','aa'];
    
    /**
     * The number of taras (stars) of the nakshatra.
     * 
     * @var int
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 1-3.
     */
    protected $nakshatraTara = 4;

    /**
     * Deva of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva = Deva::DEVA_SURYA_MITRA;

    /**
     * Type of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 10.
     */
    protected $nakshatraType = Nakshatra::TYPE_MRIDU;

    /**
     * Graha of nakshatra.
     * 
     * @var string
     * @see Satyacharya. Satya Jatakam. Chapter 1, Verse 9.
     */
    protected $nakshatraRuler = Graha::KEY_SA;

    protected $nakshatraEnergy = Nakshatra::ENERGY_STHITI;
    protected $nakshatraGana = Manusha::GANA_DEVA;
    protected $nakshatraGender = Manusha::GENDER_MALE;
    protected $nakshatraGuna = Maha::GUNA_TAMA;
    protected $nakshatraPurushartha = Manusha::PURUSHARTHA_DHARMA;
    protected $nakshatraVarna = Manusha::VARNA_SHUDRA;
    protected $nakshatraPrakriti = Ayurveda::PRAKRITI_PITTA;
    protected $nakshatraYoni = [
        'animal' => Pasu::ANIMAL_HARE,
        'gender' => Manusha::GENDER_FEMALE,
    ];
    protected $nakshatraRajju = [
        'lift' => Nakshatra::LIFT_AVAROHA,
        'limb' => Nakshatra::LIMB_KATI,
    ];
}