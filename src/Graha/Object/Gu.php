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
 * Class of graha Gu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Gu extends GrahaBaseObject
{
    /**
     * Abbreviation of the graha
     *
     * @var string
     */
    protected $objectKey = 'Gu';

    /**
     * Unicode of the Graha.
     *
     * @var string
     */
    protected $grahaUnicode = '2643';

    /**
     * Amsha of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 2.
     */
    protected $grahaAmsha = Graha::AMSHA_JIVATMA;

    /**
     * Avatara of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara = 'Vamana';

    /**
     * Names of the graha.
     *
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 3.
     */
    protected $objectNames = [
        'Jiva',
        'Angira',
        'Suraguru',
        'Vachasampati',
        'Ijya',
    ];

    /**
     * Devanagari title 'guru' in transliteration.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['ga','u','ra','u'];

    /**
     * Character of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaCharacter = Graha::CHARACTER_SHUBHA;

    /**
     * Colors of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 16-17.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 4-5.
     */
    protected $grahaColor = [
        Maha::COLOR_YELLOW,
        Maha::COLOR_GOLD,
    ];

    /**
     * Deva of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva = Deva::DEVA_INDRA;

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
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaBhuta = Maha::BHUTA_AKASH;

    /**
     * Varna of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaVarna = Manusha::VARNA_BRAHMANA;

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
        Ayurveda::DHATU_MEDHA,
    );

    /**
     * Kala of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala = Kala::KALA_MASA;

    /**
     * Rasa of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa = Ayurveda::RASA_MADHURA;

    /**
     * Ritu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 12.
     */
    protected $grahaRitu = Kala::RITU_HEMANTA;

    /**
     * Graha basis.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis = Maha::BASIS_JIVA;

    /**
     * Graha exaltation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = [
        'rashi' => 4,
        'degree' => 5
    ];

    /**
     * Graha debilitation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [
        'rashi' => 10,
        'degree' => 5
    ];

    /**
     * Graha mooltrikon.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [
        'rashi' => 9,
        'start' => 0,
        'end' => 10
    ];

    /**
     * Own sign of the graha.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [
        'positive' => [
            'rashi' => 9,
            'start' => 10,
            'end' => 30
        ],
        'negative' => [
            'rashi' => 12,
            'start' => 0,
            'end' => 30
        ]
    ];

    /**
     * Graha disha
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha = Maha::DISHA_ISHANYA;

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
        5 => 1,
        6 => 0,
        7 => 1,
        8 => 0.75,
        9 => 1,
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
        Ayurveda::PRAKRITI_KAPHA
    );
    protected $grahaAgeMaturity = 16;
    protected $grahaAgePeriod = array
    (
        'start' => 57,
        'end' => 68
    );
    protected $grahaLongitudeSpeedAvg = ['d' => 0, 'm' => 4, 's' => 59.1];
}
