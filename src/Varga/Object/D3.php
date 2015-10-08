<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D3.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D3 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D3';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Drekkana',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 3;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 7-8.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        if ($ganitaRashi['degree'] < 10) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi']);
        } elseif ($ganitaRashi['degree'] >= 10 && $ganitaRashi['degree'] < 20) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 5);
        } else {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 9);
        }

        return $vargaRashi;
    }
}