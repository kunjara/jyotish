<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Graha\Graha;

/**
 * Class of varga D30.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D30 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D30';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Trimshamsha',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 30;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 27-28.
     */
    public function getVargaRashi(array $ganitaRashi)
    {
        $amshaSize = 30 / $this->vargaAmsha;
        $result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
        
        $vargaRashi = [];
        $vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;

        if ($ganitaRashi['degree'] < 5) {
            if ($ganitaRashi['rashi'] % 2) {
                $lord = Graha::KEY_MA;
            } else {
                $lord = Graha::KEY_SK;
            }
        } elseif ($ganitaRashi['degree'] >= 5 && $ganitaRashi['degree'] < 10) {
            if ($ganitaRashi['rashi'] % 2) {
                $lord = Graha::KEY_SA;
            } else {
                $lord = Graha::KEY_BU;
            }
        } elseif ($ganitaRashi['degree'] >= 10 && $ganitaRashi['degree'] < 18) {

            $lord = Graha::KEY_GU;

        } elseif ($ganitaRashi['degree'] >= 18 && $ganitaRashi['degree'] < 25) {
            if ($ganitaRashi['rashi'] % 2) {
                $lord = Graha::KEY_BU;
            } else {
                $lord = Graha::KEY_SA;
            }
        } else {
            if ($ganitaRashi['rashi'] % 2) {
                $lord = Graha::KEY_SK;
            } else {
                $lord = Graha::KEY_MA;
            }
        }

        if ($ganitaRashi['rashi'] % 2)
            $trait = 'positive';
        else
            $trait = 'negative';

        $grahaObject = Graha::getInstance($lord);
        $grahaSwaRashi = $grahaObject->grahaSwa;
        $vargaRashi['rashi'] = $grahaSwaRashi[$trait]['rashi'];

        return $vargaRashi;
    }
}