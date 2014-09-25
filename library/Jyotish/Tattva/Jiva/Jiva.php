<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva;

/**
 * Abstract jiva class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Jiva {
	/**
	 * Gender
	 */
	const GENDER_MALE   = 'male';
	const GENDER_FEMALE = 'female';
	const GENDER_NEUTER = 'neuter';
	
	/**
	 * Type
	 */
	const TYPE_NARA     = 'nara';
	const TYPE_PASU     = 'pasu';
	const TYPE_JALA     = 'jala';
	const TYPE_KITA     = 'kita';
	const TYPE_VANA     = 'vana';
	
	static public $typeVasya = array(
		self::TYPE_PASU,
		self::TYPE_NARA,
		self::TYPE_JALA,
		self::TYPE_VANA,
		self::TYPE_KITA
	);
}
