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
    const NAME_SAKATA = 'Sakata';
    const NAME_VIHAGA = 'Vihaga';
    const NAME_SHRINGATAKA = 'Shringataka';
    const NAME_HALA = 'Hala';
    const NAME_VAJRA = 'Vajra';
    const NAME_YAVA = 'Yava';
    const NAME_KAMALA = 'Kamala';
    const NAME_VAPI = 'Vapi';
    const NAME_YUPA = 'Yupa';
    const NAME_ISHU = 'Ishu';
    const NAME_SHAKTI = 'Shakti';
    const NAME_DANDA = 'Danda';
    
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
        self::NAME_SAKATA,
        self::NAME_VIHAGA,
        self::NAME_SHRINGATAKA,
        self::NAME_HALA,
        self::NAME_VAJRA,
        self::NAME_YAVA,
        self::NAME_KAMALA,
        self::NAME_VAPI,
        self::NAME_YUPA,
        self::NAME_ISHU,
        self::NAME_SHAKTI,
        self::NAME_DANDA,
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
        self::NAME_SAKATA => [1, 7],
        self::NAME_VIHAGA => [4, 10],
        self::NAME_SHRINGATAKA => [1, 5, 9],
        self::NAME_KAMALA => [1, 4, 7, 10],
        self::NAME_HALA => [[2, 6, 10], [3, 7, 11], [4, 8, 12]],
        self::NAME_VAPI => [[3, 6, 9, 12], [2, 5, 8, 11]],
        self::NAME_YUPA => [1, 2, 3, 4],
        self::NAME_ISHU => [4, 5, 6, 7],
        self::NAME_SHAKTI => [7, 8, 9, 10],
        self::NAME_DANDA => [10, 11, 12, 1],
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

        $grahaShubhaInKendra = array_intersect($grahaShubhaInBhava, $kendras);
        $grahaPapaInKendra = array_intersect($grahaPapaInBhava, $kendras);
        
        if ($dalaName == self::NAME_MALA) {
            if (count($grahaShubhaInKendra) == 3 && count($grahaPapaInKendra) == 0) {
                $yogaData = $this->assignYoga($dalaName, self::GROUP_DALA);
                return [$yogaData];
            }
        } elseif ($dalaName == self::NAME_SARPA) {
            if (count($grahaShubhaInKendra) == 0 && count($grahaPapaInKendra) == 3) {
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
     * If all the grahas occupy two successive kendras, Gada kind yoga is formed.
     * 
     * @param string $akritiName
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 9-11.
     */
    public function hasAkriti($akritiName)
    {
        $grahas = $this->getData()['graha'];
        unset($grahas[Graha::KEY_RA], $grahas[Graha::KEY_KE]);
        
        switch ($akritiName) {
            case self::NAME_HALA:
            case self::NAME_VAPI:
                return $this->hasHalaVapi($akritiName);
            case self::NAME_VAJRA:
            case self::NAME_YAVA:
                return $this->hasVajraYava($akritiName);
            default:
                if (!isset($this->akritiBhava[$akritiName])) return false;
                
                $akritiRashi = [];
                foreach ($this->akritiBhava[$akritiName] as $bhavaKey) {
                    $akritiRashi[$bhavaKey] = $this->getData()['bhava'][$bhavaKey]['rashi'];
                }
                
                $grahaRashi = [];
                foreach ($grahas as $key => $grahaData) {
                    if (in_array($grahaData['rashi'], $akritiRashi)) {
                        $grahaRashi[] = $grahaData['rashi'];
                        continue;
                    } else {
                        return false;
                    }
                }
        }
        
        $grahaRashiUnique = array_unique($grahaRashi);
        if (count($grahaRashiUnique) != count($this->akritiBhava[$akritiName])) {
            return false;
        }
        
        $akritiBhava = implode(',', array_keys($akritiRashi));
        $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI, ['bhava' => $akritiBhava]);
        return [$yogaData];
    }
    
    /**
     * If all the grahas occupy 1 and 4 kendras, Gada yoga is formed.
     * 
     * @return bool|array
     */
    public function hasGada()
    {
        return $this->hasAkriti(self::NAME_GADA);
    }
    
    /**
     * If all the grahas occupy 4 and 7 kendras, Sanaha yoga is formed.
     * 
     * @return bool|array
     */
    public function hasSanaha()
    {
        return $this->hasAkriti(self::NAME_SANAHA);
    }
    
    /**
     * If all the grahas occupy 7 and 10 kendras, Vibhuka yoga is formed.
     * 
     * @return bool|array
     */
    public function hasVibhuka()
    {
        return $this->hasAkriti(self::NAME_VIBHUKA);
    }
    
    /**
     * If all the grahas occupy 10 and 1 kendras, Dhuriya yoga is formed.
     * 
     * @return bool|array
     */
    public function hasDhuriya()
    {
        return $this->hasAkriti(self::NAME_DHURIYA);
    }
    
    /**
     * If all the grahas occupy 1 and 7 kendras, Sakata yoga is formed.
     * 
     * @return bool|array
     */
    public function hasSakata()
    {
        return $this->hasAkriti(self::NAME_SAKATA);
    }
    
    /**
     * If all the grahas occupy 4 and 10 kendras, Vihaga yoga is formed.
     * 
     * @return bool|array
     */
    public function hasVihaga()
    {
        return $this->hasAkriti(self::NAME_VIHAGA);
    }
    
    /**
     * If all the grahas occupy trikona bhavas, Vihaga yoga is formed.
     * 
     * @return bool|array
     */
    public function hasShringataka()
    {
        return $this->hasAkriti(self::NAME_SHRINGATAKA);
    }
    
    /**
     * All grahas are in the 2nd, 6th and l0th or in the 3rd, 7th and llth or 
     * in the 4th, 8th and l2th, Hala yoga  is formed.
     * 
     * @return bool|array
     */
    public function hasHala()
    {
        return $this->hasHalaVapi(self::NAME_HALA);
    }
    
    /**
     * Vajra yoga is caused by all benefics in the lagna and the 7th or 
     * all malefics in the 4th and l0th.
     * 
     * @return bool|array
     */
    public function hasVajra()
    {
        return $this->hasVajraYava(self::NAME_VAJRA);
    }
    
    /**
     * Yava yoga is caused by all benefics in the 4th and l0th or 
     * all malefics in the lagna and the 7th.
     * 
     * @return bool|array
     */
    public function hasYava()
    {
        return $this->hasVajraYava(self::NAME_YAVA);
    }
    
    /**
     * If all the grahas are in the 4 kendras, Kamala yoga is produced.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 12.
     */
    public function hasKamala()
    {
        return $this->hasAkriti(self::NAME_KAMALA);
    }
    
    /**
     * If all the grahas are in all the Apoklimas or in all the Panapharas, 
     * Vapi yoga occurs.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 12.
     */
    public function hasVapi()
    {
        return $this->hasHalaVapi(self::NAME_VAPI);
    }
    
    /**
     * If all the 7 grahas are in the 4 bhavas, commencing from Lagna, they cause 
     * Yupa yoga.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 13.
     */
    public function hasYupa()
    {
        return $this->hasAkriti(self::NAME_YUPA);
    }
    
    /**
     * If all the 7 grahas are in the 4 bhavas, commencing from 4th, they cause 
     * Ishu yoga.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 13.
     */
    public function hasIshu()
    {
        return $this->hasAkriti(self::NAME_ISHU);
    }
    
    /**
     * If all the 7 grahas are in the 4 bhavas, commencing from 7th, they cause 
     * Shakti yoga.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 13.
     */
    public function hasShakti()
    {
        return $this->hasAkriti(self::NAME_SHAKTI);
    }
    
    /**
     * If all the 7 grahas are in the 4 bhavas, commencing from 10th, they cause 
     * Danda yoga.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 13.
     */
    public function hasDanda()
    {
        return $this->hasAkriti(self::NAME_DANDA);
    }
    
    /**
     * Hala and Vapi yogas.
     * 
     * @param string $akritiName
     * @return bool|array
     */
    private function hasHalaVapi($akritiName)
    {
        $grahas = $this->getData()['graha'];
        unset($grahas[Graha::KEY_RA], $grahas[Graha::KEY_KE]);
        
        $akritiBhava = $this->akritiBhava[$akritiName];
        $akritiRashi = [];
        
        foreach ($akritiBhava as $index => $bhava) {
            foreach ($bhava as $bhavaKey) {
                $akritiRashi[$index][] = $this->getData()['bhava'][$bhavaKey]['rashi'];
            }
        }
        
        $no = 0;
        foreach ($akritiRashi as $index => $rashi) {
            foreach ($grahas as $key => $grahaData) {
                if (in_array($grahaData['rashi'], $rashi)) {
                    continue;
                } else {
                    $no++;
                    break;
                }
            }
        }
        
        if ($no == count($akritiBhava)) {
            return false;
        } else {
            $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
            return [$yogaData];
        }
    }

    /**
     * Vajra and Yava yogas.
     * 
     * @param string $akritiName
     * @return bool|array
     */
    private function hasVajraYava($akritiName)
    {
        $grahaShubha = Graha::listGrahaByFeature('character', Graha::CHARACTER_SHUBHA);
        unset($grahaShubha[Graha::KEY_CH]);
        $grahaPapa = Graha::listGrahaByFeature('character', Graha::CHARACTER_PAPA);
        unset($grahaPapa[Graha::KEY_RA], $grahaPapa[Graha::KEY_KE]);
        
        $bhavas1 = [1, 7];
        $bhavas4 = [4, 10];
        
        $Analysis = new Analysis($this->Data);
        $grahaInBhava = $Analysis->getBodyInBhava();
        
        $grahaShubhaInBhava = array_intersect_key($grahaInBhava, $grahaShubha);
        $grahaPapaInBhava = array_intersect_key($grahaInBhava, $grahaPapa);
        
        if ($akritiName == self::NAME_VAJRA) {
            $grahaShubhaInBhavas1 = array_intersect($grahaShubhaInBhava, $bhavas1);
            $grahaPapaInBhavas4 = array_intersect($grahaPapaInBhava, $bhavas4);
            
            if (count($grahaShubhaInBhavas1) == 3 || count($grahaPapaInBhavas4) == 3) {
                $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
                return [$yogaData];
            }
        } elseif ($akritiName == self::NAME_YAVA) {
            $grahaShubhaInBhavas4 = array_intersect($grahaShubhaInBhava, $bhavas4);
            $grahaPapaInBhavas1 = array_intersect($grahaPapaInBhava, $bhavas1);
            
            if (count($grahaShubhaInBhavas4) == 3 || count($grahaPapaInBhavas1) == 3) {
                $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
                return [$yogaData];
            }
        }
        return false;
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
