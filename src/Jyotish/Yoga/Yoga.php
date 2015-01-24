<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga;

/**
 * Data yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Yoga {
    /**
     * Dhana yoga (wealth)
     */
    const TYPE_DHANA = 'dhana';
    /**
     * Mahapurusha yoga (great persons)
     */
    const TYPE_MAHAPURUSHA = 'mahapurusha';
    /**
     * Nabhasha yoga
     */
    const TYPE_NABHASHA = 'nabhasha';
    /**
     * Raja yoga (royal association)
     */
    const TYPE_RAJA = 'raja';
    /**
     * Parivarthana yoga (bhava exchange)
     */
    const TYPE_PARIVARTHANA = 'parivarthana';
    
    const MAHAPURUSHA_MAHA = 'maha';
    const MAHAPURUSHA_KHALA = 'khala';
    const MAHAPURUSHA_DAINYA = 'dainya';
    
    const INTERPLAY_PARIVARTHANA = 'parivarthana';
    const INTERPLAY_CONJUNCT = 'conjunct';
    const INTERPLAY_ASPECT = 'aspect';
}
