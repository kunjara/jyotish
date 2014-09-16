<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Nakshatra\Object;

use Jyotish\Ganita\Math;

/**
 * Parent class for nakshatra objects.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class NakshatraObject {
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
	 * Nakshatra key
	 * 
	 * @var int
	 */
	protected $nakshatraKey;
	
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
	 * Type of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraType;
	
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
	 * Varna of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraVarna;
	
	/**
	 * Navatara of nakshatra.
	 * 
	 * @var string
	 */
	protected $nakshatraNavatara;
	
	/**
	 * Yoni of nakshatra.
	 * 
	 * @var array
	 */
	protected $nakshatraYoni = array();

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
	 * Get nakshatra end.
	 * 
	 * @return array
	 */
	public function getNakshatraEnd()
	{
		return $this->nakshatraEnd;
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
	 * Get nakshatra varna.
	 * 
	 * @return string
	 */
	public function getNakshatraVarna()
	{
		return $this->nakshatraVarna;
	}
	
	/**
	 * Get nakshatra prakriti.
	 * 
	 * @return string
	 */
	public function getNakshatraPrakriti()
	{
		return $this->nakshatraPrakriti;
	}
	
	/**
	 * Get nakshatra navatara.
	 * 
	 * @return string
	 */
	public function getNakshatraNavatara()
	{
		return $this->nakshatraNavatara;
	}
	
	/**
	 * Get nakshatra yoni.
	 * 
	 * @return array
	 */
	public function getNakshatraYoni()
	{
		return $this->nakshatraYoni;
	}

	/**
	 * Set nakshatra start and end.
	 * 
	 * @param bool $withAbhijit
	 * @return void
	 */
	protected function setNakshatraStartEnd($withAbhijit)
	{
		if($withAbhijit){
			switch ($this->nakshatraKey){
			case 21:
				$this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, 20);
				$this->nakshatraEnd = array('d' => 276, 'm' => 40);
				break;
			case 28:
				$this->nakshatraStart = array('d' => 276, 'm' => 40);
				$this->nakshatraEnd = array('d' => 280, 'm' => 53, 's' => 20);
				break;
			case 22:
				$this->nakshatraStart = array('d' => 280, 'm' => 53, 's' => 20);
				$this->nakshatraEnd = Math::dmsMulti(self::$nakshatraArc, 22);
				break;
			default:
				$this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, $this->nakshatraKey - 1);
				$this->nakshatraEnd = Math::dmsSum($this->getNakshatraStart(), self::$nakshatraArc);
			}
		}else{
			if($this->nakshatraKey == 28) {
				throw new Exception\InvalidArgumentException("Parameters of 28 nakshatra are determined only with argument 'withAbhijit' = true.");
			}
			
			$this->nakshatraStart = Math::dmsMulti(self::$nakshatraArc, $this->nakshatraKey - 1);
			$this->nakshatraEnd = Math::dmsSum($this->getNakshatraStart(), self::$nakshatraArc);
		}
	}
	
	/**
	 * Set nakshatra navatara.
	 * 
	 * @return void
	 */
	protected function setNakshatraNavatara()
	{
		if($this->nakshatraKey == 28){
			$result = null;
		}else{
			$result = Math::numberInCycle($this->nakshatraKey, 1, 9);
		}
		
		$this->nakshatraNavatara = $result;
	}
	
	/**
	 * Constructor
	 * 
     * @param array $options
     */
	public function __construct($options)
	{
		$this->setNakshatraStartEnd($options['withAbhijit']);
		$this->setNakshatraNavatara();
	}
}
