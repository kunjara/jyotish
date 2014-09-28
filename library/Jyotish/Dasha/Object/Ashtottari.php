<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use Jyotish\Base\Utils;
use Jyotish\Graha\Graha;
use Jyotish\Calendar\Samvatsara;
use Jyotish\Panchanga\Nakshatra\Nakshatra;

/**
 * Class of Ashtottari Dasha
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 46, Verse 17-23.
 */
class Ashtottari extends \Jyotish\Dasha\Dasha {
	static protected $_durationTotal = 108;
	
	static protected $_durationGraha = array(
		Graha::GRAHA_SY => 6,
		Graha::GRAHA_CH => 15,
		Graha::GRAHA_MA => 8,
		Graha::GRAHA_BU => 17,
		Graha::GRAHA_SA => 10,
		Graha::GRAHA_GU => 19,
		Graha::GRAHA_RA => 12,
		Graha::GRAHA_SK => 21,
	);
	
	static protected $_orderNakshatra = array();



	public function __construct()
	{
		$nakshatras = Nakshatra::nakshatraList(true);
		
		self::$_orderNakshatra = Utils::shiftArray($nakshatras, 6, true);
	}
	
	/**
	 * Get start period.
	 * 
	 * @param array $nakshatra
	 * @return array
	 */
	public function getStartPeriod(array $nakshatra)
	{
		$keysNakshatra	= array_keys(self::$_orderNakshatra);
		$indexNum		= array_search($nakshatra['number'], $keysNakshatra) + 1;
		
		foreach (self::$_durationGraha as $key => $value){
			$G = Graha::getInstance($key);
			if($G->getGrahaCharacter() == Graha::CHARACTER_MALEFIC){
				$part = 4;
			}else{
				$part = 3;
			}
			
			$partSum = $partSum + $part;
			if($partSum >= $indexNum)
				break;
		}
		
		$num = $part - ($partSum - $indexNum);
		
		$result['graha'] = $key;
		$result['total'] = round($this->durationTotal() * Samvatsara::DUR_GREGORIAN * 86400);
		
		$durationGraha		= $this->durationGraha();
		$durationNakshatra	= round($durationGraha[$key] * Samvatsara::DUR_GREGORIAN * 86400 / $part);
		$result['start']	= $durationNakshatra * ($num - 1) + round($durationNakshatra * (100 - $nakshatra['left']) / 100);
		
		return $result;
	}
	
	/**
	 * Get the order of the grahas.
	 * 
	 * @param string $graha
	 * @param int $nesting
	 * @return array
	 */
	public function getOrderGraha($graha, $nesting = null)
	{
		$result = Utils::shiftArray($this->durationGraha(), $graha);
		next($result);
		$nextGraha = key($result);
		$nextResult = Utils::shiftArray($this->durationGraha(), $nextGraha);
		
		return $nextResult;
	}
}