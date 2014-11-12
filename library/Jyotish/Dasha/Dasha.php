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
    
    /**
     * Name of period with nesting is equal to 1
     */
    const NESTING_1 = 'Mahadasha';
    /**
     * Name of period with nesting is equal to 2
     */
    const NESTING_2 = 'Antardasha';
    /**
     * Name of period with nesting is equal to 3
     */
    const NESTING_3 = 'Pratyantardasha';
    /**
     * Name of period with nesting is equal to 4
     */
    const NESTING_4 = 'Sookshma-antardasha';
    /**
     * Name of period with nesting is equal to 5
     */
    const NESTING_5 = 'Prana-antardasha';
    /**
     * Name of period with nesting is equal to 6
     */
    const NESTING_6 = 'Deha-antardasha';
    
    /**
     * Vimshottari name
     */
    const NAME_VIMSHOTTARI = 'Vimshottari';
    /**
     * Ashtottari name
     */
    const NAME_ASHTOTTARI	= 'Ashtottari';

    /**
     * Names of dashas.
     * 
     * @var array
     */
    static public $dasha = array(
        self::NAME_VIMSHOTTARI,
        self::NAME_ASHTOTTARI,
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