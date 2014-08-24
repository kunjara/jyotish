<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha {
	const GRAHA_SY = 'Sy';
	const GRAHA_CH = 'Ch';
	const GRAHA_MA = 'Ma';
	const GRAHA_BU = 'Bu';
	const GRAHA_GU = 'Gu';
	const GRAHA_SK = 'Sk';
	const GRAHA_SA = 'Sa';
	const GRAHA_RA = 'Ra';
	const GRAHA_KE = 'Ke';
	
	const LAGNA = 'Lg';
	
	const CHARACTER_BENEFIC = 'benefic';
	const CHARACTER_MALEFIC = 'malefic';
	
	/**
	 * Names of Grahas.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
	 */
	static public $GRAHA = array(
		self::GRAHA_SY => 'Surya',
		self::GRAHA_CH => 'Chandra',
		self::GRAHA_MA => 'Mangala',
		self::GRAHA_BU => 'Budha',
		self::GRAHA_GU => 'Guru',
		self::GRAHA_SK => 'Shukra',
		self::GRAHA_SA => 'Shani',
		self::GRAHA_RA => 'Rahu',
		self::GRAHA_KE => 'Ketu'
	);
	/**
	 * Devanagari title 'graha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'ga','virama','ra','ha'
	);
	
	protected $grahaTranslit;
	protected $grahaAvatara;
	protected $grahaUnicode;
	protected $grahaAltName = array();
	protected $grahaOwn = array();
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
	 * Returns the requested instance of graha class.
	 * 
	 * @param string $abbr The acronym of graha.
	 * @param array $options
	 * @return the requested instance of graha class.
	 */
	static public function getInstance($abbr, array $options = null) {
		if (array_key_exists($abbr, self::$GRAHA)) {
			$grahaClass = 'Jyotish\Graha\Object\\' . $abbr;
			$grahaObject = new $grahaClass($options);

			return $grahaObject;
		} else {
			throw new Exception\InvalidArgumentException("Graha with the acronym '$abbr' does not exist.");
		}
	}

}