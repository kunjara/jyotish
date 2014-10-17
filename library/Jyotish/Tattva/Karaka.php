<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

/**
 * Class of karaka data.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Karaka {
	/**
	 * Own self
	 */
	const KARAKA_ATMA    = 'Atmakaraka';
	/**
	 * Advisor
	 */
	const KARAKA_AMATYA  = 'Amatyakaraka';
	/**
	 * Brothers and sisters
	 */
	const KARAKA_BHRATRU = 'Bhratrukaraka';
	/**
	 * Mother
	 */
	const KARAKA_MATRU   = 'Matrukaraka';
	/**
	 * Father
	 */
	const KARAKA_PITRU   = 'Pitrukaraka';
	/**
	 * Children
	 */
	const KARAKA_PUTRA   = 'Putrakaraka';
	/**
	 * Cousins and relations
	 */
	const KARAKA_GNATI   = 'Gnatikaraka';
	/**
	 * Husband, wife
	 */
	const KARAKA_DARA    = 'Darakaraka';
	
	/**
	 * List of karakas.
	 * 
	 * @var array
	 */
	public static $karaka = array(
		1 => self::KARAKA_DARA,
		2 => self::KARAKA_GNATI,
		3 => self::KARAKA_PUTRA,
		4 => self::KARAKA_PITRU,
		5 => self::KARAKA_MATRU,
		6 => self::KARAKA_BHRATRU,
		7 => self::KARAKA_AMATYA,
		8 => self::KARAKA_ATMA,
	);
}
