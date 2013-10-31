<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga;

use DateTime;
use DateInterval;
use Jyotish\Ganita\Time;
use Jyotish\Panchanga\Tithi\Tithi;
use Jyotish\Panchanga\Nakshatra\Nakshatra;
use Jyotish\Panchanga\Yoga\Yoga;
use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Panchanga\Karana\Karana;
use Jyotish\Graha\Graha;
use Jyotish\Service\Utils;
use Jyotish\Calendar\Masa;

/**
 * Class to calculate the Panchanga.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Panchanga {
	
	private $_ganitaObject;
	private $_userData;
	private $_paramsData;
	private $_risingData;
	
	private $_tithi = null;

	public function __construct($ganitaObject)
	{
		if($ganitaObject instanceof \Jyotish\Ganita\Method\Swetest){
			$this->_ganitaObject = $ganitaObject;
			$this->_setData();
			$this->_risingData = $this->_ganitaObject->getRising();
		} else {
			throw new Exception\InvalidArgumentException(
                'Ganita method must be Swetest object.'
            );
		}
	}
	
	public function __clone()
	{
		$this->_ganitaObject = clone $this->_ganitaObject;
	}

	/**
	 * Get Tithi
	 * 
	 * @param	boolean $withLimit
	 * @return	array
	 */
	public function getTithi($withLimit = false)
	{
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
		
		if($withLimit){
			$limits = $this->_limitAnga($tithi, __FUNCTION__);
			$tithi['end'] = $limits['end'];
		}
		
		$this->_tithi = $tithi;
		
		return $this->_tithi;
	}
	
	/**
	 * Get Nakshatra
	 * 
	 * @param	boolean $withLimit
	 * @return	array
	 */
	public function getNakshatra($withLimit = false)
	{
		$unit = 360/27;
		
		$lonCh = $this->_paramsData['graha'][Graha::GRAHA_CH]['longitude'];
		
		$nakshatraUnits = Utils::partsToUnits($lonCh, $unit);
		
		$nakshatra['number'] = $nakshatraUnits['units'];
		$nakshatra['name'] = Nakshatra::$NAKSHATRA[$nakshatra['number']];
		$nakshatra['left'] = ($unit - $nakshatraUnits['parts']) * 100 / $unit;
		
		if($withLimit){
			$limits = $this->_limitAnga($nakshatra, __FUNCTION__);
			$nakshatra['end'] = $limits['end'];
		}
		
		return $nakshatra;
	}
	
	/**
	 * Get Yoga
	 * 
	 * @param	boolean $withLimit
	 * @return	array
	 */
	public function getYoga($withLimit = false)
	{
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
		
		if($withLimit){
			$limits = $this->_limitAnga($yoga, __FUNCTION__);
			$yoga['end'] = $limits['end'];
		}
		
		return $yoga;
	}
	
	/**
	 * Get Varana
	 * 
	 * @return	array
	 */
	public function getVara()
	{
		$dateUser = new DateTime($this->_userData['date'].' '.$this->_userData['time']);
		$dateUserU = $dateUser->format('U');
		$dateRising2 = new DateTime($this->_risingData['time'][2]['rising']);
		$dateRising2U = $dateRising2->format('U');
		
		$varaNumber = $dateUser->format('w');
		
		if($dateUser >= $dateRising2) {
			$vara['number'] = $varaNumber + 1;
			
			$dateRising3 = new DateTime($this->_risingData['time'][3]['rising']);
			$dateRising3U = $dateRising3->format('U');
			$duration = $dateRising3U - $dateRising2U;
			$vara['left'] = ($dateRising3U - $dateUserU) * 100 / $duration;
			$vara['start'] = $this->_risingData['time'][2]['rising'];
			$vara['end'] = $this->_risingData['time'][3]['rising'];
		} else {
			$varaNumber != 0 ? $vara['number'] = $varaNumber : $vara['number'] = 7;
			
			$dateRising1 = new DateTime($this->_risingData['time'][1]['rising']);
			$dateRising1U = $dateRising1->format('U');
			$duration = $dateRising2U - $dateRising1U;
			$vara['left'] = ($dateRising2U - $dateUserU) * 100 / $duration;
			$vara['start'] = $this->_risingData['time'][1]['rising'];
			$vara['end'] = $this->_risingData['time'][2]['rising'];
		}
		
		$vara['name'] = Vara::$VARA[$vara['number']];
		
		return $vara;
	}
	
	/**
	 * Get Karana
	 * 
	 * @param	boolean $withLimit
	 * @return	array
	 */
	public function getKarana($withLimit = false)
	{
		if($this->_tithi['left'] < 50){
			$number = 2;
			$left = $this->_tithi['left'];
			if($withLimit)
				$karana['end'] = $this->_tithi['end'];
		} else {
			$number = 1;
			$left = $this->_tithi['left'] - 50;
			if($withLimit){
				$dateUser = new DateTime($this->_userData['date'].' '.$this->_userData['time']);
				$tithiEnd = new DateTime($this->_tithi['end']);
				$dateUserU = $dateUser->format('U');
				$tithiEndU = $tithiEnd->format('U');
				$timeHalfU = round(($tithiEndU - $dateUserU) * 50 / $this->_tithi['left']);
				$karana['end'] = $tithiEnd->sub(new DateInterval('PT'.$timeHalfU.'S'))->format(Time::FORMAT_DATA_DATE.' '.Time::FORMAT_DATA_TIME);
			}
		}
		
		$tithiObject = Tithi::getInstance($this->_tithi['number']);
		$karanaName = $tithiObject::$tithiKarana[$number];
		$karanaNumber = array_search($karanaName, Karana::$KARANA);
		
		$karana['number'] = $karanaNumber;
		$karana['name'] = $karanaName;
		$karana['left'] = $left * 2;
		
		return $karana;
	}
	
	/**
	 * Set data for Panchanga
	 * 
	 * @param array $data
	 */
	private function _setData(array $data = null)
	{
		if(!is_null($data)) $this->_ganitaObject->setData($data);
		
		$this->_userData = $this->_ganitaObject->getData();
		$this->_paramsData = $this->_ganitaObject->getParams();
	}
	
	/**
	 * Calculate Anga limits
	 * 
	 * @param array $anga
	 * @param string $function
	 * @return array
	 */
	private function _limitAnga($anga, $function = 'getTithi')
	{
		if($function == 'getTithi' or $function == 'getYoga')
			$durMonth = Masa::DUR_SYNODIC * 86400;
		elseif($function == 'getNakshatra') 
			$durMonth = Masa::DUR_SIDERIAL * 86400;
		
		$dateUser		= new DateTime($this->_userData['date'].' '.$this->_userData['time']);
		$timeEndAdd		= round($durMonth * $anga['left'] / 30 / 100 / 2);
		$Panchanga		= clone $this;
		
		// End time
		do {
			$timeEndObject = $dateUser->add(new DateInterval('PT'.$timeEndAdd.'S'));
			$Panchanga->_setData(array(
					'date' => $timeEndObject->format(Time::FORMAT_DATA_DATE), 
					'time' => $timeEndObject->format(Time::FORMAT_DATA_TIME)
			));
			
			$angaEnd = $Panchanga->$function();
			$timeEndAdd = round($durMonth * $angaEnd['left'] / 30 / 100 / 2);
		} while($angaEnd['left'] > .1);
		
		$data = $Panchanga->_ganitaObject->getData();
		$result = array(
			'end' => $data['date'].' '.$data['time']
		);
		
		unset($Panchanga);
		return $result;
	}
}