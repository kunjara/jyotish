<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

use Jyotish\Base\Biblio;
use Jyotish\Graha\Lagna;
use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha
{
    /**
     * Key of Sun
     */
    const KEY_SY = 'Sy';
    /**
     * Key of Moon
     */
    const KEY_CH = 'Ch';
    /**
     * Key of Mars
     */
    const KEY_MA = 'Ma';
    /**
     * Key of Mercury
     */
    const KEY_BU = 'Bu';
    /**
     * Key of Jupiter
     */
    const KEY_GU = 'Gu';
    /**
     * Key of Venus
     */
    const KEY_SK = 'Sk';
    /**
     * Key of Saturn
     */
    const KEY_SA = 'Sa';
    /**
     * Key of Rahu (north lunar node)
     */
    const KEY_RA = 'Ra';
    /**
     * Key of Ketu (south lunar node)
     */
    const KEY_KE = 'Ke';
    /**
     * Key of Ascendant
     */
    const KEY_LG = Lagna::KEY_LG;
    
    /**
     * Name of Rahu (north lunar node)
     */
    const NAME_RA = 'Rahu';
    /**
     * Name of Ketu (south lunar node)
     */
    const NAME_KE = 'Ketu';

    /**
     * Benefic character
     */
    const CHARACTER_SHUBHA = 'shubha';
    /**
     * Malefic character
     */
    const CHARACTER_PAPA = 'papa';
    /**
     * Mixed character
     */
    const CHARACTER_MISHRA = 'mishra';
    /**
     * Yogakaraka (functional only for Ma, Sk, Sa)
     */
    const CHARACTER_YOGAKARAKA = 'yogakaraka';
    /**
     * Kendradhi patya dosha (functional only for Gu, Bu)
     */
    const CHARACTER_KENDRADHI = 'kendradhi';
    
    /**
     * Paramatma amsha
     */
    const AMSHA_PARAMATMA = 'paramatma';
    /**
     * Jeeva amsha
     */
    const AMSHA_JIVATMA = 'jivatma';
    
    /**
     * When a planet gets retrograde and remains in that very sign
     */
    const CHESHTA_VAKRA = 'vakra';
    /**
     * If a planet moves into the sign behind that sign
     */
    const CHESHTA_ANUVAKRA = 'anuvakra';
    /**
     * When the gati or speed is reduced to zero
     */
    const CHESHTA_VIKALA = 'vikala';
    /**
     * When the gati (speed) is less than the madhya gati (mid speed)
     */
    const CHESHTA_MANDA = 'manda';
    /**
     * If the gati (speed) goes on decreasing continously after madhya gati (mid speed) 
     */
    const CHESHTA_MANDATARA = 'mandatara';
    /**
     * If the gati (speed) is equal to madhya gati (mid speed)
     */
    const CHESHTA_SAMA = 'sama';
    /**
     * If the gati (speed) is faster than sama
     */
    const CHESHTA_CHARA = 'chara';
    /**
     * Entering next sign in accelerated motion
     */
    const CHESHTA_ATICHARA = 'atichara';

    /**
     * Neglect refraction rise
     */
    const RISING_NOREFRAC = 'norefrac';
    /**
     * Disc center rise
     */
    const RISING_DISCCENTER = 'disccenter';
    /**
     * Hindu sunrise - astronomical sunrise + time taken by the Sun to rise half 
     * of its diameter + time taken by the Sun to rise further to neutralize 
     * refraction effect.
     */
    const RISING_HINDU = 'hindu';
    
    /**
     * Nine grahas
     */
    const LIST_NAVA = 'nava';
    /**
     * Seven grahas (without Rahu and Ketu)
     */
    const LIST_SAPTA = 'sapta';
    /**
     * five grahas (without Surya, Chandra, Rahu and Ketu)
     */
    const LIST_PANCHA = 'pancha';
    /**
     * Shadowy grahas (Rahu and Ketu)
     */
    const LIST_CHAYA = 'chaya';
    /**
     * The speed of the slowest to the fastest
     */
    const LIST_CHESHTA = 'cheshta';
    
    /**
     * Pushkara bhaga
     */
    const PUSHKARA_BHAGA = 'bhaga';
    /**
     * Pushkara navamsha
     */
    const PUSHKARA_NAVAMSHA = 'navamsha';

    /**
     * List of Grahas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    public static $graha = [
        self::KEY_SY => Deva::DEVA_SURYA,
        self::KEY_CH => Deva::DEVA_CHANDRA,
        self::KEY_MA => Deva::DEVA_MANGAL,
        self::KEY_BU => Deva::DEVA_BUDHA,
        self::KEY_GU => Deva::DEVA_GURU,
        self::KEY_SK => Deva::DEVA_SHUKRA,
        self::KEY_SA => Deva::DEVA_SHANI,
        self::KEY_RA => self::NAME_RA,
        self::KEY_KE => self::NAME_KE,
    ];
    
    /**
     * Planetary motions and the strengths allotted to them.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 27, Verse 21-23.
     */
    public static $balaCheshta = [
        self::CHESHTA_VAKRA => 60,
        self::CHESHTA_ANUVAKRA => 30,
        self::CHESHTA_VIKALA => 15,
        self::CHESHTA_MANDA => 15,
        self::CHESHTA_MANDATARA => 7.5,
        self::CHESHTA_SAMA => 30,
        self::CHESHTA_CHARA => 45,
        self::CHESHTA_ATICHARA => 30,
    ];
    
    /**
     * Combustion orbs.
     * 
     * @var array
     * @see Surya Siddhanta. Chapter 9, Verse 6-9.
     * @see Varahamihira. Brihat Jataka. Chapter 7, Verse 2. Notes.
     */
    public static $bhagaAstangata = [
        Biblio::BOOK_SS => [
            self::KEY_CH => null,
        ],
        Biblio::BOOK_BJ => [
            self::KEY_CH => 12,
        ],
        Biblio::COMMON => [
            self::KEY_MA => 17,
            self::KEY_BU => [self::CHESHTA_SAMA => 14, self::CHESHTA_VAKRA => 12],
            self::KEY_GU => 11,
            self::KEY_SK => [self::CHESHTA_SAMA => 10, self::CHESHTA_VAKRA => 8],
            self::KEY_SA => 15,
        ]
    ];
    
    /**
     * Mrityu bhaga.
     * 
     * @var array
     * @see Vaidyanatha Dikshita. Jataka Parijata. Chapter 1, Verse 57.
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 10, Verse 47-50.
     * @see Mantreswara. Phaladeepika. Chapter 13, Verse 10.
     */
    public static $bhagaMrityu = [
        Biblio::BOOK_JP => [
            self::KEY_CH => [
                1 => 8, 2 => 25, 3 => 22, 4 => 22, 5 => 21, 6 => 1, 7 => 4, 8 => 23, 9 => 18, 10 => 20, 11 => 20, 12 => 10
            ]
        ],
        Biblio::BOOK_SC => [
            self::KEY_CH => [
                1 => 20, 2 => 25, 3 => 22, 4 => 22, 5 => 21, 6 => 1, 7 => 4, 8 => 23, 9 => 18, 10 => 20, 11 => 15, 12 => 10
            ]
        ],
        Biblio::BOOK_PH => [
            self::KEY_CH => [
                1 => 26, 2 => 12, 3 => 13, 4 => 25, 5 => 24, 6 => 11, 7 => 26, 8 => 14, 9 => 13, 10 => 25, 11 => 5, 12 => 12
            ]
        ],
        Biblio::COMMON => [
            self::KEY_SY => [
                1 => 20, 2 => 9, 3 => 12, 4 => 6, 5 => 8, 6 => 24, 7 => 16, 8 => 17, 9 => 22, 10 => 2, 11 => 3, 12 => 23
            ],
            self::KEY_MA => [
                1 => 19, 2 => 28, 3 => 25, 4 => 23, 5 => 29, 6 => 28, 7 => 14, 8 => 21, 9 => 2, 10 => 15, 11 => 11, 12 => 6
            ],
            self::KEY_BU => [
                1 => 15, 2 => 14, 3 => 13, 4 => 12, 5 => 8, 6 => 18, 7 => 20, 8 => 10, 9 => 21, 10 => 22, 11 => 7, 12 => 5
            ],
            self::KEY_GU => [
                1 => 19, 2 => 29, 3 => 12, 4 => 27, 5 => 6, 6 => 4, 7 => 13, 8 => 10, 9 => 17, 10 => 11, 11 => 15, 12 => 28
            ],
            self::KEY_SK => [
                1 => 28, 2 => 15, 3 => 11, 4 => 17, 5 => 10, 6 => 13, 7 => 4, 8 => 6, 9 => 27, 10 => 12, 11 => 29, 12 => 19
            ],
            self::KEY_SA => [
                1 => 10, 2 => 4, 3 => 7, 4 => 9, 5 => 12, 6 => 16, 7 => 3, 8 => 18, 9 => 28, 10 => 14, 11 => 13, 12 => 15
            ],
            self::KEY_RA => [
                1 => 14, 2 => 13, 3 => 12, 4 => 11, 5 => 24, 6 => 23, 7 => 22, 8 => 21, 9 => 10, 10 => 20, 11 => 18, 12 => 8
            ],
            self::KEY_KE => [
                1 => 8, 2 => 18, 3 => 20, 4 => 10, 5 => 21, 6 => 22, 7 => 23, 8 => 24, 9 => 11, 10 => 12, 11 => 13, 12 => 14
            ]
        ],
    ];

    /**
     * Specifications for risings and settings.
     * 
     * @var array
     */
    public static $risingType = [
        self::RISING_NOREFRAC,
        self::RISING_DISCCENTER,
        self::RISING_HINDU,
    ];

    /**
     * Devanagari 'graha' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    public static $translit = ['ga','virama','ra','ha'];

    /**
     * Returns the requested instance of graha class.
     * 
     * @param string $key The key of graha
     * @param null|array $options Options to set (optional)
     * - `relationSame`: relationship between the same grahas
     * - `relationChaya`: relationship between the chaya grahas
     * - `bhagaAstangata`: degree of combustion or data source
     * - `bhagaMrityu`: data source of mrityu bhaga
     * - `specificRashi`: set specific rashi for chaya grahas
     * - `drishtiRahu`: set drishti for Rahu
     * @return the requested instance of graha class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($key, array $options = null)
    {
        if (!array_key_exists($key, self::$graha)) {
            throw new Exception\InvalidArgumentException("Graha with the key '$key' does not exist.");
        }
        
        $grahaClass = 'Jyotish\Graha\Object\\' . $key;
        $grahaObject = new $grahaClass($options);

        return $grahaObject;
    }

    /**
     * Get mutual relationship between grahas in points.
     * 
     * @param string $graha1 Graha key
     * @param string $graha2 Graha key
     * @return int
     */
    public static function getMutualRelation($graha1, $graha2)
    {
        $relation = function ($graha1, $graha2)
        {
            $Graha = self::getInstance($graha1, ['relationSame' => true]);
            return $Graha->grahaRelation[$graha2];
        };
        $relation1 = $relation($graha1, $graha2);
        $relation2 = $relation($graha2, $graha1);

        $add = ($relation1 < 0 || $relation2 < 0) ? 2 : 3;

        return $relation1 + $relation2 + $add;
    }
    
    /**
     * Get list of grahas.
     * 
     * @param string $option The option to list grahas.
     * @return array List of grahas.
     */
    public static function listGraha($option = self::LIST_NAVA)
    {
        $list = [];
        switch ($option) {
            case self::LIST_SAPTA:
                $list = array_slice(self::$graha, 0, 7);
                break;
            case self::LIST_PANCHA:
                $list = array_slice(self::$graha, 2, 5);
                break;
            case self::LIST_CHAYA:
                $list = array_slice(self::$graha, 7);
                break;
            case self::LIST_CHESHTA:
                $order = [self::KEY_SA, self::KEY_GU, self::KEY_MA, self::KEY_SY, self::KEY_SK, self::KEY_BU, self::KEY_CH];
                foreach ($order as $key) {
                    $list[$key] = self::$graha[$key];
                }
                break;
            case self::LIST_NAVA:
            default:
                $list = self::$graha;
        }
        return $list;
    }
    
    /**
     * Get list of grahas by feature.
     * 
     * @param string $feature Feature of graha
     * @param string $value Value of feature
     * @return array
     */
    public static function listGrahaByFeature($feature, $value)
    {
        $list = [];
        foreach (self::$graha as $key => $name) {
            $Graha = self::getInstance($key);
            
            $grahaFeature = 'graha' . ucfirst(strtolower($feature));
            
            if (!property_exists($Graha, $grahaFeature)) {
                throw new Exception\UnexpectedValueException("Graha feature '$grahaFeature' does not exist.");
            }
            
            $Graha->$grahaFeature == $value ? $list[$key] = $name : null;
        }
        return $list;
    }
    
    /**
     * Get combustion orbs.
     * 
     * @param string $book
     * @return array
     */
    public static function listBhagaAstangata($book = Biblio::BOOK_SS)
    {
        if (in_array($book, [Biblio::BOOK_SS, Biblio::BOOK_BJ])) {
            $bhaga[self::KEY_CH] = self::$bhagaAstangata[$book][self::KEY_CH];
        } else {
            $bhaga[self::KEY_CH] = self::$bhagaAstangata[Biblio::BOOK_SS][self::KEY_CH];
        }
        
        $bhagas = array_merge($bhaga, self::$bhagaAstangata[Biblio::COMMON]);
        
        return $bhagas;
    }

    /**
     * Get list of mrityu bhaga.
     * 
     * @param string $book
     * @return array
     */
    public static function listBhagaMrityu($book = Biblio::BOOK_JP)
    {
        if (in_array($book, [Biblio::BOOK_JP, Biblio::BOOK_SC, Biblio::BOOK_PH])) {
            $bhaga[self::KEY_CH] = self::$bhagaMrityu[$book][self::KEY_CH];
        } else {
            $bhaga[self::KEY_CH] = self::$bhagaMrityu[Biblio::BOOK_JP][self::KEY_CH];
        }
        
        $bhagas = array_merge($bhaga, self::$bhagaMrityu[Biblio::COMMON]);
        
        return $bhagas;
    }
}