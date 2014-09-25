<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha\Bhuta;
use Jyotish\Tattva\Maha\Disha;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Ayurveda\Dhatu;
use Jyotish\Tattva\Ayurveda\Prakriti;
use Jyotish\Tattva\Ayurveda\Rasa;

/**
 * Class of graha Bu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaKey = 'Bu';
	
	/**
	 * Devanagari title 'budha' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'ba','u','dha'
	);
	
	protected $grahaAvatara = 'Budda';
	protected $grahaUnicode = '263F';
	protected $grahaAltName = array
	();
	protected $grahaAgeMaturity = 32;
	protected $grahaAgePeriod = array
	(
		'start' => 5,
		'end' => 14
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaCharacter = Graha::CHARACTER_BENEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaDeva = Deva::DEVA_VISHNU_MAHA;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
	 */
	protected $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
	 */
	protected $grahaBhuta = Bhuta::BHUTA_PRITVI;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
	 */
	protected $grahaVarna = Manusha::VARNA_VAISHYA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
	 */
	protected $grahaGuna = Guna::GUNA_RAJA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
	 */
	protected $grahaDhatu = array
	(
		Dhatu::DHATU_RASA,
	);
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
	 */
	protected $grahaRasa = Rasa::RASA_MISHRA;
	
	/**
	 * Graha exaltation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
	 */
	protected $grahaExaltation = array
	(
		'rashi' => 6,
		'degree' => 15
	);
	
	/**
	 * Graha debilitation.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
	 */
	protected $grahaDebilitation = array
	(
		'rashi' => 12,
		'degree' => 15
	);
	
	/**
	 * Graha mooltrikon.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
	 */
	protected $grahaMooltrikon = array
	(
		'rashi' => 6,
		'start' => 15,
		'end' => 20
	);
	
	/**
	 * Own sign of the graha.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
	 */
	protected $grahaOwn = array
	(
		'positive' => array
		(
			'rashi' => 3,
			'start' => 0,
			'end' => 30
		),
		'negative' => array
		(
			'rashi' => 6,
			'start' => 20,
			'end' => 30
		)
	);
	
	/**
	 * Graha disha
	 * 
	 * @var string
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected $grahaDisha = Disha::DISHA_UTTARA;
	
	/**
	 * Graha drishti
	 * 
	 * @var array
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
	 */
	protected $grahaDrishti = array
	(
		1 => 1,
		2 => 0,
		3 => 0.25,
		4 => 0.75,
		5 => 0.5,
		6 => 0,
		7 => 1,
		8 => 0.75,
		9 => 0.5,
		10 => 0.25,
		11 => 0,
		12 => 0,
	);
	
	/**
	 * Prakriti of graha
	 * 
	 * @var array
	 */
	protected $grahaPrakriti = array
	(
		Prakriti::PRAKRITI_KAPHA,
		Prakriti::PRAKRITI_PITTA,
		Prakriti::PRAKRITI_VATA
	);

	public function __construct($options)
	{
		parent::__construct($options);
	}

	/**
	 * Set environment.
	 * 
	 * @param array $ganitaData
	 */
	public function setEnvironment(array $ganitaData)
	{
		parent::setEnvironment($ganitaData);
		
		$this->setGrahaCharacter();
	}
	
	/**
	 * Set graha character.
	 * 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
	 */
	protected function setGrahaCharacter()
	{
		foreach($this->ganitaData['graha'] as $key => $params){
			if($key == $this->grahaKey) continue;
			
			if($params['rashi'] == $this->ganitaData['graha'][$this->grahaKey]['rashi']){
				$G = Graha::getInstance($key);
				$G->setEnvironment($this->ganitaData);

				if($G->getGrahaCharacter() == Graha::CHARACTER_BENEFIC)
					$benefic = $benefic + 1;
				else
					$malefic = $malefic + 1;
			}
		}
		
		if($benefic > 0 and $malefic > 0)
			$this->grahaCharacter = Graha::CHARACTER_MISHA;
		elseif($malefic > 0)
			$this->grahaCharacter = Graha::CHARACTER_MALEFIC;
		else
			$this->grahaCharacter = Graha::CHARACTER_BENEFIC;
	}
}