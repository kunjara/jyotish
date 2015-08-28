<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use Jyotish\Base\Biblio;

/**
 * Division of Time In Jyotish.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Kala
{
    const KALA_PARAMANU = 'paramanu';
    const KALA_ANU = 'anu';
    const KALA_TRASARENU = 'trasarenu';
    const KALA_TRUTI = 'truti';
    const KALA_VEDHA = 'vedha';
    const KALA_LAVA = 'lava';
    const KALA_NIMESHA = 'nimesha';
    const KALA_KSHANA = 'kshana';
    const KALA_KASHTHA = 'kashtha';
    const KALA_KALA = 'kala';
    const KALA_LAGHU = 'laghu';
    const KALA_NADIKA = 'nadika';
    const KALA_MUHURTA = 'muhurta';
    const KALA_PRAHARA = 'prahara';
    const KALA_YAMA = 'yama';
    const KALA_AHORATRA = 'ahoratra';
    const KALA_VARA = 'vara';
    const KALA_PAKSHA = 'paksha';
    const KALA_MASA = 'masa';
    const KALA_RITU = 'ritu';
    const KALA_AYANA = 'ayana';
    const KALA_VARSHA = 'varsha';

    const RITU_VASANTA = 'vasanta';
    const RITU_GRISHMA = 'grishma';
    const RITU_VARSHA = 'varsha';
    const RITU_SHARAD = 'sharad';
    const RITU_HEMANTA = 'hemanta';
    const RITU_SHISHIRA = 'shishira';
    
    /**
     * List of kala intervals.
     * 
     * @var array
     */
    public static $kala = [
        self::KALA_PARAMANU,
        self::KALA_ANU,
        self::KALA_TRASARENU,
        self::KALA_TRUTI,
        self::KALA_VEDHA,
        self::KALA_LAVA,
        self::KALA_NIMESHA,
        self::KALA_KSHANA,
        self::KALA_KASHTHA,
        self::KALA_KALA,
        self::KALA_LAGHU,
        self::KALA_NADIKA,
        self::KALA_MUHURTA,
        self::KALA_PRAHARA,
        self::KALA_YAMA,
        self::KALA_AHORATRA,
        self::KALA_VARA,
        self::KALA_PAKSHA,
        self::KALA_MASA,
        self::KALA_RITU,
        self::KALA_AYANA,
        self::KALA_VARSHA,
    ];

    /**
     * The duration of time of one paramanu. Second is divided into 30375 parts.
     * 
     * @var float In seconds
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $kalaParamanu = [
        Biblio::BOOK_SB => 3.2921810699588477e-5,
    ];

    /**
     * The duration of time of two paramanu.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $kalaAnu = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_PARAMANU,
            'part' => 2
        ],
    ];

    /**
     * The duration of time of 3 anu. Other name is hexatom.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $kalaTrasarenu = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_ANU,
            'part' => 3
        ],
    ];

    /**
     * The duration of time of 3 trasarenu.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $kalaTruti = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_TRASARENU,
            'part' => 3 
        ],
    ];

    /**
     * The duration of time of one hundred trutis.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $kalaVedha = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_TRUTI,
            'part' => 100
        ],
    ];

    /**
     * The duration of time of three vedhas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $kalaLava = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_VEDHA,
            'part' => 3
        ],
    ];

    /**
     * The duration of time of three lavas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     * @see Manu-Samhita. Chapter 1, Verse 64.
     */
    public static $kalaNimesha = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_LAVA,
            'part' => 3
        ],
        Biblio::BOOK_MS => 0.1777777777777777,
    ];

    /**
     * The duration of time of three nimeshas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $kalaKshana = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_NIMESHA,
            'part' => 3
        ],
    ];

    /**
     * The duration of time of five kshanas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     * @see Manu-Samhita. Chapter 1, Verse 64.
     */
    public static $kalaKashtha = [ 
        Biblio::BOOK_SB => [
            'name' => self::KALA_KSHANA,
            'part' => 5
        ],
        Biblio::BOOK_MS => [
            'name' => self::KALA_NIMESHA,
            'part' => 18
        ]
    ];
    
    /**
     * The duration of time of thirty kashthas.
     * 
     * @var array.
     * @see Manu-Samhita. Chapter 1, Verse 64.
     */
    public static $kalaKala = [
        Biblio::BOOK_MS => [
            'name' => self::KALA_KASHTHA,
            'part' => 30
        ]
    ];

    /**
     * The duration of time of fifteen kashthas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $kalaLaghu = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_KASHTHA,
            'part' => 15
        ],
    ];

    /**
     * The duration of time of fifteen laghus. Other name is danda.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     */
    public static $kalaNadika = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_LAGHU,
            'part' => 15
        ],
    ];

    /**
     * The duration of time of two dandas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     * @see Manu-Samhita. Chapter 1, Verse 64.
     */
    public static $kalaMuhurta = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_NADIKA,
            'part' => 2
        ],
        Biblio::BOOK_MS => [
            'name' => self::KALA_KALA,
            'part' => 30
        ],
    ];

    /**
     * The duration of time of six dandas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     */
    public static $kalaPrahara = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_NADIKA,
            'part' => 6
        ],
    ];
    /**
     * The duration of time of four praharas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 10.
     */
    public static $kalaYama = [
        Biblio::BOOK_SB => [
            'name' => self::KALA_PRAHARA,
            'part' => 4
        ],
    ];

    /**
     * The duration of time of two yamas.
     * 
     * @var array
     */
    public static $kalaAhoratra = [
        'name' => self::KALA_YAMA,
        'part' => 2
    ];
    
    /**
     * Get list of kalas.
     * 
     * @param string $book
     * @return array
     */
    public static function listKala($book = Biblio::COMMON)
    {
        $list = self::$kala;
        
        if ($book == Biblio::COMMON) {
            return $list;
        }
        
        $result = [];
        foreach ($list as $kala) {
            $kalaName = 'kala' . ucfirst($kala);
            if (isset(self::${$kalaName}) && isset(self::${$kalaName}[$book])) {
                $result[] = $kala;
            } else {
                continue;
            }
        }
        
        return $result;
    }

    /**
     * Get duration of interval.
     * 
     * @param string $kala
     * @param string $book
     * @param int $number
     * @return float In seconds
     */
    public static function getKalaDuration($kala, $book = Biblio::BOOK_SB, $number = 1)
    {
        if (!defined('Jyotish\Base\Biblio::BOOK_'.strtoupper($book))) {
            throw new Exception\InvalidArgumentException("Book '$book' is not defined.");
        }
        
        switch ($book) {
            case Biblio::BOOK_MS:
                $result = self::getKalaParts($kala, $book) * self::$kalaNimesha[Biblio::BOOK_MS] * $number;
                break;
            case Biblio::BOOK_SB:
            default:
                $result = self::getKalaParts($kala, $book) * self::$kalaParamanu[Biblio::BOOK_SB] * $number;
        }
        
        return $result;
    }

    /**
     * Get the number of base interval.
     * 
     * @param string $kala
     * @param string $book
     * @return int
     */
    private static function getKalaParts($kala, $book)
    {
        if (!defined('self::KALA_'.strtoupper($kala))) {
            throw new Exception\InvalidArgumentException("Time interval '$kala' is not defined.");
        }
        
        if (
            ($book == Biblio::BOOK_SB && $kala == self::KALA_PARAMANU) ||
            ($book == Biblio::BOOK_MS && $kala == self::KALA_NIMESHA)
        ) {
            return 1;
        } else {
            $kalaName = 'kala' . ucfirst($kala);
            
            if (isset(self::${$kalaName}[$book])) {
                $kn = self::${$kalaName}[$book]['name'];
                $kp = self::${$kalaName}[$book]['part'];
            } else {
                $bookName = Biblio::$book[$book];
                throw new Exception\InvalidArgumentException("Time interval '$kala' is not defined in '$bookName'.");
            }

            $kp *= self::getKalaParts($kn, $book);
            return $kp;
        }
    }
}
