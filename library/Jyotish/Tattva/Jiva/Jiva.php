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
abstract class Jiva {
	/**
     * Gana
     */
	const GANA_DEVA = 'deva';
	const GANA_MANUSHA = 'manusha';
	const GANA_RAKSHASA = 'rakshasa';
	
	/**
	 * Gender
	 */
	const GENDER_MALE = 'male';
	const GENDER_FEMALE = 'female';
	const GENDER_NEUTER = 'neuter';
	
	/**
	 * Limb
	 */
	const LIMB_HEAD = 'head';
	const LIMB_FACE = 'face';
	const LIMB_ARMS = 'arms';
	const LIMB_HEART = 'heart';
	const LIMB_STOMACH = 'stomach';
	const LIMB_HIP = 'hip';
	const LIMB_BELOWNAVEL = 'below navel';
	const LIMB_PRIVITIES = 'privities';
	const LIMB_THIGHS = 'thighs';
	const LIMB_KNEES = 'knees';
	const LIMB_ANKLES = 'ankles';
	const LIMB_FEET = 'feet';
}
