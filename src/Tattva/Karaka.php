<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

use Jyotish\Base\Biblio;
use Jyotish\Graha\Graha;

/**
 * Class of karaka data.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Karaka
{
    /**
     * Atmakaraka key
     */
    const KEY_ATMA = 'AK';
    /**
     * Amatyakaraka key
     */
    const KEY_AMATYA = 'AmK';
    /**
     * Bhratrukaraka key
     */
    const KEY_BHRATRU = 'BK';
    /**
     * Matrukaraka key
     */
    const KEY_MATRU = 'MK';
    /**
     * Pitrukaraka key
     */
    const KEY_PITRU = 'PiK';
    /**
     * Putrakaraka key
     */
    const KEY_PUTRA = 'PK';
    /**
     * Gnatikaraka key
     */
    const KEY_GNATI = 'GK';
    /**
     * Darakaraka key
     */
    const KEY_DARA = 'DK';
    /**
     * Ayushkaraka key
     */
    const KEY_AYUSH = 'AyK';
    
    /**
     * Own self
     */
    const NAME_ATMA = 'Atmakaraka';
    /**
     * Advisor
     */
    const NAME_AMATYA = 'Amatyakaraka';
    /**
     * Brothers and sisters
     */
    const NAME_BHRATRU = 'Bhratrukaraka';
    /**
     * Mother
     */
    const NAME_MATRU = 'Matrukaraka';
    /**
     * Father
     */
    const NAME_PITRU = 'Pitrukaraka';
    /**
     * Children
     */
    const NAME_PUTRA = 'Putrakaraka';
    /**
     * Cousins and relations
     */
    const NAME_GNATI = 'Gnatikaraka';
    /**
     * Husband, wife
     */
    const NAME_DARA = 'Darakaraka';
    /**
     * Death
     */
    const NAME_AYUSH = 'Ayushkaraka';

    /**
     * List of chara karakas.
     * 
     * @var array
     */
    public static $karaka = [
        self::KEY_ATMA => self::NAME_ATMA,
        self::KEY_AMATYA => self::NAME_AMATYA,
        self::KEY_BHRATRU => self::NAME_BHRATRU,
        self::KEY_MATRU => self::NAME_MATRU,
        self::KEY_PITRU => self::NAME_PITRU,
        self::KEY_PUTRA => self::NAME_PUTRA,
        self::KEY_GNATI => self::NAME_GNATI,
        self::KEY_DARA => self::NAME_DARA,
        self::KEY_AYUSH => self::NAME_AYUSH,
    ];
    
    /**
     * List of sthira karakas.
     * 
     * @var array
     */
    public static $karakaSthira = [
        Graha::KEY_SY => self::NAME_PUTRA,
        Graha::KEY_CH => self::NAME_MATRU,
        Graha::KEY_MA => self::NAME_BHRATRU,
        Graha::KEY_BU => self::NAME_GNATI,
        Graha::KEY_GU => self::NAME_PUTRA,
        Graha::KEY_SK => self::NAME_DARA,
        Graha::KEY_SA => self::NAME_AYUSH
    ];

    /**
     * Get list of karakas depending on the system.
     * 
     * @param string $system
     * @return array
     */
    public static function listKaraka($system = Biblio::BOOK_BPHS)
    {
        $list = self::$karaka;
        array_pop($list);
        
        $systemPrepare = strtolower($system);
        
        switch ($systemPrepare) {
            case Biblio::AUTHOR_JAIMINI:
            case Biblio::BOOK_US:
                unset($list[self::KEY_PITRU]);
                break;
            case Biblio::AUTHOR_PARASHARA:
            case Biblio::BOOK_BPHS:
            default: 
        }
        
        return $list;
    }
}
