<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

use DateTime;
use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Panchanga\Yoga\Yoga;
use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Panchanga\Karana\Karana;
use Jyotish\Graha\Graha;
use Jyotish\Service\Utils;

/**
 * Class to calculate the Panchanga.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Panchanga {
	
	private $_data;
	private $_paramsData;
	private $_risingData;
	
	private $_tithi = null;

	public function __construct($ganitaObject) {
		if($ganitaObject instanceof \Jyotish\Ganita\Method\Swetest){
			$this->_data = $ganitaObject->getData();
			$this->_paramsData = $ganitaObject->getParams();
			$this->_risingData = $ganitaObject->getRising();
		} else {
			throw new Exception\InvalidArgumentException(
                'Ganita method must be Swetest object.'
            );
		}
	}
	
	/**
	 * Get Tithi
	 * 
	 * @return	array
	 */
	public function getTithi(){
		$unit = 12;
		
		$lonCh = $this->_paramsData['graha'][Graha::GRAHA_CH]['longitude'];
		$lonSy = $this->_paramsData['graha'][Graha::GRAHA_SY]['longitude'];		
		
		if($lonCh < $lonSy) $lonCh = $lonCh + 360;
		
		$tithiUnits = Utils::partsToUnits(($lonCh - $lonSy), $unit);
		$tithiObject = Tithi::getInstance($tithiUnits['units']);
		
		$tithi['number'] = $tithiUnits['units'];
		$tithi['name'] = Tithi::$TITHI[$tithi['number']];
		$tithi['paksha'] = $tithiObject::$tithiPaksha;
		$tithi['left'] = ($unit - $tithiUnits['parts']) * 100 / $unit;
		
		$this->_tithi = $tithi;
		
		return $this->_tithi;
	}
	
	/**
	 * Get Nakshatra
	 * 
	 * @return	array
	 */
	public function getNakshatra(){
		$unit = 360/27;
		
		$lonCh = $this->_paramsData['graha'][Graha::GRAHA_CH]['longitude'];
		
		$nakshatraUnits = Utils::partsToUnits($lonCh, $unit);
		
		$nakshatra['number'] = $nakshatraUnits['units'];
		$nakshatra['name'] = Nakshatra::$NAKSHATRA[$nakshatra['number']];
		$nakshatra['left'] = ($unit - $nakshatraUnits['parts']) * 100 / $unit;
		
		return $nakshatra;
	}
	
	/**
	 * Get Yoga
	 * 
	 * @return	array
	 */
	public function getYoga(){
		$unit = 360/27;
		
		$lonCh = $this->_paramsData['graha'][Graha::GRAHA_CH]['longitude'];
		$lonSy = $this->_paramsData['graha'][Graha::GRAHA_SY]['longitude'];
		$lonSum = $lonCh + $lonSy;
		
		if($lonSum > 360) {
			$lonSum = $lonSum - 360;
		}
		
		$yogaUnits = Utils::partsToUnits($lonSum, $unit);
		
		$yoga['number'] = $yogaUnits['units'];
		$yoga['name'] = Yoga::$YOGA[$yoga['number']];
		$yoga['left'] = ($unit - $yogaUnits['parts']) * 100 / $unit;
		
		return $yoga;
	}
	
	/**
	 * Get Varana
	 * 
	 * @return	array
	 */
	public function getVara(){
		$dateUser = new DateTime($this->_data['date'].' '.$this->_data['time']);
		$dateUserU = $dateUser->format('U');
		$dateRising2 = new DateTime($this->_risingData[2]['rising']);
		$dateRising2U = $dateRising2->format('U');
		
		$varaNumber = $dateUser->format('w');
		
		if($dateUser >= $dateRising2) {
			$vara['number'] = $varaNumber + 1;
			
			$dateRising3 = new DateTime($this->_risingData[3]['rising']);
			$dateRising3U = $dateRising3->format('U');
			$duration = $dateRising3U - $dateRising2U;
			$vara['left'] = ($dateRising3U - $dateUserU) * 100 / $duration;
			$vara['start'] = $this->_risingData[2]['rising'];
			$vara['end'] = $this->_risingData[3]['rising'];
		} else {
			$varaNumber != 0 ? $vara['number'] = $varaNumber : $vara['number'] = 7;
			
			$dateRising1 = new DateTime($this->_risingData[1]['rising']);
			$dateRising1U = $dateRising1->format('U');
			$duration = $dateRising2U - $dateRising1U;
			$vara['left'] = ($dateRising2U - $dateUserU) * 100 / $duration;
			$vara['start'] = $this->_risingData[1]['rising'];
			$vara['end'] = $this->_risingData[2]['rising'];
		}
		
		$vara['name'] = Vara::$VARA[$vara['number']];
		
		return $vara;
	}
	
	/**
	 * Get Karana
	 * 
	 * @return array
	 */
	public function getKarana(){
		if($this->_tithi['left'] < 50){
			$number = 2;
			$left = $this->_tithi['left'];
		} else {
			$number = 1;
			$left = 100 - $this->_tithi['left'];
		}
		
		$tithiObject = Tithi::getInstance($this->_tithi['number']);
		$karanaName = $tithiObject::$tithiKarana[$number];
		$karanaNumber = array_search($karanaName, Karana::$KARANA);
		
		$karana['number'] = $karanaNumber;
		$karana['name'] = $karanaName;
		$karana['left'] = $left * 2;
		
		return $karana;
	}
}