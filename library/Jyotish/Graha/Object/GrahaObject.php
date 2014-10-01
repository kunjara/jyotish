<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Base\Object;
use Jyotish\Graha\Graha;
use Jyotish\Rashi\Rashi;
use Jyotish\Ganita\Math;

/**
 * Parent class for graha objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaObject extends Object {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaKey;

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
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaCharacter;
	
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
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
	 */
	protected $grahaRasa;
	
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
	protected $grahaRelation = array();
	
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
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
	 */
	protected $grahaDrishti = array();
	
	/**
	 * Prakriti of graha
	 * 
	 * @var array
	 */
	protected $grahaPrakriti;
	
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
	 * Get graha character.
	 * 
	 * @return string
	 */
	public function getGrahaCharacter()
	{
		return $this->grahaCharacter;
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
	 * Get graha gender.
	 * 
	 * @return string
	 */
	public function getGrahaGender()
	{
		return $this->grahaGender;
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
	 * Get graha varna.
	 * 
	 * @return string
	 */
	public function getGrahaVarna()
	{
		return $this->grahaVarna;
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
	 * Get graha dhatu.
	 * 
	 * @return array
	 */
	public function getGrahaDhatu()
	{
		return $this->grahaDhatu;
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
	 * Get graha exaltation sign.
	 * 
	 * @return array
	 */
	public function getGrahaUcha()
	{
		return $this->grahaUcha;
	}
	
	/**
	 * Get graha debilitation sign.
	 * 
	 * @return array
	 */
	public function getGrahaNeecha()
	{
		return $this->grahaNeecha;
	}
	
	/**
	 * Get graha mooltrikon sign.
	 * 
	 * @return array
	 */
	public function getGrahaMool()
	{
		return $this->grahaMool;
	}
	
	/**
	 * Get graha own sign.
	 * 
	 * @return array
	 */
	public function getGrahaSwa()
	{
		return $this->grahaSwa;
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
	 * Get graha drishti.
	 * 
	 * @return array
	 */
	public function getGrahaDrishti()
	{
		return $this->grahaDrishti;
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
	 * Get natural relationships.
	 * 
	 * @param null|string $key (Optional)
	 * @return mixed
	 * @throws Exception\InvalidArgumentException
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
	 * @param null|array $options Options to set
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 55.
	 */
	protected function setNaturalRelation($options)
	{
		$relationships = array();
		$friendsFromMt = array(2, 4, 5, 8, 9, 12);
		$enemiesFromMt = array(3, 6, 7, 10, 11);
		
		$rashiMool = $this->grahaMool['rashi'];
		$rashiUcha = $this->grahaUcha['rashi'];
		
		$friends = array();
		$R = Rashi::getInstance($rashiUcha);
		$gFriend = $R->getRashiRuler();
		if($this->grahaKey != $gFriend) $friends[] = $gFriend;
		
		$relation = function($distance) use($rashiMool){
			foreach($distance as $step){
				$r = Math::numberInCycle($rashiMool, $step);
				$R = Rashi::getInstance((int)$r);
				$gRuler = $R->getRashiRuler();

				if($this->grahaKey == $gRuler) continue;
				$grahas[] = $gRuler;
			}
			return $grahas;
		};
		
		$friends = array_unique(array_merge($friends, $relation($friendsFromMt)));
		$enemies = array_unique($relation($enemiesFromMt));
		
		foreach (Graha::$graha as $key => $name){
			if($this->grahaKey == $key) continue;
			
			if(in_array($key, $friends) and in_array($key, $enemies)){
				$relationships[$key] = 0;
			}elseif(in_array($key, $friends)){
				$relationships[$key] = 1;
			}elseif(in_array($key, $enemies)){
				$relationships[$key] = -1;
			}else{
				$G = Graha::getInstance($key, $options);
				$relationships[$key] = $G->getNaturalRelation($this->grahaKey);
			}
		}
		$relationships[$this->grahaKey] = $options['relationSame'] ? 1 : null;
		
		$this->grahaRelation = $relationships;
	}
	
	/**
	 * Set exaltation, sebilitation, mooltrikon and own.
	 * 
	 * @param array $specificRashi
	 */
	protected function setSpecificRashi(array $specificRashi)
	{
		$this->grahaUcha = array('rashi' => $specificRashi['ex']);
		$this->grahaNeecha = array('rashi' => $specificRashi['db']);
		$this->grahaMool = array('rashi' => $specificRashi['mt']);
		$this->grahaSwa = array('rashi' => $specificRashi['ow']);
	}
	
	/**
	 * Get aspect by grahas.
	 * 
	 * @return array
	 */
	public function isAspectedByGraha()
	{
		$this->checkEnvironment();
		
		foreach (Graha::$graha as $key => $name){
			if($key == $this->grahaKey) continue;
			
			$Graha = Graha::getInstance($key);
			$grahaDrishti = $Graha->getGrahaDrishti();
			
			$distanse = Math::distanceInCycle(
				$this->ganitaData['graha'][$key]['rashi'], 
				$this->ganitaData['graha'][$this->grahaKey]['rashi']
			);
			$isAspected[$key] = $grahaDrishti[$distanse];
		}
		return $isAspected;
	}
	
	/**
	 * Get association with other grahas.
	 * 
	 * @return array
	 */
	public function isAssociated()
	{
		$this->checkEnvironment();
		
		$isAssociated = array();
		
		foreach (Graha::$graha as $key => $name){
			if($key == $this->grahaKey) continue;
			
			if($this->ganitaData['graha'][$key]['rashi'] == $this->ganitaData['graha'][$this->grahaKey]['rashi']){
				$isAssociated[$key] = $name;
			}
		}
		return $isAssociated;
	}
	
	/**
	 * Returns an array of hemming grahas.
	 * 
	 * @return array
	 */
	public function isHemmed()
	{
		$this->checkEnvironment();
		
		$isHemmed = array();
		$p = 'prev';
		$n = 'next';
		
		$$p = Math::numberPrev($this->ganitaData['graha'][$this->grahaKey]['rashi']);
		$$n = Math::numberNext($this->ganitaData['graha'][$this->grahaKey]['rashi']);
		
		foreach (Graha::$graha as $key => $name){
			if($key == $this->grahaKey) continue;
			
			if($this->ganitaData['graha'][$key]['rashi'] == ${$n})
				$isHemmed[$key] = $n;
			elseif($this->ganitaData['graha'][$key]['rashi'] == ${$p})
				$isHemmed[$key] = $p;
		}
		
		if(!(array_search($p, $isHemmed) and array_search($n, $isHemmed)))
			$isHemmed = array();
		
		return $isHemmed;
	}

	/**
	 * Constructor
	 * 
     * @param null|array $options Options to set
     */
	public function __construct($options)
	{
		$this->setNaturalRelation($options);
	}
}
