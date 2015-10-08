<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D10.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D10 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D10';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Dashamsha',
        'Dashamamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 10;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 13-14.
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
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'] + $result['units'], 9);
        }

        return $vargaRashi;
    }
}