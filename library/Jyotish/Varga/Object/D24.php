<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Rashi\Rashi;

/**
 * Class of varga D24.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D24 extends \Jyotish\Varga\Varga {

	static public $vargaAltName = array(
		'Siddhamsha',
	);
	static public $vargaAmsha = 24;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 22-23.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		if($ganitaRashi['rashi'] % 2) {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi(5 + $result['units']);
		} else {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi(4 + $result['units']);
		}
		
		return $vargaRashi;
	}

}