<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

use Jyotish\Service\Utils;
use Jyotish\Rashi\Rashi;

/**
 * Class of varga D3.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D3 extends \Jyotish\Varga\Varga {

	static public $vargaAmsha = 3;

	public function __construct($options) {
		return $this;
	}
	
	/**
	 * Get varga rashi.
	 * 
	 * @param array $ganitaRashi
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 6, Verse 7-8.
	 */
	public function getVargaRashi(array $ganitaRashi) {
		$amshaSize = 30 / self::$vargaAmsha;
		$result = Utils::partsToUnits($ganitaRashi['degree'], $amshaSize, 'floor');
		$vargaRashi['degree'] = $result['parts'] * 30 / $amshaSize;
		
		if($ganitaRashi['degree'] < 10) {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi($ganitaRashi['rashi']);
		} elseif($ganitaRashi['degree'] >= 10 and $ganitaRashi['degree'] < 20) {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi($ganitaRashi['rashi'], 5);
		} else {
			$vargaRashi['rashi'] = Rashi::inZodiacRashi($ganitaRashi['rashi'], 9);
		}
		
		return $vargaRashi;
	}

}