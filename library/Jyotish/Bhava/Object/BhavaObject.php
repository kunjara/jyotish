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
 * Parent class for bhava objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class BhavaObject extends \Jyotish\Base\Object {
    /**
     * Object type
     * 
     * @var string
     */
    protected $objectType = 'bhava';

    /**
     * Devanagari bhava title in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $bhavaTranslit;

    /**
     * Indications of bhava.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 11, Verse 2-13.
     */
    protected $bhavaKarakatva = array();

    /**
     * Purushartha of bhava.
     * 
     * @var string
     */
    protected $bhavaPurushartha;

    /**
     * Get bhava ruler (lord).
     * 
     * @return string
     */
    public function getRuler()
    {
        $this->checkEnvironment();

        $rashi = $this->ganitaData['bhava'][$this->objectKey]['rashi'];
        $Rashi = Rashi::getInstance((int)$rashi);
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
       $this->checkEnvironment();

       $mitraBhava = [-4, -3, -2, 1, 2, 3];
       foreach ($mitraBhava as $distance){
           $rashi = Math::numberInCycle($this->objectRashi, $distance);
           $mitraRashi[$rashi] = $distance;
       }
       
       $listOption = $withoutChaya ? Graha::LIST_SAPTA : Graha::LIST_NAVA;
       $grahas = Graha::grahaList($listOption);
       
       foreach ($grahas as $key => $name){
           $rashi = $this->ganitaData['graha'][$key]['rashi'];
           if(array_key_exists($rashi, $mitraRashi)){
               $mitraGraha[$key] = $mitraRashi[$rashi];
           }
       }
       return $mitraGraha;
   }

    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        parent::__construct($options);
    }
}
