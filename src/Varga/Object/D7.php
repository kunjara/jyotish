<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D7.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D7 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D7';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Saptamamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 7;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 10-11.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        if ($ganitaRashi['rashi'] % 2) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units']);
        } else {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units'], 7);
        }

        return $vargaRashi;
    }
}