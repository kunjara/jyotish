<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;

/**
 * Class of varga D4.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D4 extends \Jyotish\Varga\Varga {
	
	static public $vargaAltName = array(
		'Turyamsha',
	);

	static public $vargaAmsha = 4;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 9.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		if($ganitaRashi['degree'] < 7.5) {
			$vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi']);
		} elseif($ganitaRashi['degree'] >= 7.5 and $ganitaRashi['degree'] < 15) {
			$vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 4);
		} elseif($ganitaRashi['degree'] >= 15 and $ganitaRashi['degree'] < 22.5) {
			$vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 7);
		} else {
			$vargaRashi['rashi'] = Math::numberInCycle($ganitaRashi['rashi'], 10);
		}
		
		return $vargaRashi;
	}

}