<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava\Object;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * Bhava environment trait.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait BhavaEnvironment {
    
    use \Jyotish\Base\Traits\EnvironmentTrait;
    
    /**
     * Get bhava ruler (lord).
     * 
     * @return string
     */
    public function getRuler()
    {
        $rashi = $this->getEnvironment()['bhava'][$this->objectKey]['rashi'];
        $Rashi = Rashi::getInstance((int) $rashi);
        $ruler = $Rashi->rashiRuler;

        return $ruler;
    }
    
    /**
    * Get tatkalika mitra. Planets 3 houses away on either sides adjacent to it 
    * are its tatkalika mitra (temporary friend) and render considerable strength.
    * 
    * @return array
    */
   public function getTatkalikaMitra($withoutChaya = true)
   {
       $mitraBhava = [-4, -3, -2, 1, 2, 3];
       $listOption = $withoutChaya ? Graha::LIST_SAPTA : Graha::LIST_NAVA;
       $grahas = Graha::listGraha($listOption);
       
       $mitraRashi = [];
       foreach ($mitraBhava as $distance) {
           $rashi = Math::numberInCycle($this->objectRashi, $distance);
           $mitraRashi[$rashi] = $distance;
       }
       
       $mitraGraha = [];
       foreach ($grahas as $key => $name) {
           $rashi = $this->getEnvironment()['graha'][$key]['rashi'];
           if (array_key_exists($rashi, $mitraRashi)) {
               $mitraGraha[$key] = $mitraRashi[$rashi];
           }
       }
       return $mitraGraha;
   }
    
}
