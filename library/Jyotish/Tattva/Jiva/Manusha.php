<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva;

/**
 * Class of Manusha gana.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Manusha extends Jiva {
	
	const VARNA_BRAHMANA = 'brahmana';
	const VARNA_KSHATRIYA = 'kshatriya';
	const VARNA_VAISHYA = 'vaishya';
	const VARNA_SHUDRA = 'shudra';
	const VARNA_DASYA = 'dasya';
	const VARNA_MLECHHA = 'mlechha';
	const VARNA_UGRA = 'ugra';
	
	static public $varnaChatur = array(
		self::VARNA_BRAHMANA,
		self::VARNA_KSHATRIYA,
		self::VARNA_VAISHYA,
		self::VARNA_SHUDRA
	);
	
	const PURUSHARTHA_DHARMA = 'dharma';
	const PURUSHARTHA_ARTHA = 'artha';
	const PURUSHARTHA_KAMA = 'kama';
	const PURUSHARTHA_MOKSHA = 'moksha';
}
