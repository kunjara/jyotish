<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * Class for working with time and date.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Time {
	
	const DATA_DATE_FORMAT		= 'd.m.Y';
	const DATA_TIME_FORMAT		= 'H:i';
	const OFFSET_TIME_FORMAT	= '%H:%I';
	
	
	/**
	 * Get real time.
	 * 
	 * @return string
	 */
	static function getTimeNow() {
		$dateTimeObject = new DateTime('NOW');
		$time = $dateTimeObject->format(self::DATA_TIME_FORMAT);
		
		return $time;
	}
	
	/**
	 * Get real date.
	 * 
	 * @return string
	 */
	static function getDateNow() {
		$dateTimeObject = new DateTime('NOW');
		$date = $dateTimeObject->format(self::DATA_DATE_FORMAT);
		
		return $date;
	}


	
	static public function getDateTimeUtc($timeFormat, $dateTime, $timeZone = 'UTC', $offsetUser = null) {
		$timeZoneObject = new DateTimeZone($timeZone);
		$dateTimeObject = DateTime::createFromFormat($timeFormat, $dateTime, $timeZoneObject);

		if ($timeZone != 'UTC') {
			$dateTimeObject->setTimezone(new DateTimeZone('UTC'));
		}
		
		if($offsetUser) {
			if (!is_int($offsetUser)) {
				throw new Exception\InvalidArgumentException("The offset must be an integer value in seconds.");
			}
			
			$offsetSystem	= self::getTimeZoneOffset($timeZone, $dateTime);
			$offsetTotal	= $offsetSystem - $offsetUser;
			
			if($offsetTotal > 0) {
				$dateTimeObject->add(new DateInterval('PT'.$offsetTotal.'S'));
			} else {
				$dateTimeObject->sub(new DateInterval('PT'.abs($offsetTotal).'S'));
			}
		}

		return $dateTimeObject;
	}
	
	
	
	static public function getTimeZoneOffset($timeZone, $dateTime, $flagFormat = false) {
		$timeZoneObject = new DateTimeZone($timeZone);
		$dateTimeObject = new DateTime($dateTime, $timeZoneObject);

		$offset = $timeZoneObject->getOffset($dateTimeObject);
		$offsetResult = $flagFormat ? self::formatOffset($offset) : $offset;
		
		return $offsetResult;
	}
	
	
	
	static public function formatOffset($offset, $format = self::OFFSET_TIME_FORMAT) {
		$offsetInterval = new DateInterval('PT'.abs($offset).'S');
		
		$seconds = $offsetInterval->s;
		$offsetInterval->h = floor($seconds/60/60);
		$seconds -= $offsetInterval->h * 3600;
		$offsetInterval->i = floor($seconds/60);
		$seconds -= $offsetInterval->i * 60;
		$offsetInterval->s = $seconds;
		
		$offsetFormat = $offsetInterval->format($format);
		$offsetResult = $offset < 0 ? '-' . $offsetFormat : $offsetFormat;
		
		return $offsetResult;
	}

	
	
	static public function getTimeZoneLocation($timeZone) {
		$timeZoneObject = new DateTimeZone($timeZone);
		$location = $timeZoneObject->getLocation();

		return $location;
	}

	
	
	static public function getTimeZoneTransitions($timeZone) {
		$timeZoneObject = new DateTimeZone($timeZone);
		$transitions = $timeZoneObject->getTransitions();

		return $transitions;
	}

}