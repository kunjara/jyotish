<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Ganita\Math;
use Jyotish\Rashi\Rashi;
use Jyotish\Tattva\Maha\Bhuta;

/**
 * Class of varga D27.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D27 extends \Jyotish\Varga\Varga {

	static public $vargaAltName = array(
		'Bhamsha',
		'Nakshatramsha',
	);
	static public $vargaAmsha = 27;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 24-26.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Math::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		$rashiObject = Rashi::getInstance((int)$ganitaRashi['rashi']);
		$rashiBhuta = $rashiObject->getRashiBhuta();
		
		switch ($rashiBhuta) {
			case Bhuta::BHUTA_AGNI:
				$vargaRashi['rashi'] = Math::numberInCycle(1 + $result['units']);
				break;
			case Bhuta::BHUTA_PRITVI:
				$vargaRashi['rashi'] = Math::numberInCycle(4 + $result['units']);
				break;
			case Bhuta::BHUTA_VAYU:
				$vargaRashi['rashi'] = Math::numberInCycle(7 + $result['units']);
				break;
			case Bhuta::BHUTA_JALA:
				$vargaRashi['rashi'] = Math::numberInCycle(10 + $result['units']);
				break;
		}
		
		return $vargaRashi;
	}

}