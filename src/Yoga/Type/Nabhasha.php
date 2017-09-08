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
use Jyotish\Base\Data;

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
    const NAME_NAUKA = 'Nauka';
    const NAME_KUTA = 'Kuta';
    const NAME_CHHATRA = 'Chhatra';
    const NAME_CHAPA = 'Chapa';
    const NAME_CHAKRA = 'Chakra';
    const NAME_SAMUDRA = 'Samudra';
    const NAME_GOLA = 'Gola';
    const NAME_YUGA = 'Yuga';
    const NAME_SHOOLA = 'Shoola';
    const NAME_KEDARA = 'Kedara';
    const NAME_PASHA = 'Pasha';
    const NAME_DAMA = 'Dama';
    const NAME_VEENA = 'Veena';
    
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
        self::NAME_NAUKA,
        self::NAME_KUTA,
        self::NAME_CHHATRA,
        self::NAME_CHAPA,
        self::NAME_CHAKRA,
        self::NAME_SAMUDRA,
        self::NAME_GOLA,
        self::NAME_YUGA,
        self::NAME_SHOOLA,
        self::NAME_KEDARA,
        self::NAME_PASHA,
        self::NAME_DAMA,
        self::NAME_VEENA,
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
        self::NAME_NAUKA => [1, 2, 3, 4, 5, 6, 7],
        self::NAME_KUTA => [4, 5, 6, 7, 8, 9, 10],
        self::NAME_CHHATRA => [7, 8, 9, 10, 11, 12, 1],
        self::NAME_CHAPA => [10, 11, 12, 1, 2, 3, 4],
        self::NAME_CHAKRA => [1, 3, 5, 7, 9, 11],
        self::NAME_SAMUDRA => [2, 4, 6, 8, 10, 12],
    ];
    
    /**
     * Bhavas of sankhya yoga.
     * 
     * @var array
     */
    private $sankhyaBhava = [
        self::NAME_GOLA => 1,
        self::NAME_YUGA => 2,
        self::NAME_SHOOLA => 3,
        self::NAME_KEDARA => 4,
        self::NAME_PASHA => 5,
        self::NAME_DAMA => 6,
        self::NAME_VEENA => 7,
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
        
        $Analysis = new Analysis($this->Data);
        $this->temp['grahaInBhava'] = $Analysis->getBodyInBhava();
        
        return $this;
    }

    /**
     * Rajju, Musala and Nala yogas.
     * 
     * @param string $ashrayaName Name of ashraya yoga
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 7.
     */
    private function hasAshraya($ashrayaName)
    {
        $this->temp['hasYoga'][$ashrayaName] = false;
        
        if ($ashrayaName == self::NAME_RAJJU) {
            $rashiBhava = Rashi::BHAVA_CHARA;
        } elseif ($ashrayaName == self::NAME_MUSALA) {
            $rashiBhava = Rashi::BHAVA_STHIRA;
        } else {
            $rashiBhava = Rashi::BHAVA_DVISVA;
        }
        
        $rashis = array_keys(Rashi::listRashiByFeature('bhava', $rashiBhava));
        $dataGraha = $this->getData()['graha'];
        
        foreach ($dataGraha as $key => $data) {
            if (in_array($data['rashi'], $rashis)) {
                continue;
            } else {
                return false;
            }
        }
        $yogaData = $this->assignYoga($ashrayaName, self::GROUP_ASHRAYA);
        $this->temp['hasYoga'][$ashrayaName] = true;
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
    private function hasDala($dalaName)
    {
        $this->temp['hasYoga'][$dalaName] = false;
        
        $kendras = Bhava::$bhavaKendra;
        $grahaShubha = Graha::listGrahaByFeature('character', Graha::CHARACTER_SHUBHA);
        unset($grahaShubha[Graha::KEY_CH]);
        $grahaPapa = Graha::listGrahaByFeature('character', Graha::CHARACTER_PAPA);
        unset($grahaPapa[Graha::KEY_RA], $grahaPapa[Graha::KEY_KE]);
        
        $grahaShubhaInBhava = array_intersect_key($this->temp['grahaInBhava'], $grahaShubha);
        $grahaPapaInBhava = array_intersect_key($this->temp['grahaInBhava'], $grahaPapa);

        $grahaShubhaInKendra = array_intersect($grahaShubhaInBhava, $kendras);
        $grahaPapaInKendra = array_intersect($grahaPapaInBhava, $kendras);
        
        if ($dalaName == self::NAME_MALA) {
            if (count($grahaShubhaInKendra) == 3 && count($grahaPapaInKendra) == 0) {
                $yogaData = $this->assignYoga($dalaName, self::GROUP_DALA);
                $this->temp['hasYoga'][$dalaName] = true;
                return [$yogaData];
            }
        } elseif ($dalaName == self::NAME_SARPA) {
            if (count($grahaShubhaInKendra) == 0 && count($grahaPapaInKendra) == 3) {
                $yogaData = $this->assignYoga($dalaName, self::GROUP_DALA);
                $this->temp['hasYoga'][$dalaName] = true;
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
    private function hasAkriti($akritiName)
    {
        $this->temp['hasYoga'][$akritiName] = false;
        
        $dataGraha = $this->getData()['graha'];
        unset($dataGraha[Graha::KEY_RA], $dataGraha[Graha::KEY_KE]);
        
        switch ($akritiName) {
            case self::NAME_HALA:
            case self::NAME_VAPI:
                return $this->hasHalaVapi($akritiName);
            case self::NAME_VAJRA:
            case self::NAME_YAVA:
                return $this->hasVajraYava($akritiName);
            default:
                $akritiRashi = [];
                foreach ($this->akritiBhava[$akritiName] as $bhavaKey) {
                    $akritiRashi[$bhavaKey] = $this->getData()['bhava'][$bhavaKey]['rashi'];
                }
                
                $grahaRashi = [];
                foreach ($dataGraha as $key => $data) {
                    if (in_array($data['rashi'], $akritiRashi)) {
                        $grahaRashi[] = $data['rashi'];
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
        $this->temp['hasYoga'][$akritiName] = true;
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
     * If all the grahas occupy the seven bhavas from Lagna, Nauka yoga occurs.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 14.
     */
    public function hasNauka()
    {
        return $this->hasAkriti(self::NAME_NAUKA);
    }
    
    /**
     * If all the grahas occupy the seven bhavas from 4th, Kuta yoga occurs.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 14.
     */
    public function hasKuta()
    {
        return $this->hasAkriti(self::NAME_KUTA);
    }
    
    /**
     * If all the grahas occupy the seven bhavas from 7th, Chhatra yoga occurs.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 14.
     */
    public function hasChhatra()
    {
        return $this->hasAkriti(self::NAME_CHHATRA);
    }
    
    /**
     * If all the grahas occupy the seven bhavas from 10th, Chapa yoga occurs.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 14.
     */
    public function hasChapa()
    {
        return $this->hasAkriti(self::NAME_CHAPA);
    }
    
    /**
     * If all the grahas occupy six alternative rashis, commencing from Lagna, 
     * Chakra yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 15.
     */
    public function hasChakra()
    {
        return $this->hasAkriti(self::NAME_CHAKRA);
    }
    
    /**
     * If all the grahas occupy six alternative rashis, commencing from 2nd, 
     * Samudra yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 15.
     */
    public function hasSamudra()
    {
        return $this->hasAkriti(self::NAME_SAMUDRA);
    }
    
    /**
     * Hala and Vapi yogas.
     * 
     * @param string $akritiName
     * @return bool|array
     */
    private function hasHalaVapi($akritiName)
    {
        $this->temp['hasYoga'][$akritiName] = false;
        
        $dataGraha = $this->getData()['graha'];
        unset($dataGraha[Graha::KEY_RA], $dataGraha[Graha::KEY_KE]);
        
        $grahaRashi = [];
        foreach ($dataGraha as $key => $data) {
            $grahaRashi[] = $data['rashi'];
        }
        $grahaRashiUnique = array_unique($grahaRashi);
        
        $akritiBhava = $this->akritiBhava[$akritiName];
        $akritiRashi = [];

        foreach ($akritiBhava as $index => $bhava) {
            foreach ($bhava as $bhavaKey) {
                $akritiRashi[$index][] = $this->getData()['bhava'][$bhavaKey]['rashi'];
            }
        }
        
        $no = 0;
        foreach ($akritiRashi as $index => $rashis) {
            foreach ($dataGraha as $key => $data) {
                if (in_array($data['rashi'], $rashis)) {
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
            if (count($grahaRashiUnique) != count($rashis)) {
                return false;
            }
            
            $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
            $this->temp['hasYoga'][$akritiName] = true;
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
        $this->temp['hasYoga'][$akritiName] = false;
        
        $grahaShubha = Graha::listGrahaByFeature('character', Graha::CHARACTER_SHUBHA);
        unset($grahaShubha[Graha::KEY_CH]);
        $grahaPapa = Graha::listGrahaByFeature('character', Graha::CHARACTER_PAPA);
        unset($grahaPapa[Graha::KEY_RA], $grahaPapa[Graha::KEY_KE]);
        
        $bhavas1 = [1, 7];
        $bhavas4 = [4, 10];
        
        $grahaShubhaInBhava = array_intersect_key($this->temp['grahaInBhava'], $grahaShubha);
        $grahaPapaInBhava = array_intersect_key($this->temp['grahaInBhava'], $grahaPapa);
        
        if ($akritiName == self::NAME_VAJRA) {
            $grahaShubhaInBhavas1 = array_intersect($grahaShubhaInBhava, $bhavas1);
            $grahaPapaInBhavas4 = array_intersect($grahaPapaInBhava, $bhavas4);
            
            if (count($grahaShubhaInBhavas1) == 3 || count($grahaPapaInBhavas4) == 3) {
                $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
                $this->temp['hasYoga'][$akritiName] = true;
                return [$yogaData];
            }
        } elseif ($akritiName == self::NAME_YAVA) {
            $grahaShubhaInBhavas4 = array_intersect($grahaShubhaInBhava, $bhavas4);
            $grahaPapaInBhavas1 = array_intersect($grahaPapaInBhava, $bhavas1);
            
            if (count($grahaShubhaInBhavas4) == 3 || count($grahaPapaInBhavas1) == 3) {
                $yogaData = $this->assignYoga($akritiName, self::GROUP_AKRITI);
                $this->temp['hasYoga'][$akritiName] = true;
                return [$yogaData];
            }
        }
        return false;
    }
    
    /**
     * Sankhya yogas.
     * 
     * @param string $sankhyaName
     * @return boolean|array
     */
    private function hasSankhya($sankhyaName)
    {
        $listExceptSankhya = array_slice(self::$yoga, 3, 24);
        
        foreach ($listExceptSankhya as $yogaName) {
            if (!isset($this->temp['hasYoga'][$yogaName])) {
                $hasYogaName = 'has' . ucfirst($yogaName);
                $this->$hasYogaName();
            }
        }
        
        if (in_array(true, $this->temp['hasYoga'])) {
            return false;
        } else {
            $grahaSapta = Graha::listGraha(Graha::LIST_SAPTA);
            $grahaSaptaInBhava = array_intersect_key($this->temp['grahaInBhava'], $grahaSapta);
            $grahaBhava = array_unique($grahaSaptaInBhava);
        }
        
        if (count($grahaBhava) != $this->sankhyaBhava[$sankhyaName]) {
            return false;
        } else {
            sort($grahaBhava);
            $sankhyaBhava = implode(',', array_values($grahaBhava));
            
            $yogaData = $this->assignYoga($sankhyaName, self::GROUP_SANKHYA, ['bhava' => $sankhyaBhava]);
            $this->temp['hasYoga'][$sankhyaName] = true;
            return [$yogaData];
        }
    }
    
    /**
     * If all grahas are in one rashi, Gola yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasGola()
    {
        return $this->hasSankhya(self::NAME_GOLA);
    }
    
    /**
     * If all grahas are in 2 rashi, Yuga yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasYuga()
    {
        return $this->hasSankhya(self::NAME_YUGA);
    }
    
    /**
     * If all grahas are in 3 rashi, Shoola yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasShoola()
    {
        return $this->hasSankhya(self::NAME_SHOOLA);
    }
    
    /**
     * If all grahas are in 4 rashi, Kedara yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasKedara()
    {
        return $this->hasSankhya(self::NAME_KEDARA);
    }
    
    /**
     * If all grahas are in 5 rashi, Pasha yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasPasha()
    {
        return $this->hasSankhya(self::NAME_PASHA);
    }
    
    /**
     * If all grahas are in 6 rashi, Dama yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasDama()
    {
        return $this->hasSankhya(self::NAME_DAMA);
    }
    
    /**
     * If all grahas are in 7 rashi, Veena yoga is formed.
     * 
     * @return bool|array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 35, Verse 16-17.
     */
    public function hasVeena()
    {
        return $this->hasSankhya(self::NAME_VEENA);
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
                $list = array_slice(self::$yoga, 5, 22);
                break;
            case self::GROUP_SANKHYA:
                $list = array_slice(self::$yoga, 27);
                break;
            default:
                $list = self::$yoga;
        }
        return $list;
    }
}
