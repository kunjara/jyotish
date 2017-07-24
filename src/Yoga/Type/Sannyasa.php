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
 * Sannyasa yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Sannyasa extends YogaBase
{
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_SANNYASA;
    
    /**
     * List of combinations.
     * 
     * @var array 
     */
    public static $yoga = [
        'L10C4GrInKnTr',
        'LgEndPBenGuInKnTr',
        'ChInD3SaAMaSa',
        'ChInD9MaASa',
    ];
    
    /**
     * How many degrees is considered to be the end of the lagna.
     * 
     * @var int
     */
    protected $optionLagnaEnd = 25;

    /**
     * Set Data
     * 
     * @param \Jyotish\Base\Data $Data
     * @return Sannyasa
     */
    public function setDataInstance(Data $Data)
    {
        $this->Data = $Data;
        
        $this->temp['kendraAndTrikona'] = array_unique(
            array_merge(
                Bhava::$bhavaKendra, 
                Bhava::$bhavaTrikona
            )
        );
        
        $Ch = Graha::getInstance(Graha::KEY_CH)->setEnvironment($this->Data);
        $this->temp['chIsAspected'] = $Ch->isAspectedByGraha();
        
        return $this;
    }

    /**
     * Lord of 10th house combined with 4 planets in Kendra/Trikona.
     * 
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 27, Verse 1.
     */
    public function hasL10C4GrInKnTr()
    {
        $B10 = Bhava::getInstance(10)->setEnvironment($this->Data);
        $r10 = $B10->getRuler();
        $R10 = Graha::getInstance($r10)->setEnvironment($this->Data);
        
        $r10Bhava = $R10->getBhava();
        $r10Rashi = $this->getData()[Data::BLOCK_GRAHA][$r10]['rashi'];
        
        if (in_array($r10Bhava, $this->temp['kendraAndTrikona'])) {
            $inKendraTrikona[] = $r10;
            foreach (Graha::$graha as $grahaKey => $grahaName) {
                if ($grahaKey == $r10) continue;
                
                if ($r10Rashi == $this->getData()[Data::BLOCK_GRAHA][$grahaKey]['rashi']) {
                    $inKendraTrikona[] = $grahaKey;
                }
            }
            return count($inKendraTrikona) >= 5 ? true : false;
        } else {
            return false;
        }
    }
    
    /**
     * Lagna at the end of a sign with a benefic in it and Jupiter in a 
     * Kendra/Trikona.
     * 
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 27, Verse 1.
     */
    public function hasLgEndPBenGuInKnTr()
    {
        $lagnaDegree = $this->getData()[Data::BLOCK_LAGNA]['Lg']['degree'];
        $lagnaRashi  = $this->getData()[Data::BLOCK_LAGNA]['Lg']['rashi'];
        
        if($lagnaDegree < $this->optionLagnaEnd) {
            return false;
        }
        
        $Gu = Graha::getInstance(Graha::KEY_GU)->setEnvironment($this->Data);
        $guBhava = $Gu->getBhava();
        $isGuInKendraTrikona = in_array($guBhava, $this->temp['kendraAndTrikona']) ? true : false;

        $hasYoga = false;
        if ($guBhava == 1) {
            $hasYoga = true;
        } elseif ($isGuInKendraTrikona) {
            foreach (Graha::$graha as $grahaKey => $grahaName) {
                if ($grahaKey == Graha::KEY_GU) continue;

                $Graha = Graha::getInstance($grahaKey)->setEnvironment($this->Data);
                $grahaChracter = $Graha->grahaCharacter;
                if ($grahaChracter == Graha::CHARACTER_SHUBHA) {
                    $grahaRashi = $this->getData()[Data::BLOCK_GRAHA][$grahaKey]['rashi'];
                    if ($grahaRashi == $lagnaRashi) {
                        $hasYoga = true;
                        break;
                    }
                }
            }
        }
        return $hasYoga;
    }
    
    /**
     * Moon posited in a Decanate owned by Saturn and aspected by Mars and Saturn.
     * 
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 27, Verse 3.
     */
    public function hasChInD3SaAMaSa()
    {
        $hasYoga = false;
        if (
            $this->temp['chIsAspected'][Graha::KEY_MA] == 1 &&
            $this->temp['chIsAspected'][Graha::KEY_SA] == 1
        ) {
            $this->Data->calcVargaData(['D3']);
            $vargaDataD3 = $this->getData()[Data::BLOCK_VARGA]['D3'];
            $chRashiD3 = $vargaDataD3[Data::BLOCK_GRAHA][Graha::KEY_CH]['rashi'];
            if ($chRashiD3 == 10 || $chRashiD3 == 11) {
                $hasYoga = true;
            }
        }
        return $hasYoga;
    }
    
    /**
     * Moon occupy a Navamsha owned by Mars and be aspected by Saturn.
     * 
     * @return bool
     * @see Mantreswara. Phaladeepika. Chapter 27, Verse 3.
     */
    public function hasChInD9MaASa()
    {
        $hasYoga = false;
        if ($this->temp['chIsAspected'][Graha::KEY_SA] == 1) {
            $this->Data->calcVargaData(['D9']);
            $vargaDataD9 = $this->getData()[Data::BLOCK_VARGA]['D9'];
            $chRashiD9 = $vargaDataD9[Data::BLOCK_GRAHA][Graha::KEY_CH]['rashi'];
            if ($chRashiD9 == 1 || $chRashiD9 == 8) {
                $hasYoga = true;
            }
        }
        return $hasYoga;
    }
}