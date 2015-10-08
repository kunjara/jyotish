<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D60.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D60 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D60';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Shashtiamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 60;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 33-41.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        $stepRashi = floor($ganitaRashi['degree'] * 2) % 12 + 1;

        $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], $stepRashi);

        return $vargaRashi;
    }
}