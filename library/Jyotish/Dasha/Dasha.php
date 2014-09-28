<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha;

use DateInterval;
use Jyotish\Base\Utils;
use Jyotish\Ganita\Time;

/**
 * Dasha class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class Dasha {
	const NESTING_MAX = 3;
	
	const NESTING_1 = 'Mahadasha';
	const NESTING_2 = 'Antardasha';
	const NESTING_3 = 'Pratyantardasha';
	const NESTING_4 = 'Sookshma-antardasha';
	const NESTING_5 = 'Prana-antardasha';
	const NESTING_6 = 'Deha-antardasha';
	
	const DASHA_VIMSHOTTARI = 'Vimshottari';
	const DASHA_ASHTOTTARI	= 'Ashtottari';
	
	static public $DASHA = array(
		self::DASHA_VIMSHOTTARI,
		self::DASHA_ASHTOTTARI,
	);
	
	static private $_dashaAbbr;
	static private $_dashaObject;
	
	
	
	/**
	 * Get start period.
	 * 
	 * @abstract
	 * @param array $nakshatra
	 * @return array
	 */
	abstract public function getStartPeriod(array $nakshatra);
	
	/**
	 * Get the order of the grahas.
	 * 
	 * @abstract
	 * @param string $graha
	 * @param int $nesting
	 * @return array
	 */
	abstract public function getOrderGraha($graha, $nesting = null);

	public function durationTotal()
	{
		return static::$_durationTotal;
	}

	public function durationGraha()
	{
		return static::$_durationGraha;
	}
	
	public function orderNakshatra()
	{
		return static::$_orderNakshatra;
	}

	static public function getInstance($abbr) {
		if (!in_array($abbr, self::$DASHA)) {
			throw new Exception\InvalidArgumentException("Dasha '$abbr' does not exist.");
		}
		
		$dashaClass = 'Jyotish\Dasha\Object\\' . $abbr;
		$dashaObject = new $dashaClass();
		self::$_dashaAbbr = $abbr;
		self::$_dashaObject = $dashaObject;
		
		return self::$_dashaObject;
	}
	
	
	/**
	 * Get all periods and subperiods.
	 * 
	 * @param \Jyotish\Panchanga\Panchanga $panchanga
	 * @param int $nestingMax
	 * @return array
	 */
	public function getDashaPeriods(\Jyotish\Panchanga\Panchanga $panchanga, $nestingMax = 3)
	{
		if(!is_numeric($nestingMax) || intval($nestingMax) > self::NESTING_MAX){
			throw new Exception\InvalidArgumentException(
                "Maximum nesting must be less than or equals 6."
            );
		}
		
		if(self::$_dashaAbbr == self::DASHA_ASHTOTTARI)
			$withAbhijit = true;
		else
			$withAbhijit = false;
		
		$userData		= $panchanga->getData();
		$dateTimeString = $userData['date'] . ' ' . $userData['time'];
		$dateTimeFormat = Time::FORMAT_DATA_DATE . ' ' . Time::FORMAT_DATA_TIME;
		$this->_dateTimeObject = Time::getDateTimeUtc($dateTimeFormat, $dateTimeString, $userData['timezone']);
		
		$nakshatra	= $panchanga->getNakshatra(true, $withAbhijit);
		$periodData = self::$_dashaObject->getStartPeriod($nakshatra);
		
		$this->_dateTimeObject->sub(new DateInterval('PT'.$periodData['start'].'S'));
		$periodStartString = $this->_dateTimeObject->format(Time::FORMAT_DATETIME);
		$this->_dateTimeObject->add(new DateInterval('PT'.$periodData['total'].'S'));
		$periodEndString = $this->_dateTimeObject->format(Time::FORMAT_DATETIME);

		$periodOrder	= Utils::shiftArray(self::$_dashaObject->durationGraha(), $periodData['graha']);
		
		$periodTotal = array(
			'nesting'	=> 0,
			'name'		=> self::$_dashaAbbr,
			'duration'	=> $periodData['total'],
			'start'		=> $periodStartString,
			'end'		=> $periodEndString,
			'order'		=> $periodOrder,
		);
		
		$periodsCalc	= $this->_calcDashaPeriods($periodTotal, $nestingMax);
		
		return $periodsCalc;
	}
	
	/**
	 * Recursive calculation of periods.
	 * 
	 * @param array $periodData
	 * @param int $nestingMax
	 * @return array
	 */
	private function _calcDashaPeriods($periodData, $nestingMax = 3)
	{
		$i = 0;
		foreach($periodData['order'] as $graha => $info){
			$i++;

			$nesting = $periodData['nesting'] + 1;
			$periodData[$graha]['nesting'] = $nesting;
			
			$name = 'NESTING_'.$nesting;
			$periodData[$graha]['name'] = constant('self::'.$name);
			
			$durationGraha = self::$_dashaObject->durationGraha();
			$duration = round($periodData['duration'] * $durationGraha[$graha] / self::$_dashaObject->durationTotal());
			$periodData[$graha]['duration'] = $duration;
			
			if($i == 1){
				$this->_dateTimeObject = Time::getDateTimeUtc(Time::FORMAT_DATETIME, $periodData['start']);
				$periodData[$graha]['start'] = $this->_dateTimeObject->format(Time::FORMAT_DATETIME);
			}else{
				$periodData[$graha]['start'] = $this->_dateTimeObject->format(Time::FORMAT_DATETIME);
			}
			
			//if($i == count($periodData['order'])){
			//	$periodData[$graha]['end'] = $periodData['end'];
			//}else{
				$this->_dateTimeObject->add(new DateInterval('PT'.$duration.'S'));
				$periodData[$graha]['end'] = $this->_dateTimeObject->format(Time::FORMAT_DATETIME);
			//}
			
			// Define subperiods
			if($nesting < $nestingMax){
				$periodData[$graha]['order'] = self::$_dashaObject->getOrderGraha($graha, $nesting);
				$periodData[$graha]	= $this->_calcDashaPeriods($periodData[$graha]);
			}else{
				$periodData[$graha]['order'] = null;
			}
		}
				
		return $periodData;
	}
}