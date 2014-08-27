<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra;

use Jyotish\Ganita\Math;

/**
 * Class with Nakshatra names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Nakshatra {
	
	const PADA_1 = 1;
	const PADA_2 = 2;
	const PADA_3 = 3;
	const PADA_4 = 4;
	
	const TYPE_DHRUVA = 'dhruva';
	const TYPE_CHARANA = 'charana';
	const TYPE_TIKSHNA = 'tikshna';
	const TYPE_MRIDU = 'mridu';
	const TYPE_SADHARANA = 'sadharana';
	const TYPE_UGRA = 'ugra';
	const TYPE_KSHIPRA = 'kshipra';
	
	const ENERGY_SRISHTI = 'srishti';
	const ENERGY_STHITI = 'sthiti';
	const ENERGY_LAYA = 'laya';

	/**
	 * Array of all nakshatras.
	 * 
	 * @var array 
	 */
	static public $NAKSHATRA = array(
		1 => 'Ashwini',
		2 => 'Bharani',
		3 => 'Krittika',
		4 => 'Rohini',
		5 => 'Mrigashirsha',
		6 => 'Ardra',
		7 => 'Punarvasu',
		8 => 'Pushya',
		9 => 'Ashlesha',
		10 => 'Magha',
		11 => 'Poorva Phalguni',
		12 => 'Uttara Phalguni',
		13 => 'Hasta',
		14 => 'Chitra',
		15 => 'Swati',
		16 => 'Vishakha',
		17 => 'Anuradha',
		18 => 'Jyeshtha',
		19 => 'Moola',
		20 => 'Purva Ashadha',
		21 => 'Uttara Ashadha',
		22 => 'Shravana',
		23 => 'Dhanishta',
		24 => 'Shatabhisha',
		25 => 'Purva Bhadrapada',
		26 => 'Uttara Bhadrapada',
		27 => 'Revati',
		28 => 'Abhijit'
	);
	
	/**
	 * Devanagari title 'nakshatra' in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	static public $translit = array(
		'na','ka','virama','ssa','ta','virama','ra'
	);
	
	/**
	 * Arc length of the nakshatra.
	 * 
	 * @var array 
	 */
	static public $nakshatraArc = array(
		'd' => 13,
		'm' => 20,
		's' => 0
	);
	
	/**
	 * Devanagari nakshatra title in transliteration.
	 * 
	 * @var array
	 * @see Jyotish\Alphabet\Devanagari
	 */
	protected $nakshatraTranslit = array();
	
	/**
	 * Nakshatra start.
	 * 
	 * @var array
	 */
	protected $nakshatraStart = array();
	
	/**
	 * Nakshatra end.
	 * 
	 * @var array
	 */
	protected $nakshatraEnd = array();
	
	/**
	 * Deva of nakshatra.
	 * 
	 * @var mixed
	 */
	protected $nakshatraDeva;
	
	/**
	 * Energy of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraEnergy;
	
	/**
	 * Gana of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraGana;
	
	/**
	 * Gender of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraGender;
	
	/**
	 * 
	 * 
	 * @var string
	 */
	protected $nakshatraGraha;
	
	/**
	 * Guna of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraGuna;
	
	/**
	 * Purushartha of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraPurushartha;
	
	/**
	 * Type of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraType;
	
	/**
	 * Varna of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraVarna;
	
	/**
	 * Get nakshatra translit.
	 * 
	 * @return array
	 */
	public function getNakshatraTranslit()
	{
		return $this->nakshatraTranslit;
	}
	
	/**
	 * Get nakshatra start.
	 * 
	 * @return array
	 */
	public function getNakshatraStart()
	{
		return $this->nakshatraStart;
	}
	
	/**
	 * Set nakshatra start.
	 * 
	 * @param array $dms Start arc of nakshatra
	 */
	protected function setNakshatraStart($dms)
	{
		$this->nakshatraStart = $dms;
	}
	
	/**
	 * Get nakshatra end.
	 * 
	 * @return array
	 */
	public function getNakshatraEnd()
	{
		return $this->nakshatraEnd;
	}
	
	/**
	 * Set nakshatra end.
	 * 
	 * @param array $dms End arc of nakshatra
	 */
	protected function setNakshatraEnd($dms)
	{
		$this->nakshatraEnd = $dms;
	}
	
	/**
	 * Get nakshatra Deva.
	 * 
	 * @return mixed
	 */
	public function getNakshatraDeva()
	{
		return $this->nakshatraDeva;
	}
	
	/**
	 * Get nakshatra energy.
	 * 
	 * @return string
	 */
	public function getNakshatraEnergy()
	{
		return $this->nakshatraEnergy;
	}
	
	/**
	 * Get nakshatra gana.
	 * 
	 * @return string
	 */
	public function getNakshatraGana()
	{
		return $this->nakshatraGana;
	}
	
	/**
	 * Get nakshatra gender.
	 * 
	 * @return string
	 */
	public function getNakshatraGender()
	{
		return $this->nakshatraGender;
	}
	
	/**
	 * Get nakshatra Graha.
	 * 
	 * @return string
	 */
	public function getNakshatraGraha()
	{
		return $this->nakshatraGraha;
	}
	
	/**
	 * Get nakshatra guna.
	 * 
	 * @return string
	 */
	public function getNakshatraGuna()
	{
		return $this->nakshatraGuna;
	}
	
	/**
	 * Get nakshatra purushartha.
	 * 
	 * @return string
	 */
	public function getNakshatraPurushartha()
	{
		return $this->nakshatraPurushartha;
	}
	
	/**
	 * Get nakshatra type.
	 * 
	 * @return string
	 */
	public function getNakshatraType()
	{
		return $this->nakshatraType;
	}
	
	/**
	 * Get nakshatra varna.
	 * 
	 * @return string
	 */
	public function getNakshatraVarna()
	{
		return $this->nakshatraVarna;
	}

	/**
	 * Returns the requested instance of nakshatra class.
	 * 
	 * @param int $number The number of nakshatra.
	 * @param array $options
	 * @return the requested instance of nakshatra class.
	 */
	static public function getInstance($number, array $options = null)
	{
		if (!array_key_exists($number, self::$NAKSHATRA)) {
			throw new Exception\InvalidArgumentException("Nakshatra with the number '$number' does not exist.");
		}
		
		$nakshatraClass = 'Jyotish\\Panchanga\\Nakshatra\\Object\\N' . $number;
		$nakshatraObject = new $nakshatraClass($options);
		
		if($options['withAbhijit']){
			switch ($number){
			case 21:
				$nakshatraObject->setNakshatraStart(Math::dmsMulti(self::$nakshatraArc, 20));
				$nakshatraObject->setNakshatraEnd(array('d' => 276, 'm' => 40));
				break;
			case 28:
				$nakshatraObject->setNakshatraStart(array('d' => 276, 'm' => 40));
				$nakshatraObject->setNakshatraEnd(array('d' => 280, 'm' => 53, 's' => 20));
				break;
			case 22:
				$nakshatraObject->setNakshatraStart(array('d' => 280, 'm' => 53, 's' => 20));
				$nakshatraObject->setNakshatraEnd(Math::dmsMulti(self::$nakshatraArc, 22));
				break;
			default:
				$nakshatraObject->setNakshatraStart(Math::dmsMulti(self::$nakshatraArc, $number - 1));
				$nakshatraObject->setNakshatraEnd(Math::dmsSum($nakshatraObject->getNakshatraStart(), self::$nakshatraArc));
			}
		}else{
			if($number == 28) {
				throw new Exception\InvalidArgumentException("Parameters of 28 nakshatra are determined only with argument 'withAbhijit' = true.");
			}
			
			$nakshatraObject->setNakshatraStart(Math::dmsMulti(self::$nakshatraArc, $number - 1));
			$nakshatraObject->setNakshatraEnd(Math::dmsSum($nakshatraObject->getNakshatraStart(), self::$nakshatraArc));
		}
		
		return $nakshatraObject;
	}
	
	static public function nakshatraList($withAbhijit = false)
	{
		$nakshatras = self::$NAKSHATRA;
		
		if($withAbhijit){
			$result = 
				array_slice($nakshatras, 0, 21, true) +
				array_slice($nakshatras, -1, 1, true) + 
				array_slice($nakshatras, 21, 6, true); 
		}else{
			unset($nakshatras[28]);
			$result = $nakshatras;
		}
		return $result;
	}
	
}