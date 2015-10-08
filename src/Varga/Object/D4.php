<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D4 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D4';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Chaturthamsha',
        'Turyamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 4;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 9.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        if ($ganitaRashi['degree'] < 7.5) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi']);
        } elseif ($ganitaRashi['degree'] >= 7.5 && $ganitaRashi['degree'] < 15) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 4);
        } elseif ($ganitaRashi['degree'] >= 15 && $ganitaRashi['degree'] < 22.5) {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 7);
        } else {
            $vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 10);
        }

        return $vargaRashi;
    }
}