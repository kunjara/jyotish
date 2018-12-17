<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Base\Biblio;
use Jyotish\Base\BaseObject;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;
use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Parent class for graha objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaObject extends BaseObject
{
    use GrahaEnvironment;
    
    /**
     * Object type
     * 
     * @var string
     */
    protected $objectType = 'graha';
    
    /**
     * Relationship between the same grahas.
     * 
     * @var bool
     */
    protected $optionRelationSame = false;
    
    /**
     * Relationship between the chaya grahas.
     * 
     * @var string
     */
    protected $optionRelationChaya;
    
    /**
     * Data source of specific rashi for chaya grahas.
     * 
     * @var string
     */
    protected $optionSpecificRashi = Biblio::BOOK_BPHS;
    
    /**
     * Drishti for Rahu.
     * 
     * @var string
     */
    protected $optionDrishtiRahu;

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
     * Character of the Graha (natural beneficence).
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
    protected $grahaColor = [];

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
    protected $grahaUcha = [];

    /**
     * Graha debilitation.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [];

    /**
     * Graha mooltrikon.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [];

    /**
     * Own sign of the graha.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [];

    /**
     * Natural relationships.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
     */
    protected $grahaRelation = [];

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
    protected $grahaDrishti = [];

    /**
     * Prakriti of graha
     * 
     * @var array
     */
    protected $grahaPrakriti;
    protected $grahaAgeMaturity;
    protected $grahaAgePeriod = [
        'start',
        'end'
    ];
    protected $grahaLongitudeSpeedAvg = [];

    /**
     * Set graha names.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    protected function setObjectNames()
    {
        if ($this->objectKey != Graha::KEY_RA && $this->objectKey != Graha::KEY_KE) {
            $nameDeva = 'name'.$this->objectName;
            $this->objectNames = array_merge(Deva::${$nameDeva}, $this->objectNames);
        } else {
            parent::setObjectNames();
        }
    }

    /**
     * Set naisargika (natural) relations.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
     */
    protected function setGrahaRelation()
    {
        $relation = [];
        $friendsFromMt = [2, 4, 5, 8, 9, 12];
        $enemiesFromMt = [3, 6, 7, 10, 11];

        $rashiMool = $this->grahaMool['rashi'];
        $rashiUcha = $this->grahaUcha['rashi'];

        $friends = [];
        $R = Rashi::getInstance($rashiUcha);
        $gFriend = $R->rashiRuler;
        if ($this->objectKey != $gFriend) $friends[] = $gFriend;

        $getRelation = function ($distance) use ($rashiMool) {
            $grahas = [];
            foreach ($distance as $step) {
                $r = Math::numberInCycle($rashiMool, $step);
                $R = Rashi::getInstance((int) $r);
                $gRuler = $R->rashiRuler;

                if ($this->objectKey == $gRuler) continue;
                $grahas[] = $gRuler;
            }
            return $grahas;
        };

        $friends = array_unique(array_merge($friends, $getRelation($friendsFromMt)));
        $enemies = array_unique($getRelation($enemiesFromMt));

        foreach (Graha::$graha as $key => $name) {
            if ($this->objectKey == $key) continue;

            if (in_array($key, $friends) && in_array($key, $enemies)) {
                $relation[$key] = 0;
            } elseif (in_array($key, $friends)) {
                $relation[$key] = 1;
            } elseif (in_array($key, $enemies)) {
                $relation[$key] = -1;
            } else {
                $G = Graha::getInstance($key, $this->getOptions());
                $relation[$key] = $G->grahaRelation[$this->objectKey];
            }
        }
        $relation[$this->objectKey] = $this->optionRelationSame ? 1 : null;

        $this->grahaRelation = $relation;
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
        
        if (is_null($specificRashi['swa'])) {
            $this->grahaSwa = [
                ['rashi' => null]
            ];
        } else {
            $this->grahaSwa = [
                [
                    'rashi' => $specificRashi['swa'],
                    'start' => 0,
                    'end'   => 30
                ]
            ];
        }
        
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
        
        $this->setGrahaRelation();
    }
}
