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
 * Class of nakshatra 22.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class N22 extends NakshatraObject
{
    /**
     * Nakshatra key
     * 
     * @var int
     */
    protected $nakshatraKey = 22;

    /**
     * Devanagari title 'shravana' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $nakshatraTranslit = ['sha','virama','ra','aa','va','nna'];
    
    /**
     * The number of taras (stars) of the nakshatra.
     * 
     * @var int
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 1-3.
     */
    protected $nakshatraTara = 3;

    /**
     * Deva of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 4-5.
     */
    protected $nakshatraDeva = Deva::DEVA_VISHNU;

    /**
     * Type of nakshatra.
     * 
     * @var string
     * @see Varahamihira. Brihat Samhita. Chapter 98, Verse 11.
     */
    protected $nakshatraType = Nakshatra::TYPE_CHARANA;

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
    protected $nakshatraPurushartha = Manusha::PURUSHARTHA_ARTHA;
    protected $nakshatraVarna = Manusha::VARNA_MLECHHA;
    protected $nakshatraPrakriti = Ayurveda::PRAKRITI_KAPHA;
    protected $nakshatraYoni = [
        'animal' => Pasu::ANIMAL_MONKEY,
        'gender' => Manusha::GENDER_FEMALE,
    ];
    protected $nakshatraRajju = [
        'lift' => Nakshatra::LIFT_AROHA,
        'limb' => Nakshatra::LIMB_KANTHA,
    ];
}