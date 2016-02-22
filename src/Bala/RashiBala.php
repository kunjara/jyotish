<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bala;

use Jyotish\Base\Analysis;
use Jyotish\Bala\GrahaBala;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * Class for calculation rashi bala.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class RashiBala extends Analysis
{
    const VARGA_GRAHA = 'graha';
    const VARGA_CHARA = 'chara';
    const VARGA_STHIRA = 'sthira';
    const VARGA_DRISHTI = 'drishti';
    
    /**
     * The values of bala.
     * 
     * @var array
     */
    protected $bala = [];
    
    /**
     * Bala components.
     * 
     * @var array
     */
    protected $balaVarga = [
        self::VARGA_GRAHA,
        self::VARGA_CHARA,
        self::VARGA_STHIRA,
        self::VARGA_DRISHTI
    ];
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        parent::__construct($Data);
        
        $this->bala['total'] = [];
        foreach ($this->balaVarga as $varga) {
            $balaVarga = 'bala'.ucfirst($varga);
            $this->bala[$varga] = $this->$balaVarga();
            $this->bala['total'] = Math::arraySum($this->bala[$varga], $this->bala['total']);
        }
    }
    
    /**
     * Bala of rashis lord.
     * 
     * @return array
     */
    protected function balaGraha()
    {
        $GrahaBala = new GrahaBala($this->Data);
        $grahaBala = $GrahaBala->getBala()['total'];
        
        $bala = [];
        foreach (Rashi::$rashi as $key => $name) {
            $Rashi = Rashi::getInstance($key);
            $ruler = $Rashi->rashiRuler;
            $bala[$key] = $grahaBala[$ruler];
        }
        return $bala;
    }

    /**
     * In any chart, all chara rashis get 20 units, all sthira get 40 units and 
     * dvisva rashis get 60 units.
     * 
     * @return array
     */
    protected function balaChara()
    {
        $bala = [];
        foreach (Rashi::$rashi as $key => $name) {
            $Rashi = Rashi::getInstance($key);
            $bhava = $Rashi->rashiBhava;
            switch ($bhava) {
                case Rashi::BHAVA_CHARA:
                    $bala[$key] = 20;
                    break;
                case Rashi::BHAVA_STHIRA:
                    $bala[$key] = 40;
                    break;
                case Rashi::BHAVA_DVISVA:
                    $bala[$key] = 60;
            }
        }
        return $bala;
    }
    
    /**
     * Sthira bala is computed by the number of planets in various rashis. If one 
     * planet is placed in a rashi, that rashi gets 10 units. If two planets are 
     * placed then the particular rashi gets 20 units and so on.
     * 
     * @return array
     */
    protected function balaSthira()
    {
        $bala = [];
        foreach ($this->getData()['graha'] as $key => $value) {
            if ($key == Graha::KEY_RA || $key == Graha::KEY_KE) continue;
            $bala[$value['rashi']] = !isset($bala[$value['rashi']]) ? 10 : $bala[$value['rashi']] + 10;
        }
        return $bala;
    }
    
    /**
     * Any rashi aspected by its lord gets additional strength and those rashis 
     * receiving the aspect of the benefic planets Guru and Buddha also get 
     * additional strength.
     * 
     * @return array
     */
    protected function balaDrishti()
    {
        $bala = [];
        foreach (Rashi::$rashi as $rKey => $rName) {
            $Rashi = Rashi::getInstance($rKey)->setEnvironment($this->Data);
            $ruler = $Rashi->rashiRuler;
            $rashiIsAspected = $Rashi->isAspectedByRashi()['graha'];
            $bala[$rKey] = 0;
            
            foreach ([$ruler, Graha::KEY_GU, Graha::KEY_BU] as $gKey) {
                if (
                    $this->getData()['graha'][$gKey]['rashi'] == $rKey || 
                    array_key_exists($gKey, $rashiIsAspected)
                ) {
                    $bala[$rKey] += 60;
                }
            }
        }
        return $bala;
    }

    /**
     * Get rashi bala.
     * 
     * @return array
     */
    public function getBala()
    {
        return $this->bala;
    }
}
