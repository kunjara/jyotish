<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Base\Biblio;
use Jyotish\Graha\Graha;
use Jyotish\Graha\Avastha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;
use Jyotish\Ganita\Math;
use Jyotish\Varga\Varga;

/**
 * Graha environment trait.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait GrahaEnvironment
{
    use \Jyotish\Base\Traits\EnvironmentTrait;
    
    /**
     * Degree of combustion or data source.
     * 
     * @var int|string
     */
    protected $optionBhagaAstangata = 6;
    /**
     * Data source of mrityu bhaga.
     * 
     * @var string
     */
    protected $optionBhagaMrityu = Biblio::BOOK_JP;
    
    /**
     * Get bhava, where graha is positioned or owned.
     * 
     * @param null|string $which Which bhava to get (optional)
     * @return null|int|array
     */
    public function getBhava($which = null)
    {
        $getBhava = function ($rashi) {
            $bhava = 0;
            do {
                $bhava++;
                $bhavaRashi = $this->getEnvironment()['bhava'][$bhava]['rashi'];
            } while ($rashi <> $bhavaRashi);
            return $bhava;
        };
        
        switch ($which) {
            case Rashi::GRAHA_SWA:
                $swa = $this->grahaSwa;
                
                if (isset($swa['positive'])) {
                    $bhava[] = $getBhava($swa['positive']['rashi']);
                    $bhava[] = $getBhava($swa['negative']['rashi']);
                } else {
                    $bhava = is_null($swa[0]['rashi']) ? null : $getBhava($swa[0]['rashi']);
                }
                break;
            default:
                $grahaRashi = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
                $bhava = $getBhava($grahaRashi);
        }

        return $bhava;
    }

    /**
     * Get ruler of the bhava, where graha is positioned.
     * 
     * @return string
     */
    public function getDispositor()
    {
        $rashi = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
        $Rashi = Rashi::getInstance($rashi);
        
        return $Rashi->rashiRuler;
    }
    
    /**
     * Get state of the graha, depending on its position in rashi.
     * 
     * @return string
     */
    public function getRashiAvastha()
    {
        $rashi = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
        $degree = $this->getEnvironment()['graha'][$this->objectKey]['degree'];
        
        if ($rashi == $this->grahaUcha['rashi']) {
            if ($this->objectKey == Graha::KEY_CH || $this->objectKey == Graha::KEY_BU) {
                if ($degree >= 0 && $degree < $this->grahaUcha['degree']) return Rashi::GRAHA_UCHA;
            } else {
                return Rashi::GRAHA_UCHA;
            }
        }
        
        if ($rashi == $this->grahaNeecha['rashi'])
            return Rashi::GRAHA_NEECHA;
        
        if ($rashi == $this->grahaMool['rashi'] && $degree >= $this->grahaMool['start'] && $degree < $this->grahaMool['end'])
            return Rashi::GRAHA_MOOL;
        
        foreach ($this->grahaSwa as $key => $value) {
            if ($rashi == $value['rashi'] && $degree >= $value['start'] && $degree < $value['end'])
                return Rashi::GRAHA_SWA;
        }
        
        $relation = $this->grahaRelation;
        $dispositor = $this->getDispositor();
        switch ($relation[$dispositor]) {
            case 1:
                return Rashi::GRAHA_FRIEND;
                break;
            case 0:
                return Rashi::GRAHA_NEUTRAL;
                break;
            case -1:
                return Rashi::GRAHA_ENEMY;
        }
    }
    
    /**
     * Get avastha of graha.
     * 
     * @return array
     */
    public function getAvastha()
    {
        $avastha[Avastha::TYPE_BALADI] = $this->getAvasthaBaladi();
        $avastha[Avastha::TYPE_JAGRADI] = $this->getAvasthaJagradi();
        $avastha[Avastha::TYPE_DEEPTADI] = $this->getAvasthaDeeptadi();
        
        return $avastha;
    }
    
    /**
     * Get baladi avastha of graha.
     * 
     * @return string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 3.
     */
    public function getAvasthaBaladi()
    {
        $grahaBhaga = $this->getEnvironment()['graha'][$this->objectKey]['degree'];
        $grahaRashi = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
        
        $avasthaBhaga = $grahaRashi % 2 ? $grahaBhaga : 30 - $grahaBhaga;
        
        $avastha = [];
        switch ($avasthaBhaga) {
            case ($avasthaBhaga >= 0 && $avasthaBhaga < 6):
                $avastha = Avastha::NAME_BALA;
                break;
            case ($avasthaBhaga >= 6 && $avasthaBhaga < 12):
                $avastha = Avastha::NAME_KUMARA;
                break;
            case ($avasthaBhaga >= 12 && $avasthaBhaga < 18):
                $avastha = Avastha::NAME_YUVA;
                break;
            case ($avasthaBhaga >= 18 && $avasthaBhaga < 24):
                $avastha = Avastha::NAME_VRIDHA;
                break;
            case ($avasthaBhaga >= 24 && $avasthaBhaga < 30):
                $avastha = Avastha::NAME_MRITA;
        }
        return $avastha;
    }
    
    /**
     * Get jagradi avastha of graha.
     * 
     * @return string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 5.
     */
    public function getAvasthaJagradi()
    {
        $rashiAvastha = $this->getRashiAvastha();
        
        $avastha = [];
        switch ($rashiAvastha) {
            case Rashi::GRAHA_UCHA:
            case Rashi::GRAHA_MOOL:
            case Rashi::GRAHA_SWA:
                $avastha = Avastha::NAME_JAGRATA;
                break;
            case Rashi::GRAHA_FRIEND:
            case Rashi::GRAHA_NEUTRAL:
                $avastha = Avastha::NAME_SWAPNA;
                break;
            case Rashi::GRAHA_ENEMY:
            case Rashi::GRAHA_NEECHA:
                $avastha = Avastha::NAME_SUSHUPTA;
        }
        return $avastha;
    }
    
    /**
     * Get deeptadi avastha of graha.
     * 
     * @return string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 45, Verse 8-10.
     */
    public function getAvasthaDeeptadi()
    {
        $rashiAvastha = $this->getRashiAvastha();
        
        $avastha = [];
        switch ($rashiAvastha) {
            case Rashi::GRAHA_UCHA:
            case Rashi::GRAHA_MOOL:
                $avastha[] = Avastha::NAME_DEEPTA;
                break;
            case Rashi::GRAHA_SWA:
                $avastha[] = Avastha::NAME_SWASTHA;
                break;
            case Rashi::GRAHA_FRIEND:
                $relation = $this->getRelation()[$this->getDispositor()];
                if ($relation == 2) {
                    $avastha[] = Avastha::NAME_PRAMUDITA;
                } else {
                    $avastha[] = Avastha::NAME_SHANTA;
                }
                break;
            case Rashi::GRAHA_NEUTRAL:
            case Rashi::GRAHA_NEECHA:
                $avastha[] = Avastha::NAME_DINA;
                break;
            case Rashi::GRAHA_ENEMY:
                $relation = $this->getRelation()[$this->getDispositor()];
                if ($relation == -2) {
                    $avastha[] = Avastha::NAME_KHALA;
                } else {
                    $avastha[] = Avastha::NAME_DUKHITA;
                }   
        }
        $maleficsAll = Graha::listGrahaByFeature('character', Graha::CHARACTER_PAPA);
        $maleficsConjuncted = array_intersect_key($this->isConjuncted(), $maleficsAll);
        if (count($maleficsConjuncted)) {
            $avastha[] = Avastha::NAME_VIKALA;
        }
        
        if ($this->isAstangata()) {
            $avastha[] = Avastha::NAME_KOPA;
        }
        
        return $avastha;
    }
    
    /**
     * Get graha character depending on what bhava it is (functional beneficence).
     * 
     * @return string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 34, Verse 2-7.
     */
    public function getBhavaCharacter()
    {
        $bhava = $this->getBhava(Rashi::GRAHA_SWA);
        $bhavaKendra = Bhava::$bhavaKendra;
        array_shift($bhavaKendra);
        
        if (is_int($bhava)) {
            if (in_array($bhava, Bhava::$bhavaTrikona)) {
                $character = Graha::CHARACTER_SHUBHA;
            } elseif (in_array($bhava, Bhava::$bhavaTrishadaya) || $bhava == 8) {
                $character = Graha::CHARACTER_PAPA;
            } elseif (in_array($bhava, $bhavaKendra)) {
                $character = Graha::CHARACTER_MISHRA;
            } else {
                $character = $this->getConjunctCharacter();
            }
        } else {
            if ($this->isYogakaraka()) {
                $character = Graha::CHARACTER_YOGAKARAKA;
            } elseif (Math::arrayInArray($bhava, $bhavaKendra, true)) {
                $character = Graha::CHARACTER_KENDRADHI;
            } elseif (
                    (in_array(1, $bhava)) ||
                    (Math::arrayInArray($bhava, Bhava::$bhavaParashraya) && Math::arrayInArray($bhava, Bhava::$bhavaTrikona)) ||
                    (Math::arrayInArray($bhava, Bhava::$bhavaTrishadaya) && Math::arrayInArray($bhava, Bhava::$bhavaTrikona))
            ) {
                $character = Graha::CHARACTER_SHUBHA;
            } elseif (
                    Math::arrayInArray($bhava, Bhava::$bhavaParashraya) ||
                    Math::arrayInArray($bhava, Bhava::$bhavaTrishadaya)
            ) {
                $character = Graha::CHARACTER_PAPA;
            } else {
                $character = Graha::CHARACTER_MISHRA;
            }
        }
        
        return $character;
    }

    /**
     * Get speed of graha in longitude.
     * 
     * @return float Degrees per day
     */
    public function getLongitudeSpeed()
    {
        return $this->getEnvironment()['graha'][$this->objectKey]['speed'];
    }
    
    /**
     * Get tatkalika (temporary) relations.
     * 
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 56.
     */
    public function getTempRelation()
    {
        $relation = [];
        $friendsRashi = [2, 3, 4, 10, 11, 12];
        
        foreach ($this->getEnvironment()['graha'] as $key => $data) {
            if ($this->objectKey == $key) continue;
            
            $distance = Math::distanceInCycle($this->objectRashi, $data['rashi']);
            
            $relation[$key] = in_array($distance, $friendsRashi) ? 1 : -1;
        }
        
        return $relation;
    }
    
    /**
     * Get summary relations.
     * 
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 57-58.
     */
    public function getRelation()
    {
        $relation = Math::arraySum($this->grahaRelation, $this->getTempRelation());
        
        return $relation;
    }
    
    /**
     * Determine if the graha is vargottama (in the same sign in rasi and navamsha).
     * 
     * @return bool
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 1, Verse 50.
     */
    public function isVargottama()
    {
        $d1Data = $this->getEnvironment();
        
        $Varga9 = Varga::getInstance('D9');
        $d9Data = $Varga9->setDataInstance($this->Data)->getVargaData();
        
        if ($d1Data['graha'][$this->objectKey]['rashi'] == $d9Data['graha'][$this->objectKey]['rashi'])
            return true;
        else
            return false;
    }
    
    /**
     * Determine if the graha is yogakaraka.
     * 
     * @return boolean
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 34, Verse 13.
     */
    public function isYogakaraka()
    {
        $yogaKarakas = [
            Graha::KEY_MA => [4, 5],
            Graha::KEY_SK => [10, 11],
            Graha::KEY_SA => [2, 7]
        ];
        
        if (array_key_exists($this->objectKey, $yogaKarakas)) {
            $lagna = $this->getEnvironment()['lagna'][Graha::KEY_LG]['rashi'];
            $isYogakaraka = in_array($lagna, $yogaKarakas[$this->objectKey]) ? true : false;
            
            return $isYogakaraka;
        } else {
            return false;
        }
    }

    /**
     * Determine if the graha is astangata (combustion).
     * 
     * @return null|bool|array Combustion data
     */
    public function isAstangata()
    {
        if (in_array($this->objectKey, [
            Graha::KEY_SY, Graha::KEY_RA, Graha::KEY_KE
        ])) return null;
        
        $degreeSy = $this->getEnvironment()['graha'][Graha::KEY_SY]['longitude'];
        $degreeGr = $this->getEnvironment()['graha'][$this->objectKey]['longitude'];
        
        $distanceGraha = abs($degreeSy - $degreeGr);
        
        if (in_array($this->optionBhagaAstangata, [Biblio::BOOK_SS, Biblio::BOOK_BJ])) {
            $bhagas = Graha::listBhagaAstangata($this->optionBhagaAstangata);
            
            if (is_array($bhagas[$this->objectKey])) {
                $cheshta = $this->getLongitudeSpeed() >= 0 ? Graha::CHESHTA_SAMA : Graha::CHESHTA_VAKRA;
                $distanceCombustion = $bhagas[$this->objectKey][$cheshta];
            } elseif (is_int($bhagas[$this->objectKey])) {
                $distanceCombustion = $bhagas[$this->objectKey];
            } else {
                return null;
            }
        } else {
            $distanceCombustion = $this->optionBhagaAstangata;
        }
        
        if ($distanceGraha <= $distanceCombustion) {
            $percent = ($distanceCombustion - $distanceGraha) * 100 / $distanceCombustion;
            
            return [
                'distance' => $distanceGraha,
                'combustion' => $distanceCombustion,
                'percent' => $percent,
            ];
        } else {
            return false;
        }
    }
    
    /**
     * Determine if the graha is in mrityu bhaga. Indicate when to mrityu bhaga 
     * remains less than 2 degrees.
     * 
     * @return bool|float Distance to mrityu bhaga
     * @see Vaidyanatha Dikshita. Jataka Parijata. Chapter 1, Verse 57.
     */
    public function isMrityu()
    {
        $rashiGraha = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
        $degMrityu = Graha::listBhagaMrityu($this->optionBhagaMrityu)[$this->objectKey][$rashiGraha];
        $lonMrityu = ($rashiGraha - 1) * 30 + $degMrityu;
        $lonGraha = $this->getEnvironment()['graha'][$this->objectKey]['longitude'];
        
        $distanceGraha = abs($lonMrityu - $lonGraha);
        
        if ($distanceGraha > 2) {
            return false;
        } else {
            return $distanceGraha;
        }
    }
    
    /**
     * Determine if the graha is in pushkara bhaga or pushkara navamsha. Indicate 
     * when to pushkara bhaga remains less than 1 degree.
     * 
     * @return bool|int|float Distance to pushkara bhaga
     * @see Vaidyanatha Dikshita. Jataka Parijata. Chapter 1, Verse 58.
     */
    public function isPushkara($type = Graha::PUSHKARA_NAVAMSHA)
    {
        $rashiGraha = $this->getEnvironment()['graha'][$this->objectKey]['rashi'];
        $degGraha = $this->getEnvironment()['graha'][$this->objectKey]['degree'];
        $valNavamsha = Math::dmsToDecimal(['d' => 3, 'm' => 20]);
        
        switch ($type) {
            case Graha::PUSHKARA_BHAGA:
                $degPushkara = Rashi::$pushkaraBhaga[$rashiGraha];
                $distanceGraha = abs($degGraha - $degPushkara);
                
                if ($distanceGraha < 1) {
                    return $distanceGraha;
                } else {
                    return false;
                }
                break;
            case Graha::PUSHKARA_NAVAMSHA:
            default:
                $numNavamsha = null;
                $degNavamsha = [];
                for ($i = 0; $i <= 1; $i++) {
                    $degNavamsha['start'] = (Rashi::$pushkaraNavamsha[$rashiGraha][$i] - 1) * $valNavamsha;
                    $degNavamsha['end'] = $degNavamsha['start'] + $valNavamsha;
                    
                    if ($degGraha >= $degNavamsha['start'] && $degGraha < $degNavamsha['end']) {
                        $numNavamsha = Rashi::$pushkaraNavamsha[$rashiGraha][$i];
                        break;
                    }
                }
                
                if (!is_null($numNavamsha)) {
                    $number = ($rashiGraha - 1) * 9 + $numNavamsha;
                    $navamsha = Math::numberInCycle(1, $number);
                    return $navamsha;
                } else {
                    return false;
                }
        }
    }

    /**
     * Determine if the graha is in planetary war.
     * 
     * @return null|bool|array
     * @see Surya Siddhanta. Chapter 7, Verse 18-23.
     * @see Varahamihira. Brihat Samhita. Chapter 17.
     * @todo Determine who the winner and loser
     */
    public function isYuddha()
    {
        if (in_array($this->objectKey, [
            Graha::KEY_SY, Graha::KEY_CH, Graha::KEY_RA, Graha::KEY_KE
        ])) return null;
        
        $lonGraha = $this->getEnvironment()['graha'][$this->objectKey]['longitude'];
        $grahas = Graha::listGraha(Graha::LIST_PANCHA);
        $isYuddha = false;
        
        foreach ($grahas as $key => $name) {
            if ($key == $this->objectKey) continue;
            
            $distance = abs($lonGraha - $this->getEnvironment()['graha'][$key]['longitude']);
            if ($distance <= 1) {
                $isYuddha[$key] = $distance;
            }
        }
        return $isYuddha;
    }

    /**
     * Determine if the graha is gocharastha.
     * 
     * @return int
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 1, Verse 23-24.
     */
    public function isGocharastha()
    {
        $rashiAvastha = $this->getRashiAvastha();
        
        $avasthaGochara = [Rashi::GRAHA_UCHA, Rashi::GRAHA_MOOL, Rashi::GRAHA_SWA];
        $grahaInGochara = in_array($rashiAvastha, $avasthaGochara) ? true : false;
        
        $bhavaDusthana = Bhava::$bhavaDusthana;
        $grahaInDusthana = in_array($this->getBhava(), $bhavaDusthana) ? true : false;
        
        $grahaIsAstangata = $this->isAstangata();
        
        $grahaInNeecha = $rashiAvastha == Rashi::GRAHA_NEECHA ? true : false;
        
        if ($grahaInGochara)
            if (!$grahaIsAstangata && !$grahaInDusthana) 
                $result = 1;
            else
                $result = 0;
        elseif ($grahaIsAstangata || $grahaInDusthana || $grahaInNeecha)
            $result = -1;
        else
            $result = 0;
        
        return $result;
    }
    
    /**
     * Get graha character depending on the conjuntion with the other planets.
     * 
     * @return string
     */
    protected function getConjunctCharacter()
    {
        $benefic = 0;
        $malefic = 0;
        
        foreach ($this->getEnvironment()['graha'] as $key => $params) {
            if ($key == $this->objectKey) continue;

            if ($params['rashi'] == $this->objectRashi) {
                $G = Graha::getInstance($key);
                $G->setEnvironment($this->Data);

                if ($G->grahaCharacter == Graha::CHARACTER_SHUBHA)
                    $benefic = $benefic + 1;
                else
                    $malefic = $malefic + 1;
            }
        }
        
        if (($benefic > 0 && $malefic > 0) || ($benefic == 0 && $malefic == 0))
            $character = Graha::CHARACTER_MISHRA;
        elseif ($malefic > 0)
            $character = Graha::CHARACTER_PAPA;
        else
            $character = Graha::CHARACTER_SHUBHA;
        
        return $character;
    }
}
