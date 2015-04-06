<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Base\Literature;
use Jyotish\Base\Object;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Bhava\Bhava;
use Jyotish\Ganita\Math;
use Jyotish\Varga\Varga;
use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Parent class for graha objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaObject extends Object {
    /**
     * Options of graha object.
     * 
     * @var array
     */
    protected $options = array(
        'relationSame' => false,
        'relationChaya' => '',
        'bhagaAstangata' => 6,
        'bhagaMrityu' => Literature::BOOK_JP,
        'specificRashi' => '',
        'drishtiRahu' => '',
    );
    
    /**
     * Object type
     * 
     * @var string
     */
    protected $objectType = 'graha';

    /**
     * Unicode of the Graha.
     * 
     * @var string
     */
    protected $grahaUnicode;

    /**
     * Amsha of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 2.
     */
    protected $grahaAmsha;


    /**
     * Avatara of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara;

    /**
     * Devanagari graha title in transliteration.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit;

    /**
     * Character of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaCharacter;
    
    /**
     * Colors of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 16-17.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 4-5.
     */
    protected $grahaColor = array();

    /**
     * Deva of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva;

    /**
     * Gender of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaGender;

    /**
     * Bhuta of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaBhuta;

    /**
     * Varna of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaVarna;

    /**
     * Guna of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaGuna;

    /**
     * Dhatu of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
     */
    protected $grahaDhatu;

    /**
     * Kala of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala;

    /**
     * Rasa of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa;

    /**
     * Ritu of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 12.
     */
    protected $grahaRitu;
    /**
     * Graha basis.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis;

    /**
     * Graha exaltation.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = array();

    /**
     * Graha debilitation.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = array();

    /**
     * Graha mooltrikon.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = array();

    /**
     * Own sign of the graha.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = array();

    /**
     * Natural relationships.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
     */
    protected $grahaNaturalRelation = array();

    /**
     * Graha disha
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha;

    /**
     * Graha drishti
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 26, Verse 2-5.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
     */
    protected $grahaDrishti = array();

    /**
     * Prakriti of graha
     * 
     * @var array
     */
    protected $grahaPrakriti;
    protected $grahaAgeMaturity;
    protected $grahaAgePeriod = array(
        'start',
        'end'
    );
    protected $grahaLongitudeSpeedAvg = array();

    /**
     * Get bhava, where graha is positioned.
     * 
     * @return int
     */
    public function getBhava()
    {
        $this->checkEnvironment();

        $grahaRashi = $this->ganitaData['graha'][$this->objectKey]['rashi'];
        $bhava = 0;
        do{
            $bhava++;
            $bhavaRashi = $this->ganitaData['bhava'][$bhava]['rashi'];
        }
        while($grahaRashi <> $bhavaRashi);

        return $bhava;
    }

    /**
     * Get ruler of the bhava, where graha is positioned.
     * 
     * @return string
     */
    public function getDispositor()
    {
        $this->checkEnvironment();
        
        $rashi = $this->ganitaData['graha'][$this->objectKey]['rashi'];
        $Rashi = Rashi::getInstance($rashi);
        
        return $Rashi->rashiRuler;;
    }
    
    /**
     * Get state of the graha, depending on its position in rashi.
     * 
     * @return string
     */
    public function getRashiAvastha()
    {
        $this->checkEnvironment();
        
        $rashi = $this->ganitaData['graha'][$this->objectKey]['rashi'];
        $degree = $this->ganitaData['graha'][$this->objectKey]['degree'];
        
        if($rashi == $this->grahaUcha['rashi']){
            if($this->objectKey == Graha::KEY_CH or $this->objectKey == Graha::KEY_BU){
                if($degree >= 0 and $degree < $this->grahaUcha['degree']) return Rashi::GRAHA_UCHA;
            }else{
                return Rashi::GRAHA_UCHA;
            }
        }
        
        if($rashi == $this->grahaNeecha['rashi'])
            return Rashi::GRAHA_NEECHA;
        
        if($rashi == $this->grahaMool['rashi'] and $degree >= $this->grahaMool['start'] and $degree < $this->grahaMool['end'])
            return Rashi::GRAHA_MOOL;
        
        foreach ($this->grahaSwa as $key => $value){
            if($rashi == $value['rashi'] and $degree >= $value['start'] and $degree < $value['end'])
                return Rashi::GRAHA_SWA;
        }
        
        $relation = $this->grahaNaturalRelation;
        $dispositor = $this->getDispositor();
        switch ($relation[$dispositor]){
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
     * Get speed of graha in longitude.
     * 
     * @return float Degrees per day
     */
    public function getLongitudeSpeed()
    {
        $this->checkEnvironment();
        
        return $this->ganitaData['graha'][$this->objectKey]['speed'];
    }
    
    /**
     * Whether the graha is vargottama (in the same sign in rasi and navamsha).
     * 
     * @return bool
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 1, Verse 50.
     */
    public function isVargottama()
    {
        $this->checkEnvironment();
        
        $d1Data = $this->ganitaData;
        
        $Varga9 = Varga::getInstance('D9');
        $d9Data = $Varga9->getVargaData($d1Data);
        
        if($d1Data['graha'][$this->objectKey]['rashi'] == $d9Data['graha'][$this->objectKey]['rashi'])
            return true;
        else
            return false;
    }
    
    /**
     * Whether the graha is astangata (combustion).
     * 
     * @return null|bool|array Combustion data
     */
    public function isAstangata()
    {
        $this->checkEnvironment();
        
        if(in_array($this->objectKey, [
            Graha::KEY_SY, Graha::KEY_RA, Graha::KEY_KE
        ])) return null;
        
        $degreeSy = $this->ganitaData['graha'][Graha::KEY_SY]['longitude'];
        $degreeGr = $this->ganitaData['graha'][$this->objectKey]['longitude'];
        
        $distanceGraha = abs($degreeSy - $degreeGr);
        
        if(in_array($this->options['bhagaAstangata'], [Literature::BOOK_SS, Literature::BOOK_BJ])){
            $bhagas = Graha::listBhagaAstangata($this->options['bhagaAstangata']);
            
            if(is_array($bhagas[$this->objectKey])){
                $cheshta = $this->getLongitudeSpeed() >= 0 ? Graha::CHESHTA_SAMA : Graha::CHESHTA_VAKRA;
                $distanceCombustion = $bhagas[$this->objectKey][$cheshta];
            }elseif(is_int($bhagas[$this->objectKey])){
                $distanceCombustion = $bhagas[$this->objectKey];
            }else{
                return null;
            }
        }else{
            $distanceCombustion = $this->options['bhagaAstangata'];
        }
        
        if($distanceGraha <= $distanceCombustion){
            $percent = ($distanceCombustion - $distanceGraha) * 100 / $distanceCombustion;
            
            return [
                'distance' => $distanceGraha,
                'combustion' => $distanceCombustion,
                'percent' => $percent,
            ];
        }else{
            return false;
        }
    }
    
    /**
     * Whether the graha is in mrityu bhaga. Indicate when to mrityu bhaga remains 
     * less than 2 degrees.
     * 
     * @return bool|float Distance to mrityu bhaga
     */
    public function isMrityu()
    {
        if($this->objectKey == Graha::KEY_SY) return false;
        
        $this->checkEnvironment();
        
        $rashiMrityu = $this->ganitaData['graha'][$this->objectKey]['rashi'];
        $degMrityu = Graha::listBhagaMrityu($this->options['bhagaMrityu'])[$this->objectKey][$rashiMrityu];
        $lonMrityu = ($rashiMrityu - 1) * 30 + $degMrityu;
        $lonGraha = $this->ganitaData['graha'][$this->objectKey]['longitude'];
        
        $distanceGraha = abs($lonMrityu - $lonGraha);
        
        if($distanceGraha > 2){
            return false;
        }else{
            return $distanceGraha;
        }
    }

    /**
     * Whether the graha is gocharastha.
     * 
     * @return int
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 1, Verse 23-24.
     */
    public function isGocharastha()
    {
        $this->checkEnvironment();
        
        $rashiAvastha = $this->getRashiAvastha();
        
        $avasthaGochara = [Rashi::GRAHA_UCHA, Rashi::GRAHA_MOOL, Rashi::GRAHA_SWA];
        $grahaInGochara = in_array($rashiAvastha, $avasthaGochara) ? true : false;
        
        $bhavaDusthana = Bhava::$bhavaDusthana;
        $grahaInDusthana = in_array($this->getBhava(), $bhavaDusthana) ? true : false;
        
        $grahaIsAstangata = $this->isAstangata();
        
        $grahaInNeecha = $rashiAvastha == Rashi::GRAHA_NEECHA ? true : false;
        
        if($grahaInGochara)
            if(!$grahaIsAstangata and !$grahaInDusthana) 
                $result = 1;
            else
                $result = 0;
        elseif($grahaIsAstangata or $grahaInDusthana or $grahaInNeecha)
            $result = -1;
        else
            $result = 0;
        
        return $result;
    }
    
    /**
     * Set graha names.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    protected function setGrahaNames()
    {
        if($this->objectKey != Graha::KEY_RA and $this->objectKey != Graha::KEY_KE){
            $nameDeva = 'name'.$this->objectName;
            $this->objectNames = array_merge(Deva::${$nameDeva}, $this->objectNames);
        }
    }

    /**
     * Set natural relationships.
     * 
     * @param array $options Options to set
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
     */
    protected function setGrahaNaturalRelation($options)
    {
        $relationships = array();
        $friendsFromMt = [2, 4, 5, 8, 9, 12];
        $enemiesFromMt = [3, 6, 7, 10, 11];

        $rashiMool = $this->grahaMool['rashi'];
        $rashiUcha = $this->grahaUcha['rashi'];

        $friends = array();
        $R = Rashi::getInstance($rashiUcha);
        $gFriend = $R->rashiRuler;
        if($this->objectKey != $gFriend) $friends[] = $gFriend;

        $relation = function($distance) use($rashiMool){
            foreach($distance as $step){
                $r = Math::numberInCycle($rashiMool, $step);
                $R = Rashi::getInstance((int)$r);
                $gRuler = $R->rashiRuler;

                if($this->objectKey == $gRuler) continue;
                $grahas[] = $gRuler;
            }
            return $grahas;
        };

        $friends = array_unique(array_merge($friends, $relation($friendsFromMt)));
        $enemies = array_unique($relation($enemiesFromMt));

        foreach (Graha::$graha as $key => $name){
            if($this->objectKey == $key) continue;

            if(in_array($key, $friends) and in_array($key, $enemies)){
                $relationships[$key] = 0;
            }elseif(in_array($key, $friends)){
                $relationships[$key] = 1;
            }elseif(in_array($key, $enemies)){
                $relationships[$key] = -1;
            }else{
                $G = Graha::getInstance($key, $options);
                $relationships[$key] = $G->grahaNaturalRelation[$this->objectKey];
            }
        }
        $relationships[$this->objectKey] = $options['relationSame'] ? 1 : null;

        $this->grahaNaturalRelation = $relationships;
    }

    /**
     * Set exaltation, sebilitation, mooltrikon and own.
     * 
     * @param array $specificRashi
     */
    protected function setGrahaSpecificRashi(array $specificRashi)
    {
        $this->grahaUcha   = [
            'rashi' => $specificRashi['ucha']
        ];
        $this->grahaMool   = [
            'rashi' => $specificRashi['mool'],
            'start' => 0,
            'end'   => 30
        ];
        $this->grahaSwa    = [
            [
                'rashi' => $specificRashi['swa'],
                'start' => 0,
                'end'   => 30
            ]
        ];
        $this->grahaNeecha = [
            'rashi' => $specificRashi['neecha']
        ];
    }
    
    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        parent::__construct($options);
        
        $this->setGrahaNames();
        $this->setGrahaNaturalRelation($this->options);
    }
}
