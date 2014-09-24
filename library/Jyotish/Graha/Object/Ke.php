<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha\Disha;
use Jyotish\Tattva\Maha\Guna;
use Jyotish\Tattva\Jiva\Dwipada\Manusha;

/**
 * Class of graha Ke.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ke extends GrahaObject {
	/**
	 * Abbreviation of the graha
	 * 
	 * @var string
	 */
	protected $grahaKey = 'Ke';
	
	/**
	 * Devanagari title 'ketu' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $grahaTranslit = array(
		 'ka','e','ta','u'
	);
	
	protected $grahaAvatara = 'Matsya';
	protected $grahaUnicode = '260B';
	protected $grahaAltName = array
	();
	protected $grahaAgeMaturity = 48;
	protected $grahaAgePeriod = array
	(
		'start' => 69,
		'end' => 108
	);
	
	/**
	 * Character of the Graha.
	 * 
	 * @var string
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
	 */
	protected $grahaCharacter = Graha::CHARACTER_MALEFIC;
	
	/**
	 * Deva of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaDeva = null;
	
	/**
	 * Gender of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaGender = Manusha::GENDER_NEUTER;
	
	/**
	 * Bhuta of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaBhuta = null;
	
	/**
	 * Varna of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaVarna = Manusha::VARNA_MLECHHA;
	
	/**
	 * Guna of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaGuna = Guna::GUNA_TAMA;
	
	/**
	 * Dhatu of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaDhatu = null;
	
	/**
	 * Rasa of the Graha.
	 * 
	 * @var string
	 */
	protected $grahaRasa = null;
	
	/**
	 * Graha disha
	 * 
	 * @var string
	 */
	protected $grahaDisha = Disha::DISHA_NAIRUTYA;
	
	/**
	 * Graha drishti
	 * 
	 * @var array
	 */
	protected $grahaDrishti = null;
	
	/**
	 * Prakriti of graha
	 * 
	 * @var array
	 */
	protected $grahaPrakriti = null;

	/**
	 * Set exaltation, sebilitation, mooltrikon and own.
	 * 
	 * @param null|array $options Options to set
	 */
	protected function setSpecificRashiByViewpoint($options){
		switch ($options['specificRashi']){
			case('para'):
				$this->setSpecificRashi(array('ex' => 8, 'mt' => 9, 'ow' => 5, 'db' => 2));
				break;
			default:
				$this->setSpecificRashi(array('ex' => 9, 'mt' => 5, 'ow' => 12, 'db' => 3));
				break;
		}
	}
	
	/**
	 * Set natural relationships.
	 * 
	 * @param null|array $options Options to set
	 */
	protected function setNaturalRelation($options)
	{
		if($options['relationChaya'] == 'sama'){
			$this->grahaRelation = array(
				Graha::GRAHA_SY => -1,
				Graha::GRAHA_CH => -1,
				Graha::GRAHA_MA => 1,
				Graha::GRAHA_BU => 1,
				Graha::GRAHA_GU => 0,
				Graha::GRAHA_SK => 1,
				Graha::GRAHA_SA => -1,
				Graha::GRAHA_RA => -1,
			);
		}else{
			foreach (Graha::$graha as $key => $name){
				if($key != Graha::GRAHA_RA){
					$this->grahaRelation[$key] = -1;
				}else{
					$this->grahaRelation[$key] = 1;
				}
			}
		}
		
		$this->grahaRelation[$this->grahaKey] = $options['relationSame'] ? 1 : null;
	}

	public function __construct($options) {
		$this->setSpecificRashiByViewpoint($options);
		
		parent::__construct($options);
	}

}