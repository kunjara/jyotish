<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha;

/**
 * Dasha data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Dasha {
    const NESTING_MAX = 3;

    const NESTING_1 = 'Mahadasha';
    const NESTING_2 = 'Antardasha';
    const NESTING_3 = 'Pratyantardasha';
    const NESTING_4 = 'Sookshma-antardasha';
    const NESTING_5 = 'Prana-antardasha';
    const NESTING_6 = 'Deha-antardasha';

    const DASHA_VIMSHOTTARI = 'Vimshottari';
    const DASHA_ASHTOTTARI	= 'Ashtottari';

    static public $dasha = array(
        self::DASHA_VIMSHOTTARI,
        self::DASHA_ASHTOTTARI,
    );

    /**
     * Returns the requested instance of dasha class.
     * 
     * @param string $key The acronym of dasha
     * @return the requested instance of dasha class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key) {
        if (!in_array($key, self::$dasha)) {
            throw new Exception\InvalidArgumentException("Dasha '$key' does not exist.");
        }

        $dashaClass = 'Jyotish\Dasha\Object\\' . $key;
        $dashaObject = new $dashaClass();

        return $dashaObject;
    }
}