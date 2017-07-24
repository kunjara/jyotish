<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Yoga;
use Jyotish\Graha\Graha;
use Jyotish\Bhava\Bhava;
use Jyotish\Base\Data;

/**
 * Dhana yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Dhana extends YogaBase
{
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_DHANA;
    
    /**
     * List of combinations.
     * 
     * @var array 
     */
    public static $yoga = [
        'SkInB5MaInB11',
        'BuInB5ChMaGuInB11',
        'SyInB5ChGuSaInB11',
        'SaInB5SyChInB11',
        'GuInB5BuInB11',
        'MaInB5SkInB11',
        'ChInB5SaInB11',
        
        'SyInLgPacMaGu',
        'ChInLgPacBuGu',
        'MaInLgPacBuSkSa',
        'BuInLgPacGuSa',
        'GuInLgPacMaBu',
        'SkInLgPacBuSa',
        'SaInLgPacMaGu',
    ];
    
    /**
     * Set Data
     * 
     * @param \Jyotish\Base\Data $Data
     * @return Dhana
     */
    public function setDataInstance(Data $Data)
    {
        $this->Data = $Data;
        
        $Lg = Bhava::getInstance(1)->setEnvironment($this->Data);
        
        $this->temp['lgAspect']   = $Lg->isAspectedByGraha();
        $this->temp['lgConjunct'] = $Lg->isConjuncted();
        
        return $this;
    }

    /**
     * Should a sign of Shukra be the 5th house and be occupied by Shukra himself 
     * while Mangal is in the 11th house.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 2.
     */
    public function hasSkInB5MaInB11()
    {
        if (
            ($this->getData()['bhava'][5]['rashi'] == 2 || $this->getData()['bhava'][5]['rashi'] == 7) &&
            $this->getData()['graha'][Graha::KEY_SK]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_MA]['rashi'] == $this->getData()['bhava'][11]['rashi'] 
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Should a sign of Buddha be the 5th house and be occupied by Buddha himself 
     * as the 11th house is occupied by the Chandra, Mangal and Guru.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 3.
     */
    public function hasBuInB5ChMaGuInB11()
    {
        if (
            ($this->getData()['bhava'][5]['rashi'] == 3 || $this->getData()['bhava'][5]['rashi'] == 6) &&
            $this->getData()['graha'][Graha::KEY_BU]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_CH]['rashi'] == $this->getData()['bhava'][11]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_MA]['rashi'] == $this->getData()['bhava'][11]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_GU]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should Leo be the 5th house and be occupied by the Surya himself as Chandra, 
     * Guru and Shani are in the 11th house.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 4.
     */
    public function hasSyInB5ChGuSaInB11()
    {
        if (
            $this->getData()['bhava'][5]['rashi'] == 5 &&
            $this->getData()['graha'][Graha::KEY_SY]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_CH]['rashi'] == $this->getData()['bhava'][11]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_GU]['rashi'] == $this->getData()['bhava'][11]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_SA]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should the Surya and Chandra be in the 11th as Shani is in the 5th identical 
     * with his own house.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 5.
     */
    public function hasSaInB5SyChInB11()
    {
        if (
            ($this->getData()['bhava'][5]['rashi'] == 10 || $this->getData()['bhava'][5]['rashi'] == 11) &&
            $this->getData()['graha'][Graha::KEY_SA]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_SY]['rashi'] == $this->getData()['bhava'][11]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_CH]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should Guru be in the 5th identical with his own house as Buddha is in 
     * the 11th house.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 6.
     */
    public function hasGuInB5BuInB11()
    {
        if (
            ($this->getData()['bhava'][5]['rashi'] == 9 || $this->getData()['bhava'][5]['rashi'] == 12) &&
            $this->getData()['graha'][Graha::KEY_GU]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_BU]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * A sign of Mangal be the 5th with Mangal therein as Shukra is in the 11th.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 7.
     */
    public function hasMaInB5SkInB11()
    {
        if (
            ($this->getData()['bhava'][5]['rashi'] == 1 || $this->getData()['bhava'][5]['rashi'] == 8) &&
            $this->getData()['graha'][Graha::KEY_MA]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_SK]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * If Cancer be the 5th house containing the Chandra therein  as Shani is in 
     * the 11th.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 8.
     */
    public function hasChInB5SaInB11()
    {
        if (
            $this->getData()['bhava'][5]['rashi'] == 4 &&
            $this->getData()['graha'][Graha::KEY_CH]['rashi'] == $this->getData()['bhava'][5]['rashi'] &&
            $this->getData()['graha'][Graha::KEY_SA]['rashi'] == $this->getData()['bhava'][11]['rashi']
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should the Surya be in Leo identical with the lagna and be conjunct or 
     * aspected by Mangal and Guru.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 9.
     */
    public function hasSyInLgPacMaGu()
    {
        if (
            $this->getData()['bhava'][1]['rashi'] == 5 &&
            $this->getData()['graha'][Graha::KEY_SY]['rashi'] == 5 &&
            ($this->temp['lgAspect'][Graha::KEY_MA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_MA])) &&
            ($this->temp['lgAspect'][Graha::KEY_GU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_GU]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should the Chandra be in Cancer identical with lagna and be conjunct or
     * aspected by Buddha and Guru.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 10.
     */
    public function hasChInLgPacBuGu()
    {
        if (
            $this->getData()['bhava'][1]['rashi'] == 4 &&
            $this->getData()['graha'][Graha::KEY_CH]['rashi'] == 4 &&
            ($this->temp['lgAspect'][Graha::KEY_MA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_MA])) &&
            ($this->temp['lgAspect'][Graha::KEY_GU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_GU]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should Mangal be in the lagna identical with his own sign and be conjunct 
     * or aspected by Buddha, Shukra and Shani.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 11.
     */
    public function hasMaInLgPacBuSkSa()
    {
        if (
            ($this->getData()['bhava'][1]['rashi'] == 1 || $this->getData()['bhava'][1]['rashi'] == 8) &&
            ($this->getData()['graha'][Graha::KEY_MA]['rashi'] == 1 || $this->getData()['graha'][Graha::KEY_MA]['rashi'] == 8) &&
            ($this->temp['lgAspect'][Graha::KEY_BU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_BU])) &&
            ($this->temp['lgAspect'][Graha::KEY_SK] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_SK])) &&
            ($this->temp['lgAspect'][Graha::KEY_SA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_SA]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should Buddha's sign ascend with Buddha therein and be conjunct or 
     * aspected by Guru and Shani.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 12.
     */
    public function hasBuInLgPacGuSa()
    {
        if (
            ($this->getData()['bhava'][1]['rashi'] == 3 || $this->getData()['bhava'][1]['rashi'] == 6) &&
            ($this->getData()['graha'][Graha::KEY_BU]['rashi'] == 3 || $this->getData()['graha'][Graha::KEY_BU]['rashi'] == 6) &&
            ($this->temp['lgAspect'][Graha::KEY_GU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_GU])) &&
            ($this->temp['lgAspect'][Graha::KEY_SA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_SA]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Should Guru be in the lagna identical with his own sign and be conjunct or
     * aspected by Mangal and Buddha.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 13.
     */
    public function hasGuInLgPacMaBu()
    {
        if (
            ($this->getData()['bhava'][1]['rashi'] == 9 || $this->getData()['bhava'][1]['rashi'] == 12) &&
            ($this->getData()['graha'][Graha::KEY_GU]['rashi'] == 9 || $this->getData()['graha'][Graha::KEY_GU]['rashi'] == 12) &&
            ($this->temp['lgAspect'][Graha::KEY_MA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_MA])) &&
            ($this->temp['lgAspect'][Graha::KEY_BU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_BU]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * If Shukra be in the lagna identical with his own sign and be conjunct or
     * aspected by Buddha and Shani.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 14.
     */
    public function hasSkInLgPacBuSa()
    {
        if (
            ($this->getData()['bhava'][1]['rashi'] == 2 || $this->getData()['bhava'][1]['rashi'] == 7) &&
            ($this->getData()['graha'][Graha::KEY_SK]['rashi'] == 2 || $this->getData()['graha'][Graha::KEY_SK]['rashi'] == 7) &&
            ($this->temp['lgAspect'][Graha::KEY_BU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_BU])) &&
            ($this->temp['lgAspect'][Graha::KEY_SA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_SA]))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * If Shani is in his own sign identical with lagna be aspected by or conjunct 
     * Mangal and Guru.
     * 
     * @return bool
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 15.
     */
    public function hasSaInLgPacMaGu()
    {
        if (
            ($this->getData()['bhava'][1]['rashi'] == 10 || $this->getData()['bhava'][1]['rashi'] == 11) &&
            ($this->getData()['graha'][Graha::KEY_SA]['rashi'] == 10 || $this->getData()['graha'][Graha::KEY_SA]['rashi'] == 11) &&
            ($this->temp['lgAspect'][Graha::KEY_MA] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_MA])) &&
            ($this->temp['lgAspect'][Graha::KEY_GU] == 1 || isset($this->temp['lgConjunct'][Graha::KEY_GU]))
        ) {
            return true;
        } else {
            return false;
        }
    }
}
