<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Kala;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of graha Sy.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sy extends GrahaBaseObject
{
    /**
     * Abbreviation of the graha.
     *
     * @var string
     */
    protected $objectKey = 'Sy';

    /**
     * Unicode of the Graha.
     *
     * @var string
     */
    protected $grahaUnicode = '2609';

    /**
     * Amsha of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 2.
     */
    protected $grahaAmsha = Graha::AMSHA_PARAMATMA;

    /**
     * Avatara of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara = 'Rama';

    /**
     * Names of the graha.
     *
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 2.
     */
    protected $objectNames = [
        'Heli',
    ];

    /**
     * Devanagari title 'surya' in transliteration.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['sa','uu','ra','virama','ya'];

    /**
     * Character of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaCharacter = Graha::CHARACTER_PAPA;

    /**
     * Colors of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 16-17.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 4-5.
     */
    protected $grahaColor = [
        Maha::COLOR_INDIAN_RED,
        Maha::COLOR_COPPER,
    ];

    /**
     * Deva of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva = Deva::DEVA_AGNI;

    /**
     * Gender of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaGender = Manusha::GENDER_MALE;

    /**
     * Bhuta of the Graha.
     *
     * @var string
     */
    protected $grahaBhuta = Maha::BHUTA_AGNI;

    /**
     * Varna of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaVarna = Manusha::VARNA_KSHATRIYA;

    /**
     * Guna of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaGuna = Maha::GUNA_SATTVA;

    /**
     * Dhatu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
     */
    protected $grahaDhatu = array
    (
        Ayurveda::DHATU_ASTHI,
    );

    /**
     * Kala of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala = Kala::KALA_AYANA;

    /**
     * Rasa of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa = Ayurveda::RASA_TIKTA;

    /**
     * Ritu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 12.
     */
    protected $grahaRitu = Kala::RITU_GRISHMA;

    /**
     * Graha basis.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis = Maha::BASIS_MULA;

    /**
     * Graha exaltation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = [
        'rashi' => 1,
        'degree' => 10
    ];

    /**
     * Graha debilitation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [
        'rashi' => 7,
        'degree' => 10
    ];

    /**
     * Graha mooltrikon.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [
        'rashi' => 5,
        'start' => 0,
        'end' => 20
    ];

    /**
     * Own sign of the graha.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [
        [
            'rashi' => 5,
            'start' => 20,
            'end' => 30
        ]
    ];

    /**
     * Graha disha
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha = Maha::DISHA_PURVA;

    /**
     * Graha drishti
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 26, Verse 2-5.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
     */
    protected $grahaDrishti = [
        1 => 0,
        2 => 0,
        3 => 0.25,
        4 => 0.75,
        5 => 0.5,
        6 => 0,
        7 => 1,
        8 => 0.75,
        9 => 0.5,
        10 => 0.25,
        11 => 0,
        12 => 0,
    ];

    /**
     * Prakriti of graha
     *
     * @var array
     */
    protected $grahaPrakriti = array
    (
        Ayurveda::PRAKRITI_PITTA,
    );
    protected $grahaAgeMaturity = 22;
    protected $grahaAgePeriod = array
    (
        'start' => 23,
        'end' => 41
    );
    protected $grahaLongitudeSpeedAvg = ['d' => 0, 'm' => 59, 's' => 8.2];
}
