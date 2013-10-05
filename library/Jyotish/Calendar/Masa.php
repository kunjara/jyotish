<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar;

/**
 * Masa class with Month names
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Masa {
	const NAME_CHAITRA		= 'Chaitra';
	const NAME_VAISHAKHA	= 'Vaishakha';
	const NAME_JYESHTHA		= 'Jyeshtha';
	const NAME_ASHADHA		= 'Ashadha';
	const NAME_SHRAVANA		= 'Shravana';
	const NAME_BHADRAPADA	= 'Bhadrapada';
	const NAME_ASHVIN		= 'Ashvin';
	const NAME_KARTIKA		= 'Kartika';
	const NAME_MARGASHIRSHA = 'Margashirsha';
	const NAME_PAUSHA		= 'Pausha';
	const NAME_MAGHA		= 'Magha';
	const NAME_PHALGUNA		= 'Phalguna';
	
	static public $MASA = array(
		1 => self::NAME_CHAITRA,
		2 => self::NAME_VAISHAKHA,
		3 => self::NAME_JYESHTHA,
		4 => self::NAME_ASHADHA,
		5 => self::NAME_SHRAVANA,
		6 => self::NAME_BHADRAPADA,
		7 => self::NAME_ASHVIN,
		8 => self::NAME_KARTIKA,
		9 => self::NAME_MARGASHIRSHA,
		10 => self::NAME_PAUSHA,
		11 => self::NAME_MAGHA,
		12 => self::NAME_PHALGUNA
	);
}