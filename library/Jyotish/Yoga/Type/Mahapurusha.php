<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;
use Jyotish\Yoga\Yoga;

/**
 * Pancha Mahapurusha yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Mahapurusha extends YogaBase {
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_MAHAPURUSHA;
    
    /**
     * Combinations list.
     * 
     * @var array 
     */
    protected $yogas = [
        'Ruchaka',
        'Bhadra',
        'Hamsa',
        'Malavya',
        'Shasha'
    ];
    
    /**
     * One of the Mahapurusha Yogas, it happens when Mangal is exalted or in own 
     * sign, identical with a quadrant (Kendra).
     * 
     * @return bool
     */
    public function yogaRuchaka()
    {
        return $this->yogaGraha(Graha::KEY_MA);
    }

    /**
     * One of the Pancha Mahapurusha Yogas, it occurs when Buddha is in a 
     * quadrant (Kendra) in either Gemini or Virgo.
     * 
     * @return bool
     */
    public function yogaBhadra()
    {
        return $this->yogaGraha(Graha::KEY_BU);
    }
    
    /**
     * One of the Pancha Mahapurusha Yogas which occur when Guru is in its own 
     * signs or exalted and in a quadrant.
     * 
     * @return bool
     */
    public function yogaHamsa()
    {
        return $this->yogaGraha(Graha::KEY_GU);
    }
    
    /**
     * One of Pancha Mahapurusha Yogas, occuring when Shukra is in a quadrant 
     * (Kendra) and in its own house ie Taurus, Libra or is exalted in Pisces.
     * 
     * @return bool
     */
    public function yogaMalavya()
    {
        return $this->yogaGraha(Graha::KEY_SK);
    }
    
    /**
     * One of five Mahapurusha Yogas caused by Shani being in its own or exalted 
     * house and in a quadrant (Kendra).
     * 
     * @return bool
     */
    public function yogaShasha()
    {
        return $this->yogaGraha(Graha::KEY_SA);
    }
    
    /**
     * Is there Mahapurush yoga for the graha.
     * 
     * @param string $key Key of graha.
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 75, Verse 1-2.
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 1.
     */
    private function yogaGraha($key)
    {
        $Graha = Graha::getInstance($key);
        $Graha->setEnvironment($this->ganitaData);
        
        $grahaBhava = $Graha->getBhava();
        $grahaAvastha = $Graha->getRashiAvastha();
        
        if(
            in_array($grahaBhava, Bhava::$bhavaKendra) and 
            in_array($grahaAvastha, [Rashi::GRAHA_UCHA, Rashi::GRAHA_MOOL, Rashi::GRAHA_SWA])
        ){
            return true;
        }else{
            return false;
        }
    }
}
