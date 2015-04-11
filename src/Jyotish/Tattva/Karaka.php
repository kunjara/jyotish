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
class Karaka {
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
    static public $karakaChara = array(
        self::NAME_ATMA,
        self::NAME_AMATYA,
        self::NAME_BHRATRU,
        self::NAME_MATRU,
        self::NAME_PITRU,
        self::NAME_PUTRA,
        self::NAME_GNATI,
        self::NAME_DARA,
    );
    
    /**
     * List of sthira karakas.
     * 
     * @var array
     */
    static public $karakaSthira = array(
        Graha::KEY_SY => self::NAME_PUTRA,
        Graha::KEY_CH => self::NAME_MATRU,
        Graha::KEY_MA => self::NAME_BHRATRU,
        Graha::KEY_BU => self::NAME_GNATI,
        Graha::KEY_GU => self::NAME_PUTRA,
        Graha::KEY_SK => self::NAME_DARA,
        Graha::KEY_SA => self::NAME_AYUSH
    );

    /**
     * Get list of karakas depending on the system.
     * 
     * @param string $system
     * @return array
     */
    static public function karakaList($system = Biblio::BOOK_BPHS)
    {
        $list = self::$karakaChara;
        
        switch ($system){
            case Biblio::AUTHOR_JAIMINI:
            case Biblio::BOOK_US:
                unset($list[4]);
                $list = array_values($list);
                break;
            case Biblio::AUTHOR_PARASHARA:
            case Biblio::BOOK_BPHS:
            default: 
        }
        
        return $list;
    }
}
