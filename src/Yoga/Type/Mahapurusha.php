<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Yoga;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;

/**
 * Pancha Mahapurusha yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Mahapurusha extends YogaBase
{
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
    public static $yoga = [
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
    public function hasRuchaka()
    {
        return $this->hasMahapurusha(Graha::KEY_MA);
    }

    /**
     * One of the Pancha Mahapurusha Yogas, it occurs when Buddha is in a 
     * quadrant (Kendra) in either Gemini or Virgo.
     * 
     * @return bool
     */
    public function hasBhadra()
    {
        return $this->hasMahapurusha(Graha::KEY_BU);
    }
    
    /**
     * One of the Pancha Mahapurusha Yogas which occur when Guru is in its own 
     * signs or exalted and in a quadrant.
     * 
     * @return bool
     */
    public function hasHamsa()
    {
        return $this->hasMahapurusha(Graha::KEY_GU);
    }
    
    /**
     * One of Pancha Mahapurusha Yogas, occuring when Shukra is in a quadrant 
     * (Kendra) and in its own house ie Taurus, Libra or is exalted in Pisces.
     * 
     * @return bool
     */
    public function hasMalavya()
    {
        return $this->hasMahapurusha(Graha::KEY_SK);
    }
    
    /**
     * One of five Mahapurusha Yogas caused by Shani being in its own or exalted 
     * house and in a quadrant (Kendra).
     * 
     * @return bool
     */
    public function hasShasha()
    {
        return $this->hasMahapurusha(Graha::KEY_SA);
    }
    
    /**
     * Is there Mahapurusha yoga for the graha.
     * 
     * @param string $key Key of graha.
     * @return bool
     * @throws Exception\InvalidArgumentException
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 75, Verse 1-2.
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 1.
     */
    public function hasMahapurusha($key)
    {
        $panchaGraha = Graha::listGraha(Graha::LIST_PANCHA);
        if (!array_key_exists($key, $panchaGraha)) {
            throw new \Jyotish\Yoga\Exception\InvalidArgumentException("For {$key} Mahapurusha yoga is not available.");
        }
        
        $Graha = Graha::getInstance($key);
        $Graha->setEnvironment($this->Data);
        
        $grahaBhava = $Graha->getBhava();
        $grahaAvastha = $Graha->getRashiAvastha();
        
        if (
            in_array($grahaBhava, Bhava::$bhavaKendra) && 
            in_array($grahaAvastha, [Rashi::GRAHA_UCHA, Rashi::GRAHA_MOOL, Rashi::GRAHA_SWA])
        ) {
            return true;
        } else {
            return false;
        }
    }
}
