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
 * Class of graha Ma.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ma extends GrahaObject
{
    /**
     * Abbreviation of the graha
     * 
     * @var string
     */
    protected $objectKey = 'Ma';

    /**
     * Unicode of the Graha.
     * 
     * @var string
     */
    protected $grahaUnicode = '2642';

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
    protected $grahaAvatara = 'Narasimha';
    
    /**
     * Names of the graha.
     * 
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 2.
     */
    protected $objectNames = [
        'Ara',
        'Vakra',
        'Kruradrik',
        'Avaneya'
    ];

    /**
     * Devanagari title 'mangala' in transliteration.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['ma','anusvara','ga','la'];

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
        Maha::COLOR_RED,
        Maha::COLOR_SCARLET,
    ];

    /**
     * Deva of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva = Deva::DEVA_KARTTIKEYA;

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
    protected $grahaGuna = Maha::GUNA_TAMA;

    /**
     * Dhatu of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
     */
    protected $grahaDhatu = array
    (
        Ayurveda::DHATU_MAMSA,
        Ayurveda::DHATU_MAJA,
    );

    /**
     * Kala of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala = Kala::KALA_VARA;

    /**
     * Rasa of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa = Ayurveda::RASA_KATU;

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
    protected $grahaBasis = Maha::BASIS_DHATU;

    /**
     * Graha exaltation.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = [
        'rashi' => 10,
        'degree' => 28
    ];

    /**
     * Graha debilitation.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [
        'rashi' => 4,
        'degree' => 28
    ];

    /**
     * Graha mooltrikon.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [
        'rashi' => 1,
        'start' => 0,
        'end' => 12
    ];

    /**
     * Own sign of the graha.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [
        'positive' => [
            'rashi' => 1,
            'start' => 12,
            'end' => 30
        ],
        'negative' => [
            'rashi' => 8,
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
    protected $grahaDisha = Maha::DISHA_DAKSHINA;

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
        4 => 1,
        5 => 0.5,
        6 => 0,
        7 => 1,
        8 => 1,
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
        Ayurveda::PRAKRITI_PITTA
    );
    protected $grahaAgeMaturity = 28;
    protected $grahaAgePeriod = array
    (
        'start' => 42,
        'end' => 56
    );
    protected $grahaLongitudeSpeedAvg = ['d' => 0, 'm' => 31, 's' => 26.5];
}