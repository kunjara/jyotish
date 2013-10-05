<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar\Event;

use Jyotish\Calendar\Masa;
use Jyotish\Panchanga\Tithi\Tithi;

/**
 * Bengal specific Holidays
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class BengalHolidays extends \Jyotish\Calendar\Event{
	static public $eventsTitle = 'Bengal specific Holidays';

	static public $eventsList = array(
		array(
			self::COL_NAME => 'Durga Puja',
			self::COL_MASA => Masa::NAME_ASHVIN,
			self::COL_TITHI => Tithi::NAME_SAPTAMI,
			self::COL_PAKSHA => Tithi::PAKSHA_SHUKLA,
		),
	);
}