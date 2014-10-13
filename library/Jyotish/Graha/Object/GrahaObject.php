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
use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Parent class for graha objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class GrahaObject extends Object {
	/**
	 * Object type
	 * 
	 * @var string
	 */
	protected $objectType = 'graha';

	/**
	 * Devanagari graha title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit;
	
	protected $grahaAvatara;
	protected $grahaUnicode;
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
	 * Get alternative graha names.
	 * 
	 * @return array
	 */
	public function getGrahaAltName()
	{
		return $this->objectAltName;
	}

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
	 * Get bhava, where graha is positioned.
	 * 
	 * @return string
	 */
	public function getBhava()
	{
		$this->checkEnvironment();
		
		$grahaRashi = $this->ganitaData['graha'][$this->objectKey]['rashi'];
		do{
			$bhava++;
			$bhavaRashi = $this->ganitaData['bhava'][$bhava]['rashi'];
		}
		while($grahaRashi <> $bhavaRashi);
		
		return $bhava;
	}

	/**
	 * Set alternative graha names.
	 */
	protected function setGrahaAltName()
	{
		if($this->objectKey != 'Ra' and $this->objectKey != 'Ke'){
			$grahaAltName = 'deva'.$this->objectName;
			$this->objectAltName = Deva::${$grahaAltName};
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
		$friendsFromMt = [2, 4, 5, 8, 9, 12];
		$enemiesFromMt = [3, 6, 7, 10, 11];
		
		$rashiMool = $this->grahaMool['rashi'];
		$rashiUcha = $this->grahaUcha['rashi'];
		
		$friends = array();
		$R = Rashi::getInstance($rashiUcha);
		$gFriend = $R->getRashiRuler();
		if($this->objectKey != $gFriend) $friends[] = $gFriend;
		
		$relation = function($distance) use($rashiMool){
			foreach($distance as $step){
				$r = Math::numberInCycle($rashiMool, $step);
				$R = Rashi::getInstance((int)$r);
				$gRuler = $R->getRashiRuler();

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
				$relationships[$key] = $G->getNaturalRelation($this->objectKey);
			}
		}
		$relationships[$this->objectKey] = $options['relationSame'] ? 1 : null;
		
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
	 * Constructor
	 * 
     * @param null|array $options Options to set
     */
	public function __construct($options)
	{
		$this->setGrahaAltName();
		$this->setNaturalRelation($options);
	}
}
