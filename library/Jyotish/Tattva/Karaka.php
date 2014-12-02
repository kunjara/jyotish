<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

use Jyotish\Base\Analysis;

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
     * List of all karakas.
     * 
     * @var array
     */
    static public $karaka = array(
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
     * Get list of karakas depending on the system.
     * 
     * @param string $system
     * @return array
     */
    static public function karakaList($system = Analysis::SYSTEM_PARASHARA)
    {
        $list = self::$karaka;
        
        if($system == Analysis::SYSTEM_JAIMINI){
            unset($list[4]);
            $list = array_values($list);
        }
        return $list;
    }
}
