<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva;

/**
 * Data class of dwipada.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Nara extends \Jyotish\Tattva\Jiva
{
    /**
     * Devine
     */
    const GANA_DEVA = 'deva';
    /**
     * Human
     */
    const GANA_MANUSHA = 'manusha';
    /**
     * Demonic
     */
    const GANA_RAKSHASA = 'rakshasa';

    const LIMB_HEAD = 'head';
    const LIMB_FACE = 'face';
    const LIMB_ARMS = 'arms';
    const LIMB_HEART = 'heart';
    const LIMB_STOMACH = 'stomach';
    const LIMB_HIP = 'hip';
    const LIMB_BELOWNAVEL = 'below navel';
    const LIMB_PRIVITIES = 'privities';
    const LIMB_THIGHS = 'thighs';
    const LIMB_KNEES = 'knees';
    const LIMB_ANKLES = 'ankles';
    const LIMB_FEET = 'feet';
    
    /**
     * Gana of nara.
     * 
     * @var array
     */
    public static $gana = [
        self::GANA_DEVA,
        self::GANA_MANUSHA,
        self::GANA_RAKSHASA,
    ];
}
