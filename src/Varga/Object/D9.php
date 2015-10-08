<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Rashi\Rashi;

/**
 * Class of varga D9.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D9 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D9';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Navamsha',
        'Navamamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 9;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 12.
     */
    protected function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        $rashiObject = Rashi::getInstance((int) $ganitaRashi['rashi']);
        $rashiBhava = $rashiObject->rashiBhava;

        switch ($rashiBhava) {
            case Rashi::BHAVA_CHARA:
                $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units']);
                break;
            case Rashi::BHAVA_STHIRA:
                $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units'], 9);
                break;
            case Rashi::BHAVA_DVISVA:
                $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units'], 5);
                break;
        }

        return $vargaRashi;
    }
}