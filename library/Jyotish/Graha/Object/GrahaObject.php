<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * Parent class for graha objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaAbbr;

	/**
	 * Devanagari graha title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit;
	
	protected $grahaAvatara;
	protected $grahaUnicode;
	protected $grahaAltName = array();
	protected $grahaAgeMaturity;
	protected $grahaAgePeriod = array(
		'start',
		'end'
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	protected $grahaCharacter;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 */
	protected $grahaDeva;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 */
	protected $grahaGender;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 */
	protected $grahaBhuta;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 */
	protected $grahaVarna;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 */
	protected $grahaGuna;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 */
	protected $grahaDhatu;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 */
	protected $grahaRasa;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 */
	protected $grahaExaltation = array();
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 */
	protected $grahaDebilitation = array();
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 */
	protected $grahaMooltrikon = array();
	
	/**
	 * Own sign of the graha.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 */
	protected $grahaOwn = array();
	
	/**
	 * Natural relationships.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
	 */
	protected $grahaRelation = array();
	
	protected $grahaDisha;
	protected $grahaPrakriti;
	protected $grahaDrishti = array();
	
	/**
	 * Get graha devanagari name.
	 *
	 * @return array
	 */
	public function getGrahaTranslit()
	{
		return $this->grahaTranslit;
	}
	
	/**
	 * Get graha unicode.
	 * 
	 * @return string
	 */
	public function getGrahaUnicode()
	{
		return $this->grahaUnicode;
	}
	
	/**
	 * Get graha avatara.
	 * 
	 * @return string
	 */
	public function getGrahaAvatara()
	{
		return $this->grahaAvatara;
	}
	
	/**
	 * Get graha deva.
	 * 
	 * @return string
	 */
	public function getGrahaDeva()
	{
		return $this->grahaDeva;
	}
	
	/**
	 * Get graha exaltation sign.
	 * 
	 * @return array
	 */
	public function getGrahaExaltation()
	{
		return $this->grahaExaltation;
	}
	
	/**
	 * Get graha debilitation sign.
	 * 
	 * @return array
	 */
	public function getGrahaDebilitation()
	{
		return $this->grahaDebilitation;
	}
	
	/**
	 * Get graha mooltrikon sign.
	 * 
	 * @return array
	 */
	public function getGrahaMooltrikon()
	{
		return $this->grahaMooltrikon;
	}
	
	/**
	 * Get graha own sign.
	 * 
	 * @return array
	 */
	public function getGrahaOwn()
	{
		return $this->grahaOwn;
	}
	
	/**
	 * Get graha varna.
	 * 
	 * @return string
	 */
	public function getGrahaVarna()
	{
		return $this->grahaVarna;
	}
	
	/**
	 * Get graha gender.
	 * 
	 * @return string
	 */
	public function getGrahaGender()
	{
		return $this->grahaGender;
	}
	
	/**
	 * Get graha guna.
	 * 
	 * @return string
	 */
	public function getGrahaGuna()
	{
		return $this->grahaGuna;
	}
	
	/**
	 * Get graha bhuta.
	 * 
	 * @return string
	 */
	public function getGrahaBhuta()
	{
		return $this->grahaBhuta;
	}
	
	/**
	 * Get graha prakriti.
	 * 
	 * @return array
	 */
	public function getGrahaPrakriti()
	{
		return $this->grahaPrakriti;
	}
	
	/**
	 * Get graha rasa.
	 * 
	 * @return string
	 */
	public function getGrahaRasa()
	{
		return $this->grahaRasa;
	}
	
	/**
	 * Get graha dhatu.
	 * 
	 * @return array
	 */
	public function getGrahaDhatu()
	{
		return $this->grahaDhatu;
	}
	
	/**
	 * Get graha character.
	 * 
	 * @return string
	 */
	public function getGrahaCharacter()
	{
		return $this->grahaCharacter;
	}
	
	/**
	 * Get graha disha.
	 * 
	 * @return string
	 */
	public function getGrahaDisha()
	{
		return $this->grahaDisha;
	}
	
	/**
	 * Get natural relationships.
	 * 
	 * @param string $key
	 * @return mixed
	 *
	 */
	public function getNaturalRelation($key = null)
	{
		if(is_null($key)){
			return $this->grahaRelation;
		}else{
			if (array_key_exists($key, Graha::$graha)){
				return $this->grahaRelation[$key];
			}else{
				throw new \Jyotish\Graha\Exception\InvalidArgumentException("Graha with the key '$key' does not exist.");
			}
		}
	}
	
	/**
	 * Set natural relationships.
	 * 
	 * @param bool $relationSameGrahas If true same grahas are friends.
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
	 */
	protected function setNaturalRelation($relationSameGrahas = false)
	{
		$relationships = array();
		$friendsFromMt = array(2, 4, 5, 8, 9, 12);
		$enemiesFromMt = array(3, 6, 7, 10, 11);
		
		$rashiMt = $this->grahaMooltrikon['rashi'];
		$rashiEx = $this->grahaExaltation['rashi'];
		
		$friends = array();
		$R = Rashi::getInstance($rashiEx);
		$gFriend = $R->getRashiRuler();
		if($this->grahaAbbr != $gFriend) $friends[] = $gFriend;
		
		$relation = function($distance) use($rashiMt){
			foreach($distance as $step){
				$r = Math::numberInCycle($rashiMt, $step);
				$R = Rashi::getInstance((int)$r);
				$gRuler = $R->getRashiRuler();

				if($this->grahaAbbr == $gRuler) continue;
				$grahas[] = $gRuler;
			}
			return $grahas;
		};
		
		$friends = array_unique(array_merge($friends, $relation($friendsFromMt)));
		$enemies = array_unique($relation($enemiesFromMt));
		
		foreach (Graha::$graha as $g => $name){
			if(in_array($g, $friends) and in_array($g, $enemies)){
				$relationships[$g] = 0;
			}elseif(in_array($g, $friends)){
				$relationships[$g] = 1;
			}elseif(in_array($g, $enemies)){
				$relationships[$g] = -1;
			}else{
				$relationships[$g] = null;
			}
		}
		$relationships[$this->grahaAbbr] = $relationSameGrahas ? 1 : null;
		
		$this->grahaRelation = $relationships;
	}

	/**
	 * Constructor
	 * 
     * @param array $options
     */
	public function __construct($options)
	{
		$this->setNaturalRelation($options['relationSameGrahas']);
	}
}
