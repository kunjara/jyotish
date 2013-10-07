<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Alphabet;

/**
 * Greek class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Greek {
	/**
	 * Greek alphabet
	 */
	const ALPHA		= 'alpha';
	const BETA		= 'beta';
	const GAMMA		= 'gamma';
	const DELTA		= 'delta';
	const EPSILON	= 'epsilon';
	const ZETA		= 'zeta';
	const ETA		= 'eta';
	const THETA		= 'theta';
	const IOTA		= 'iota';
	const KAPPA		= 'kappa';
	const LAMBDA	= 'lambda';
	const MU		= 'mu';
	const NU		= 'nu';
	const XI		= 'xi';
	const OMICRON	= 'omicron';
	const PI		= 'pi';
	const RHO		= 'rho';
	const SIGMA		= 'sigma';
	const TAU		= 'tau';
	const UPSILON	= 'upsilon';
	const PHI		= 'phi';
	const CHI		= 'chi';
	const PSI		= 'psi';
	const OMEGA		= 'omega';
	
		/**
	 * Greek uppercase letters unicode.
	 * 
	 * @var array
	 */
	static public $unicodeUp = array(
		self::ALPHA		=> '0391',
		self::BETA		=> '0392',
		self::GAMMA		=> '0393',
		self::DELTA		=> '0394',
		self::EPSILON	=> '0395',
		self::ZETA		=> '0396',
		self::ETA		=> '0397',
		self::THETA		=> '0398',
		self::IOTA		=> '0399',
		self::KAPPA		=> '039A',
		self::LAMBDA	=> '039B',
		self::MU		=> '039C',
		self::NU		=> '039D',
		self::XI		=> '039E',
		self::OMICRON	=> '039F',
		self::PI		=> '03A0',
		self::RHO		=> '03A1',
		self::SIGMA		=> '03A3',
		self::TAU		=> '03A4',
		self::UPSILON	=> '03A5',
		self::PHI		=> '03A6',
		self::CHI		=> '03A7',
		self::PSI		=> '03A8',
		self::OMEGA		=> '03A9'
	);

	/**
	 * Greek lowercase letters unicode.
	 * 
	 * @var array
	 */
	static public $unicodeLow = array(
		self::ALPHA		=> '03B1',
		self::BETA		=> '03B2',
		self::GAMMA		=> '03B3',
		self::DELTA		=> '03B4',
		self::EPSILON	=> '03B5',
		self::ZETA		=> '03B6',
		self::ETA		=> '03B7',
		self::THETA		=> '03B8',
		self::IOTA		=> '03B9',
		self::KAPPA		=> '03BA',
		self::LAMBDA	=> '03BB',
		self::MU		=> '03BC',
		self::NU		=> '03BD',
		self::XI		=> '03BE',
		self::OMICRON	=> '03BF',
		self::PI		=> '03C0',
		self::RHO		=> '03C1',
		self::SIGMA		=> '03C3',
		self::TAU		=> '03C4',
		self::UPSILON	=> '03C5',
		self::PHI		=> '03C6',
		self::CHI		=> '03C7',
		self::PSI		=> '03C8',
		self::OMEGA		=> '03C9'
	);
}