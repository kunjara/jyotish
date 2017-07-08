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
use Jyotish\Base\Analysis;

/**
 * Nabhasha yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Nabhasha extends YogaBase
{
    const GROUP_ASHRAYA = 'ashraya';
    const GROUP_DALA = 'dala';
    const GROUP_AKRITI = 'akriti';
    const GROUP_SANKHYA = 'sankhya';
    
    const NAME_RAJJU = 'Rajju';
    const NAME_MUSALA = 'Musala';
    const NAME_NALA = 'Nala';
    const NAME_MALA = 'Mala';
    const NAME_SARPA = 'Sarpa';
    const NAME_GADA = 'Gada';
    const NAME_SANAHA = 'Sanaha';
    const NAME_VIBHUKA = 'Vibhuka';
    const NAME_DHURIYA = 'Dhuriya';
    
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_NABHASHA;
    
    /**
     * List of combinations.
     * 
     * @var array 
     */
    public static $yoga = [
        self::NAME_RAJJU,
        self::NAME_MUSALA,
        self::NAME_NALA,
        self::NAME_MALA,
        self::NAME_SARPA,
        self::NAME_GADA,
        self::NAME_SANAHA,
        self::NAME_VIBHUKA,
        self::NAME_DHURIYA,
    ];
    
    /**
     * Bhavas of akriti yoga.
     * 
     * @var array
     */
    private $akritiBhava = [
        self::NAME_GADA => [1, 4],
        self::NAME_SANAHA => [4, 7],
        self::NAME_VIBHUKA => [7, 10],
        self::NAME_DHURIYA => [10, 1],
    ];
    
    /**
     * Rajju, Musala and Nala yogas.
     * 
     * @param string $ashrayaName Name of ashraya yoga
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 7.
     */
    public function hasAshraya($ashrayaName)
    {
        if ($ashrayaName == self::NAME_RAJJU) {
            $rashiBhava = Rashi::BHAVA_CHARA;
        } elseif ($ashrayaName == self::NAME_MUSALA) {
            $rashiBhava = Rashi::BHAVA_STHIRA;
        } else {
            $rashiBhava = Rashi::BHAVA_DVISVA;
        }
        
        $rashis = array_keys(Rashi::listRashiByFeature('bhava', $rashiBhava));
        $grahas = $this->getData()['graha'];
        
        foreach ($grahas as $key => $data) {
            if (in_array($data['rashi'], $rashis)) {
                continue;
            } else {
                return false;
            }
        }
        $yogaData = $this->assignYoga($ashrayaName, self::GROUP_ASHRAYA);
        return [$yogaData];
    }
    
    /**
     * All the grahas in movable rashis cause Rajju yoga.
     * 
     * @return bool|array
     */
    public function hasRajju()
    {
        return $this->hasAshraya(self::NAME_RAJJU);
    }
    
    /**
     * All the grahas in fixed rashis cause Musala yoga.
     * 
     * @return bool|array
     */
    public function hasMusala()
    {
        return $this->hasAshraya(self::NAME_MUSALA);
    }
    
    /**
     * All the grahas in dual rashis cause Nala yoga.
     * 
     * @return bool|array
     */
    public function hasNala()
    {
        return $this->hasAshraya(self::NAME_NALA);
    }
    
    /**
     * Mala and Sarpa yogas.
     * 
     * @param string $dalaName
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 8.
     */
    public function hasDala($dalaName)
    {
        $kendras = Bhava::$bhavaKendra;
        $grahaShubha = Graha::listGrahaByFeature('character', Graha::CHARACTER_SHUBHA);
        unset($grahaShubha[Graha::KEY_CH]);
        $grahaPapa = Graha::listGrahaByFeature('character', Graha::CHARACTER_PAPA);
        unset($grahaPapa[Graha::KEY_RA], $grahaPapa[Graha::KEY_KE]);
        
        $Analysis = new Analysis($this->Data);
        $grahaInBhava = $Analysis->getBodyInBhava();
        
        $grahaShubhaInBhava = array_intersect_key($grahaInBhava, $grahaShubha);
        $grahaPapaInBhava = array_intersect_key($grahaInBhava, $grahaPapa);

        $bhavaShubhaInKendra = array_intersect($grahaShubhaInBhava, $kendras);
        $bhavaPapaInKendra = array_intersect($grahaPapaInBhava, $kendras);
        
        if ($dalaName == self::NAME_MALA) {
            if (count($bhavaShubhaInKendra) == 3 && count($bhavaPapaInKendra) == 0) {
                $yogaData = $this->assignYoga($dalaName, self::GROUP_DALA);
                return [$yogaData];
            }
        } elseif ($dalaName == self::NAME_SARPA) {
            if (count($bhavaShubhaInKendra) == 0 && count($bhavaPapaInKendra) == 3) {
                $yogaData = $this->assignYoga($dalaName, self::GROUP_DALA);
                return [$yogaData];
            }
        }
        return false;
    }
    
    /**
     * If kendras are occupied by benefics, Mala yoga is produced.
     * 
     * @return bool|array
     */
    public function hasMala()
    {
        return $this->hasDala(self::NAME_MALA);
    }
    
    /**
     * If kendras are occupied by malefics, Sarpa yoga is produced.
     * 
     * @return bool|array
     */
    public function hasSarpa()
    {
        return $this->hasDala(self::NAME_SARPA);
    }
    
    /**
     * If all the Grahas occupy two successive kendras, Gada kind yoga is formed.
     * 
     * @param string $akritiName
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 9-11.
     */
    public function hasAkriti($akritiName)
    {
        $grahas = $this->getData()['graha'];
        unset($grahas[Graha::KEY_RA], $grahas[Graha::KEY_KE]);
        
        $bhavas = $this->getData()['bhava'];
        $akritiRashi = [];
        foreach ($this->akritiBhava[$akritiName] as $bhavaKey) {
            $akritiRashi[] = $bhavas[$bhavaKey]['rashi'];
        }
        
        foreach ($grahas as $key => $grahaData) {
            if (in_array($grahaData['rashi'], $akritiRashi)) {
                continue;
            } else {
                return false;
            }
        }
        $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
        return [$yogaData];
    }
    
    /**
     * If all the Grahas occupy 1 and 4 kendras, Gada yoga is formed.
     * 
     * @return bool|array
     */
    public function hasGada()
    {
        return $this->hasAkriti(self::NAME_GADA);
    }
    
    /**
     * If all the Grahas occupy 4 and 7 kendras, Sanaha yoga is formed.
     * 
     * @return bool|array
     */
    public function hasSanaha()
    {
        return $this->hasAkriti(self::NAME_SANAHA);
    }
    
    /**
     * If all the Grahas occupy 7 and 10 kendras, Vibhuka yoga is formed.
     * 
     * @return bool|array
     */
    public function hasVibhuka()
    {
        return $this->hasAkriti(self::NAME_VIBHUKA);
    }
    
    /**
     * If all the Grahas occupy 10 and 1 kendras, Dhuriya yoga is formed.
     * 
     * @return bool|array
     */
    public function hasDhuriya()
    {
        return $this->hasAkriti(self::NAME_DHURIYA);
    }

    /**
     * Get list of yogas.
     * 
     * @param string $option The option to list yogas.
     * @return array List of yogas.
     */
    public static function listYoga($option = null)
    {
        $list = [];
        switch ($option) {
            case self::GROUP_ASHRAYA:
                $list = array_slice(self::$yoga, 0, 3);
                break;
            case self::GROUP_DALA:
                $list = array_slice(self::$yoga, 3, 2);
                break;
            case self::GROUP_AKRITI:
                $list = array_slice(self::$yoga, 5);
                break;
            default:
                $list = self::$yoga;
        }
        return $list;
    }
}
