<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use DateTime;
use DateInterval;
use DateTimeZone;
use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Ayanamsha;
use Jyotish\Ganita\Method\Calc;

/**
 * Class to calculate the positions of the planets using the application swetest.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Swetest {

	const RISING_NOREFRAC   = 'norefrac';
	const RISING_DISCCENTER = 'disccenter';
	const RISING_HINDU      = 'hindu';
	
	private $_swe = array(
		'swetest'   => null,
		'sweph'     => null,
	);
			
	private $_data = array(
		'date'      => null,
		'time'      => null,
		'timezone'  => 'UTC',
		'offset'    => 0,
		'longitude' => 0,
		'latitude'  => 0,
	);
	
	private $_ayanamsha = Ayanamsha::AYANAMSHA_LAHIRI;
	private $_rising    = self::RISING_HINDU;
	
	static public $inputAyanamsha = array(
		Ayanamsha::AYANAMSHA_FAGAN => '0',
		Ayanamsha::AYANAMSHA_LAHIRI => '1',
		Ayanamsha::AYANAMSHA_DELUCE => '2',
		Ayanamsha::AYANAMSHA_RAMAN => '3',
		Ayanamsha::AYANAMSHA_USHASHASHI => '4',
		Ayanamsha::AYANAMSHA_KRISHNAMURTI => '5',
		Ayanamsha::AYANAMSHA_DJWHALKHUL => '6',
		Ayanamsha::AYANAMSHA_YUKTESHWAR => '7',
		Ayanamsha::AYANAMSHA_JNBHASIN => '8',
		Ayanamsha::AYANAMSHA_SASSANIAN => '16',
	);
	
	static public $inputRising = array(
		self::RISING_NOREFRAC,
		self::RISING_DISCCENTER,
		self::RISING_HINDU,
	);
	
	static public $inputPlanets = array(
		Graha::GRAHA_SY => '0',
		Graha::GRAHA_CH => '1',
		Graha::GRAHA_BU => '2',
		Graha::GRAHA_SK => '3',
		Graha::GRAHA_MA => '4',
		Graha::GRAHA_GU => '5',
		Graha::GRAHA_SA => '6',
		Graha::GRAHA_RA => 'm',
	);
	
	static public $outputPlanets = array(
		'Sun'       => Graha::GRAHA_SY,
		'Moon'      => Graha::GRAHA_CH,
		'Mercury'   => Graha::GRAHA_BU,
		'Venus'     => Graha::GRAHA_SK,
		'Mars'      => Graha::GRAHA_MA,
		'Jupiter'   => Graha::GRAHA_GU,
		'Saturn'    => Graha::GRAHA_SA,
		'meanNode'  => Graha::GRAHA_RA,
	);
	static public $outputHouses = array(
		'house1'    => 1,
		'house2'    => 2,
		'house3'    => 3,
		'house4'    => 4,
		'house5'    => 5,
		'house6'    => 6,
		'house7'    => 7,
		'house8'    => 8,
		'house9'    => 9,
		'house10'   => 10,
		'house11'   => 11,
		'house12'   => 12,
	);
	static public $outputExtra = array(
		'Ascendant' => Graha::LAGNA,
		'MC'        => 'MC',
		'ARMC'      => 'ARMC',
		'Vertex'    => 'Vertex',
	);
	
	public function __construct($swe)
	{
		if (empty($swe['swetest'])) {
			throw new Exception\InvalidArgumentException("Swe key 'swetest' is required and must be path to swetest app.");
		}

		if (!file_exists($swe['swetest'])) {
			throw new Exception\InvalidArgumentException("In the directory '{$swe['swetest']}' there is no swetest file.");
		}
		
		$this->_swe['swetest'] = $swe['swetest'];

		if (empty($swe['sweph'])) {
			$this->_swe['sweph'] = $swe['swetest'];
		} else {
			$this->_swe['sweph'] = $swe['sweph'];
		}
	}
	
	/**
	 * Set options.
	 * 
	 * @param array $options
	 * @throws Exception\InvalidArgumentException
	 * @return Swetest
	 */
	public function setOptions(array $options = array()) {
		foreach ($options as $key => $value) {
			$method = 'set' . $key;
			
			if (method_exists($this, $method)) {
				$this->$method($value);
			} else {
				throw new Exception\InvalidArgumentException("Unknown option: $key");
			}
		}
		return $this;
	}
	
	/**
	 * Set ayanamsha for calculation.
	 * 
	 * @param string $ayanamsha
	 * @throws Exception\InvalidArgumentException
	 * @return Swetest
	 */
	public function setAyanamsha($ayanamsha)
	{
		if(key_exists($ayanamsha, self::$inputAyanamsha)) {
			$this->_ayanamsha = $ayanamsha;
		} else {
			throw new Exception\InvalidArgumentException("The ayanamsha '$ayanamsha' is not defined.");
		}
		
		return $this;
	}
	
	/**
	 * Set rising for calculation.
	 * 
	 * @param string $rising
	 * $throw Exception\InvalidArgumentException
	 * @return Swetest
	 */
	public function setRising($rising)
	{
		if(array_search($rising, self::$inputRising)) {
			$this->_rising = $rising;
		} else {
			throw new Exception\InvalidArgumentException("The rising '$rising' is not defined.");
		}
		
		return $this;
	}

	/**
	 * Set user data.
	 * 
	 * @param array $data
	 * @throws Exception\UnexpectedValueException
	 */
	public function setData(array $data)
	{
		if(!is_array($data)) {
			throw new Exception\UnexpectedValueException("Data must be an array.");
		}
		
		foreach ($data as $dataName => $dataValue) {
			$dataName = strtolower($dataName);

			if (array_key_exists($dataName, $this->_data)) {
				if(!empty($dataValue)) $this->_data[$dataName] = $dataValue;
			} else {
				throw new Exception\UnexpectedValueException("Unknown data: $dataName = $dataValue");
			}
			
			if (empty($this->_data['date']))
				$this->_data['date'] = Time::getDateNow();
			if (empty($this->_data['time']))
				$this->_data['time'] = Time::getTimeNow();
		}
	}
	
	/**
	 * Get user data.
	 * 
	 * @return array
	 */
	public function getData()
	{
		return $this->_data;
	}

	/**
	 * Get coordinates and other parameters of planets and houses.
	 * 
	 * @param array $options
	 * @return array
	 */
	public function getParams(array $options = array())
	{
		$this->setOptions($options);
		
		$dateTimeString = $this->_data['date'] . ' ' . $this->_data['time'];
		$dateTimeFormat = Time::FORMAT_DATA_DATE . ' ' . Time::FORMAT_DATA_TIME;
		
		$offsetUser     = $this->_data['offset'];
		$offsetSystem   = Time::getTimeZoneOffset($this->_data['timezone'], $dateTimeString);
		$offsetUser     != $offsetSystem ? $offset = $offsetUser : $offset = false;
		
		$dateTimeObject = Time::getDateTimeUtc($dateTimeFormat, $dateTimeString, $this->_data['timezone'], $offset);
		
		$dir    = $this->_swe['sweph'];
		$date   = $dateTimeObject->format(Time::FORMAT_DATA_DATE);
		$time   = $dateTimeObject->format(Time::FORMAT_DATA_TIME);
		$house  = $this->_data['longitude'].','.$this->_data['latitude'].',a';
		$sid    = self::$inputAyanamsha[$this->_ayanamsha];

		$string =
				'swetest'.
				' -edir'.$dir.
				' -b'.$date.
				' -ut'.$time.
				' -p0123456m'.
				' -house'.$house.
				' -sid'.$sid.
				' -fPlbsad'.
				' -g,'.
				' -head';

		putenv("PATH={$this->_swe['swetest']}");
		exec($string, $out);
		
		$outFormat = $this->_formatParams($out);
		
		return $outFormat;
	}
	
	/**
	 * Get the time of sunrise and sunset of planet.
	 * 
	 * @param string $planet
	 * @param array $options
	 * @return array
	 */
	public function getRising($graha = Graha::GRAHA_SY, array $options = array())
	{
		$this->setOptions($options);
		
		$dateTimeObject = new DateTime($this->_data['date']);
		$dateTimeObject->sub(new DateInterval('P2D'));
		
		$dir    = $this->_swe['sweph'];
		$date   = $dateTimeObject->format(Time::FORMAT_DATA_DATE);
		$planet = self::$inputPlanets[$graha];
		$geopos	= $this->_data['longitude'].','.$this->_data['latitude'].',0';
		$rising = $this->_rising;
		
		$string =
				'swetest'.
				' -edir'.$dir.
				' -n5'.
				' -b'.$date.
				' -p'.$planet.
				' -geopos'.$geopos.
				' -'.$rising.
				' -rise';
		
		putenv("PATH={$this->_swe['swetest']}");
		exec($string, $out);
		
		for($i = 1; $i <= 4; $i++) {
			preg_match("#rise\s((.*\d+)\s+(\d{1,2}:.*))\sset\s((.*\d+)\s+(\d{1,2}:.*))#", $out[$i+1], $matches);

			$risingString  = str_replace(' ', '', $matches[2]).' '.str_replace(' ', '', $matches[3]);
			$settingString = str_replace(' ', '', $matches[5]).' '.str_replace(' ', '', $matches[6]);

			$risingObject = new DateTime($risingString, new DateTimeZone('UTC'));
			$risingObject->setTimezone(new DateTimeZone($this->_data['timezone']));
			$settingObject = new DateTime($settingString, new DateTimeZone('UTC'));
			$settingObject->setTimezone(new DateTimeZone($this->_data['timezone']));

			$dateRising = $risingObject->format(Time::FORMAT_DATETIME);
			$dateSetting = $settingObject->format(Time::FORMAT_DATETIME);

			$bodyRising['time'][$i] = array(
				'rising'  => $dateRising,
				'setting' => $dateSetting,
			);
		}
		$bodyRising['graha'] = $graha;
		
		return $bodyRising;
	}

	private function _formatParams($input)
	{
		$bodyParameters = array();
		
		foreach ($input as $k => $v) {
			// Break if swetest warning
			if($k == 24) break;
			
			$parametersString = str_replace(' ', '', $v);
			$parameters = explode(',', $parametersString);
			$bodyName   = $parameters[0];
			$units      = Math::partsToUnits($parameters[1]);
			
			if (array_key_exists($bodyName, self::$outputPlanets)) {
				$bodyParameters['graha'][self::$outputPlanets[$bodyName]] = array(
					'longitude' => $parameters[1],
					'latitude' => $parameters[2],
					'speed' => $parameters[3],
					'ascension' => $parameters[4],
					'declination' => $parameters[5],
					'rashi' => $units['units'],
					'degree' => $units['parts'],
				);
			} elseif (array_key_exists($bodyName, self::$outputHouses)) {
				$bodyParameters['bhava'][self::$outputHouses[$bodyName]] = array(
					'longitude' => $parameters[1],
					'ascension' => $parameters[2],
					'declination' => $parameters[3],
					'rashi' => $units['units'],
					'degree' => $units['parts'],
				);
			} else {
				$bodyParameters['extra'][self::$outputExtra[$bodyName]] = array(
					'longitude' => $parameters[1],
					'rashi'     => $units['units'],
					'degree'    => $units['parts'],
				);
			}
		}
		
		$longitudeKe = Calc::contraLon($bodyParameters['graha'][Graha::GRAHA_RA]['longitude']);
		$ascensionKe = Calc::contraLon($bodyParameters['graha'][Graha::GRAHA_RA]['ascension']);
		$units = Math::partsToUnits($longitudeKe);
		
		$bodyParameters['graha'][Graha::GRAHA_KE] = array(
			'longitude'   => $longitudeKe,
			'speed'       => $bodyParameters['graha'][Graha::GRAHA_RA]['speed'],
			'rashi'       => $units['units'],
			'degree'      => $units['parts'],
			'ascension'   => $ascensionKe,
			'declination' => $bodyParameters['graha'][Graha::GRAHA_RA]['declination']
		);
		
		asort($bodyParameters['graha']);
		reset($bodyParameters['graha']);
		
		return $bodyParameters;
	}
	
}