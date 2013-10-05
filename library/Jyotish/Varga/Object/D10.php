<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Service\Utils;
use Jyotish\Rashi\Rashi;

/**
 * Class of varga D10.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D10 extends \Jyotish\Varga\Varga {
	
	static public $vargaAltName = array(
		'Dashamamsha',
	);

	static public $vargaAmsha = 10;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 13-14.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Utils::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		if($ganitaRashi['rashi'] % 2) {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi($ganitaRashi['rashi'] + $result['units']);
		} else {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi($ganitaRashi['rashi'] + $result['units'], 9);
		}
		
		return $vargaRashi;
	}

}