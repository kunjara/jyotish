<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Varga\Varga;
use Jyotish\Ganita\Math;

/**
 * Abstract varga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractVarga {
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = null;

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = array();

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = null;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     */
    abstract protected function getVargaRashi(array $ganitaRashi);

    /**
     * Get varga data.
     * 
     * @param array $ganitaData
     * @return array
     * @throws InvalidArgumentException
     */
    public function getVargaData($ganitaData) {
        if(is_null($ganitaData)) {
            throw new \Jyotish\Varga\Exception\InvalidArgumentException("Ganita data must be an array of calculation positions.");
        }

        if($this->vargaKey == Varga::KEY_D1){
            return $ganitaData;
        }

        $bhava1Varga = $this->getVargaRashi($ganitaData['bhava'][1]);

        foreach ($ganitaData['bhava'] as $k => $v) {
            if($k == 1) {
                $rashi = $bhava1Varga['rashi'];
            } else {
                $rashi = Math::numberNext($rashi);
            }
            $vargaData['bhava'][$k] = array(
                'rashi' => $rashi,
                'degree' => $bhava1Varga['degree'],
                'longitude' => 30 * ($rashi - 1) + $bhava1Varga['degree'],
            );
        }
        foreach ($ganitaData['graha'] as $k => $v) {
            $result = $this->getVargaRashi($v);
            $vargaData['graha'][$k] = array(
                'rashi' => $result['rashi'],
                'degree' => $result['degree'],
                'speed' => $ganitaData['graha'][$k]['speed'],
                'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
                'latitude' => $v['latitude'],
            );
        }
        foreach ($ganitaData['extra'] as $k => $v) {
            $result = $this->getVargaRashi($v);
            $vargaData['extra'][$k] = array(
                'rashi' => $result['rashi'],
                'degree' => $result['degree'],
                'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
            );
        }
        return $vargaData;
    }

    public function __construct($options) {
        return $this;
    }
}
