<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bala;

use Jyotish\Base\Biblio;
use Jyotish\Base\Analysis;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;
use Jyotish\Ganita\Math;

/**
 * Class for calculation graha bala.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaBala extends Analysis
{
    const VARGA_MULATRIKONADI = 'mulatrikonadi';
    const VARGA_AMSHA = 'amsha';
    const VARGA_KENDRADI = 'kendradi';
    
    /**
     * The values of bala.
     * 
     * @var array
     */
    protected $bala = [];
    
    /**
     * Graha list.
     * 
     * @var array
     */
    protected $balaGraha = [];

    /**
     * Bala components.
     * 
     * @var array
     */
    protected $balaVarga = [
        self::VARGA_MULATRIKONADI,
        self::VARGA_AMSHA,
        self::VARGA_KENDRADI,
    ];
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        parent::__construct($Data);
        $this->balaGraha = Graha::listGraha(Graha::LIST_SAPTA);
        
        $this->bala['total'] = [];
        foreach ($this->balaVarga as $varga) {
            $balaVarga = 'bala'.ucfirst($varga);
            $this->bala[$varga] = $this->$balaVarga();
            $this->bala['total'] = Math::arraySum($this->bala[$varga], $this->bala['total']);
        }
    }

    /**
     * This kind of strength is based on the planets placed in different houses 
     * in the chart.
     * 
     * @return array
     */
    protected function balaMulatrikonadi()
    {
        $bala = [];
        foreach ($this->balaGraha as $key => $name) {
            $Graha = Graha::getInstance($key)->setEnvironment($this->Data);
            $rashiAvastha = $Graha->getRashiAvastha();
            
            switch ($rashiAvastha) {
                case Rashi::GRAHA_UCHA:
                    $bala[$key] = 70;
                    break;
                case Rashi::GRAHA_MOOL:
                    $bala[$key] = 60;
                    break;
                case Rashi::GRAHA_SWA:
                    $bala[$key] = 50;
                    break;
                case Rashi::GRAHA_FRIEND:
                    $bala[$key] = 40;
                    break;
                case Rashi::GRAHA_NEUTRAL:
                    $bala[$key] = 30;
                    break;
                case Rashi::GRAHA_ENEMY:
                    $bala[$key] = 20;
                    break;
                case Rashi::GRAHA_NEECHA:
                    $bala[$key] = 10;
            }
        }
        return $bala;
    }
    
    /**
     * This kind of strength is based on chara karakas according to their degrees 
     * in the descending order.
     * 
     * @return array
     */
    protected function balaAmsha()
    {
        $charaKaraka = $this->getCharaKaraka(false, Biblio::AUTHOR_JAIMINI);
        $this->temp['atmaKaraka'] = array_search(\Jyotish\Tattva\Karaka::NAME_ATMA, $charaKaraka);
        $value = 70;
        
        $bala = [];
        foreach ($charaKaraka as $key => $karaka) {
            $bala[$key] = $value;
            $value -= 10;
        }
        return $bala;
    }
    
    /**
     * From atmakaraka, the planets placed in kendras get 60 units each and planets 
     * placed in panapharas get 40 units each and planets placed in apoklimas get 
     * 20 points each.
     * 
     * @return array
     */
    protected function balaKendradi()
    {
        $bala = [];
        foreach ($this->balaGraha as $key => $name) {
            $distance = Math::distanceInCycle(
                $this->getData()['graha'][$this->temp['atmaKaraka']]['rashi'], 
                $this->getData()['graha'][$key]['rashi']
            );
            
            if (in_array($distance, Bhava::$bhavaKendra)) {
                $bala[$key] = 60;
            } elseif (in_array($distance, Bhava::$bhavaPanaphara)) {
                $bala[$key] = 40;
            } else {
                $bala[$key] = 20;
            }
        }
        return $bala;
    }
    
    /**
     * Get graha bala.
     * 
     * @return array
     */
    public function getBala()
    {
        return $this->bala;
    }
}
