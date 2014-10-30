<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

/**
 * Division of Time In Jyotish.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Kala {
    const KALA_PARAMANU = 'paramanu';
    const KALA_ANU = 'anu';
    const KALA_TRASARENU = 'trasarenu';
    const KALA_TRUTI = 'truti';
    const KALA_VEDHA = 'vedha';
    const KALA_LAVA = 'lava';
    const KALA_NIMESHA = 'nimesha';
    const KALA_KSHANA = 'kshana';
    const KALA_KASHTHA = 'kashtha';
    const KALA_LAGHU = 'laghu';
    const KALA_NADIKA = 'nadika';
    const KALA_MUHURTA = 'muhurta';
    const KALA_PRAHARA = 'prahara';
    const KALA_YAMA = 'yama';
    const KALA_VARA = 'vara';
    const KALA_AHORATRA = 'ahoratra';
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
     * The duration of time of one paramanu. Second is divided into 30375 parts.
     * 
     * @var float In seconds
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $paramanu = 3.2921810699588477e-5;

    /**
     * The duration of time of two paramanu.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $anu = array(
        'name' => self::KALA_PARAMANU,
        'part' => 2
    );

    /**
     * The duration of time of 3 anu. Other name is hexatom.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 5.
     */
    public static $trasarenu = array(
        'name' => self::KALA_ANU,
        'part' => 3
    );

    /**
     * The duration of time of 3 trasarenu.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $truti = array(
        'name' => self::KALA_TRASARENU,
        'part' => 3
    );

    /**
     * The duration of time of one hundred trutis.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $vedha = array(
        'name' => self::KALA_TRUTI,
        'part' => 100
    );

    /**
     * The duration of time of three vedhas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 6.
     */
    public static $lava = array(
        'name' => self::KALA_VEDHA,
        'part' => 3
    );

    /**
     * The duration of time of three lavas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $nimesha = array(
        'name' => self::KALA_LAVA,
        'part' => 3
    );

    /**
     * The duration of time of three nimeshas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $kshana = array(
        'name' => self::KALA_NIMESHA,
        'part' => 3
    );

    /**
     * The duration of time of five kshanas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $kashtha = array(
        'name' => self::KALA_KSHANA,
        'part' => 5
    );

    /**
     * The duration of time of fifteen kashthas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 7.
     */
    public static $laghu = array(
        'name' => self::KALA_KASHTHA,
        'part' => 15
    );

    /**
     * The duration of time of fifteen laghus. Other name is danda.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     */
    public static $nadika = array(
        'name' => self::KALA_LAGHU,
        'part' => 15
    );

    /**
     * The duration of time of two dandas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     */
    public static $muhurta = array(
        'name' => self::KALA_NADIKA,
        'part' => 2
    );

    /**
     * The duration of time of six dandas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 8.
     */
    public static $prahara = array(
        'name' => self::KALA_NADIKA,
        'part' => 6
    );
    /**
     * The duration of time of four praharas.
     * 
     * @var array
     * @see Srimad-Bhagavatam. Canto 3, Chapter 11, Text 10.
     */
    public static $yama = array(
        'name' => self::KALA_PRAHARA,
        'part' => 4
    );

    /**
     * The duration of time of two yamas.
     * 
     * @var array
     */
    public static $ahoratra = array(
        'name' => self::KALA_YAMA,
        'part' => 2
    );

    /**
     * Get interval length.
     * 
     * @param string $kalaName
     * @param int $number
     * @return float In seconds
     */
    public static function getKalaDuration($kalaName, $number = 1)
    {
        return self::getKalaParts($kalaName) * self::$paramanu * $number;
    }

    /**
     * Get the number of paramanus in the time interval.
     * 
     * @param string $kalaName
     * @return int
     */
    protected static function getKalaParts($kalaName)
    {
        if(!defined('self::KALA_'.strtoupper($kalaName))){
            throw new Exception\InvalidArgumentException("Time interval '$kalaName' is not defined.");
        }

        if($kalaName != self::KALA_PARAMANU){
            $kn = self::${$kalaName}['name'];
            $kp = self::${$kalaName}['part'];

            $kp *= self::getKalaParts($kn);
            return $kp;
        }else{
            return 1;
        }
    }
}
