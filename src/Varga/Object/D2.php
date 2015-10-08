<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D2.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D2 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D2';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Hora',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 2;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 5-6.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        if (($ganitaRashi['degree'] < 15 && $ganitaRashi['rashi'] % 2) || ($ganitaRashi['degree'] >= 15 && !($ganitaRashi['rashi'] % 2))) {
            $vargaRashi['rashi'] = 5;
        } else {
            $vargaRashi['rashi'] = 4;
        }

        return $vargaRashi;
    }
}