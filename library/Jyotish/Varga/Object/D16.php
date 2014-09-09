<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Rashi\Rashi;

/**
 * Class of varga D16.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D16 extends \Jyotish\Varga\Varga {

	static public $vargaAltName = array(
		'Kalamsha',
	);
	
	static public $vargaAmsha = 16;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 16.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		$rashiObject = Rashi::getInstance((int)$ganitaRashi['rashi']);
		$rashiBhava = $rashiObject->getRashiBhava();
		
		switch ($rashiBhava) {
			case Rashi::BHAVA_CHARA:
				$vargaRashi['rashi'] = Math::numberInCycle(1 + $result['units']);
				break;
			case Rashi::BHAVA_STHIRA:
				$vargaRashi['rashi'] = Math::numberInCycle(5 + $result['units']);
				break;
			case Rashi::BHAVA_DVISVA:
				$vargaRashi['rashi'] = Math::numberInCycle(9 + $result['units']);
				break;
		}
		
		return $vargaRashi;
	}

}