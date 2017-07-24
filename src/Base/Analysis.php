<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Base\Data;
use Jyotish\Base\Biblio;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Varga\Varga;
use Jyotish\Tattva\Karaka;

/**
 * Main class for analysis of horoscopes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Analysis
{
    use \Jyotish\Base\Traits\DataTrait;

    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);
    }

    /**
     * Get chara karaka.
     * 
     * @param bool $reverse
     * @param string $system Jyotish system
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 32, Verse 13-17.
     * @see Maharishi Jaimini. Jaimini Upadesha Sutras. Chapter 1, Quarter 1, Verse 11-18
     */
    public function getCharaKaraka($reverse = false, $system = Biblio::AUTHOR_PARASHARA)
    {
        $grahas = $this->getData()['graha'];
        unset($grahas[Graha::KEY_KE]);
        switch ($system) {
            case Biblio::AUTHOR_JAIMINI:
            case Biblio::BOOK_US:
                unset($grahas[Graha::KEY_RA]);
                break;
            case Biblio::AUTHOR_PARASHARA:
            case Biblio::BOOK_BPHS:
            default:
                $grahas[Graha::KEY_RA]['degree'] = 30 - $grahas[Graha::KEY_RA]['degree'];
        }

        uasort($grahas, 
            function ($d1, $d2) {
                if ($d1['degree'] == $d2['degree']) {
                    return 0;
                } else {
                    return ($d1['degree'] < $d2['degree']) ? 1 : -1;
                }
            }
        );
        
        $karakas = Karaka::listKaraka($system);
        reset($karakas);
        
        $grahaKaraka = [];
        foreach ($grahas as $key => $data) {
            $grahaKaraka[$key] = current($karakas);
            next($karakas);
        }

        if ($reverse) {
            return array_flip($grahaKaraka);
        } else {
            return $grahaKaraka;
        }
    }

    /**
     * Get karakamsha.
     * 
     * @return int
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 33, Verse 1.
     */
    public function getKarakamsha()
    {
        $d9Data = $this->getVargaData('D9');
        $atmaKaraka = $this->getCharaKaraka(true)[Karaka::NAME_ATMA];

        return $d9Data['graha'][$atmaKaraka]['rashi'];
    }

    /**
     * Get lagnamsha.
     * 
     * @return int
     */
    public function getLagnamsha()
    {
        $d9Data = $this->getVargaData('D9');

        return $d9Data['lagna'][Graha::KEY_LG]['rashi'];
    }

    /**
     * Get varga data.
     * 
     * @param string $vargaKey Varga key
     * @return array
     */
    public function getVargaData($vargaKey)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        
        if ($vargaKeyUcf == Varga::KEY_D1) {
            if (!isset($this->getData()['graha'])) {
                $this->Data->calcParams();
            }
            $vargaData = $this->getData();
        } else {
            if (!isset($this->getData()['varga'][$vargaKeyUcf])) {
                $this->Data->calcVargaData([$vargaKeyUcf]);
            }
            $vargaData = $this->getData()['varga'][$vargaKeyUcf];
        }
        return $vargaData;
    }
    
    /**
     * Get rulers of bhavas.
     * 
     * @param array $bhavas
     * @param string $vargaKey Varga key (optional)
     * @return array
     */
    public function getBhavaRulers(array $bhavas, $vargaKey = Varga::KEY_D1)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        $data = $this->getVargaData($vargaKeyUcf);
        
        $rulers = [];
        foreach ($bhavas as $bhava) {
            $Rashi = Rashi::getInstance($data['bhava'][$bhava]['rashi']);
            $rulers[] = $Rashi->rashiRuler;
        }
        $rulers = array_unique($rulers);
        return $rulers;
    }
    
    /**
     * Get rashi in bhava.
     * 
     * @param string $vargaKey Varga key (optional)
     * @return array
     */
    public function getRashiInBhava($vargaKey = Varga::KEY_D1)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        $data = $this->getVargaData($vargaKeyUcf);
            
        if (!isset($this->temp['rashiInBhava'][$vargaKeyUcf])) {
            foreach ($data['bhava'] as $bhava => $params) {
                $rashi = $params['rashi'];
                $this->temp['rashiInBhava'][$vargaKeyUcf][$rashi] = $bhava;
            }
        }
        return $this->temp['rashiInBhava'][$vargaKeyUcf];
    }

    /**
     * Get bodies in bhava.
     * 
     * @param string $vargaKey Varga key (optional)
     * @return array
     */
    public function getBodyInBhava($vargaKey = Varga::KEY_D1)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        $data = $this->getVargaData($vargaKeyUcf);
        
        $bodyInBhava = [];
        foreach ([Data::BLOCK_GRAHA, Data::BLOCK_LAGNA, Data::BLOCK_UPAGRAHA] as $block) {
            if (!isset($data[$block])) continue;
            
            foreach ($data[$block] as $body => $params) {
                $rashi = $params['rashi'];
                $bhava = $this->getRashiInBhava($vargaKey)[$rashi];

                $bodyInBhava[$body] = $bhava;
            }
        }
        return $bodyInBhava;
    }

    /**
     * Get bodies in rashi.
     * 
     * @param string $vargaKey Varga key (optional)
     * @return array
     */
    public function getBodyInRashi($vargaKey = Varga::KEY_D1)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        $data = $this->getVargaData($vargaKeyUcf);
        
        $bodyInRashi = [];
        foreach ([Data::BLOCK_GRAHA, Data::BLOCK_LAGNA, Data::BLOCK_UPAGRAHA] as $block) {
            if (!isset($data[$block])) continue;
            
            foreach ($data[$block] as $body => $params) {
                $rashi = $params['rashi'];

                $bodyInRashi[$body] = $rashi;
            }
        }
        return $bodyInRashi;
    }
}
