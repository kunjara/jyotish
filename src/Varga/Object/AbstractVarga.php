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
abstract class AbstractVarga
{
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\DataTrait;
    
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
    protected $vargaNames = [];

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
     * @return array
     */
    public function getVargaData() {
        $this->checkData();
        $vargaData = [];

        if ($this->vargaKey == Varga::KEY_D1) {
            return $this->getData(\Jyotish\Base\Data::listBlock('main'));
        }

        $bhava1Varga = $this->getVargaRashi($this->getData()['bhava'][1]);
        foreach ($this->getData()['bhava'] as $k => $v) {
            $rashi = $k == 1 ? $bhava1Varga['rashi'] : Math::numberNext($rashi);
            $vargaData['bhava'][$k] = [
                'rashi' => $rashi,
                'degree' => $bhava1Varga['degree'],
                'longitude' => 30 * ($rashi - 1) + $bhava1Varga['degree'],
            ];
        }
        
        foreach ($this->getData()['graha'] as $k => $v) {
            $result = $this->getVargaRashi($v);
            $vargaData['graha'][$k] = [
                'rashi' => $result['rashi'],
                'degree' => $result['degree'],
                'speed' => $this->getData()['graha'][$k]['speed'],
                'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
            ];
        }
        
        foreach ($this->getData()['lagna'] as $k => $v) {
            $result = $this->getVargaRashi($v);
            $vargaData['lagna'][$k] = [
                'rashi' => $result['rashi'],
                'degree' => $result['degree'],
                'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
            ];
        }
        return $vargaData;
    }
}
