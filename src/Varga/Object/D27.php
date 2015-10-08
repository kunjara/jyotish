<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Rashi\Rashi;
use Jyotish\Tattva\Maha;

/**
 * Class of varga D27.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D27 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D27';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Saptavimshamsha',
        'Bhamsha',
        'Nakshatramsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 27;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 24-26.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        $rashiObject = Rashi::getInstance((int) $ganitaRashi['rashi']);
        $rashiBhuta = $rashiObject->rashiBhuta;

        switch ($rashiBhuta) {
            case Maha::BHUTA_AGNI:
                $vargaRashi['rashi'] = Math::numberInCycle(1 + $result['units']);
                break;
            case Maha::BHUTA_PRITVI:
                $vargaRashi['rashi'] = Math::numberInCycle(4 + $result['units']);
                break;
            case Maha::BHUTA_VAYU:
                $vargaRashi['rashi'] = Math::numberInCycle(7 + $result['units']);
                break;
            case Maha::BHUTA_JALA:
                $vargaRashi['rashi'] = Math::numberInCycle(10 + $result['units']);
                break;
        }

        return $vargaRashi;
    }
}