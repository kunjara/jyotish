<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga;

use Jyotish\Ganita\Math;

/**
 * Class with the names of divisional charts and their parameters.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class Varga {

	const VARGA_D1 = 'D1';
	const VARGA_D2 = 'D2';
	const VARGA_D3 = 'D3';
	const VARGA_D4 = 'D4';
	const VARGA_D7 = 'D7';
	const VARGA_D9 = 'D9';
	const VARGA_D10 = 'D10';
	const VARGA_D12 = 'D12';
	const VARGA_D16 = 'D16';
	const VARGA_D20 = 'D20';
	const VARGA_D24	= 'D24';
	const VARGA_D27 = 'D27';
	const VARGA_D30 = 'D30';
	const VARGA_D40 = 'D40';
	const VARGA_D45 = 'D45';
	const VARGA_D60 = 'D60';
	
	/**
	 * Vargas names.
	 * 
     * @var array 
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 2-4.
     */
	static public $VARGA = array(
		self::VARGA_D1 => 'Rashi',
		self::VARGA_D2 => 'Hora',
		self::VARGA_D3 => 'Drekkana',
		self::VARGA_D4 => 'Chaturthamsha',
		self::VARGA_D7 => 'Saptamamsha',
		self::VARGA_D9 => 'Navamsha',
		self::VARGA_D10 => 'Dashamsha',
		self::VARGA_D12 => 'Dvadashamsha',
		self::VARGA_D16 => 'Shodashamsha',
		self::VARGA_D20 => 'Vimshamsha',
		self::VARGA_D24 => 'Chaturvimshamsha',
		self::VARGA_D27 => 'Saptavimshamsha',
		self::VARGA_D30 => 'Trimshamsha',
		self::VARGA_D40 => 'Khavedamsha',
		self::VARGA_D45 => 'Akshavedamsha',
		self::VARGA_D60 => 'Shashtiamsha',
	);
	
	/**
	 * The full Bal for each of the divisions consisting Shad Varga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
	 */
	static public $balaShadVarga = array(
		self::VARGA_D1	=> 6,
		self::VARGA_D2	=> 2,
		self::VARGA_D3	=> 4,
		self::VARGA_D9	=> 5,
		self::VARGA_D12 => 2,
		self::VARGA_D30 => 1
	);
	
	/**
	 * The full Bal for each of the divisions consisting Sapta Varga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
	 */
	static public $balaSaptaVarga = array(
		self::VARGA_D1	=> 5,
		self::VARGA_D2	=> 2,
		self::VARGA_D3	=> 3,
		self::VARGA_D9	=> 2.5,
		self::VARGA_D12 => 4.5,
		self::VARGA_D30 => 2,
		self::VARGA_D7	=> 1
	);
	
	/**
	 * The full Bal for each of the divisions consisting Dasha Varga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 20.
	 */
	static public $balaDashaVarga = array(
		self::VARGA_D1	=> 3,
		self::VARGA_D2	=> 1.5,
		self::VARGA_D3	=> 1.5,
		self::VARGA_D9	=> 1.5,
		self::VARGA_D12 => 1.5,
		self::VARGA_D30 => 1.5,
		self::VARGA_D7	=> 1.5,
		self::VARGA_D10 => 1.5,
		self::VARGA_D16 => 1.5,
		self::VARGA_D60 => 5
	);
	
	/**
	 * The full Bal for each of the divisions consisting Shodasha Varga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 21-25.
	 */
	static public $balaShodashaVarga = array(
		self::VARGA_D1	=> 3.5,
		self::VARGA_D2	=> 1,
		self::VARGA_D3	=> 1,
		self::VARGA_D9	=> 3,
		self::VARGA_D12 => 0.5,
		self::VARGA_D30 => 1,
		self::VARGA_D7	=> 0.5,
		self::VARGA_D10 => 0.5,
		self::VARGA_D16 => 2,
		self::VARGA_D60 => 4,
		self::VARGA_D20 => 0.5,
		self::VARGA_D24 => 0.5,
		self::VARGA_D27 => 0.5,
		self::VARGA_D4	=> 0.5,
		self::VARGA_D40 => 0.5,
		self::VARGA_D45 => 0.5
	);
	
	static public $vargaAltName = null;
	static public $vargaAmsha;
	
	static private $_vargaAbbr;
	static private $_vargaObject;



	abstract public function getVargaRashi(array $sweRashi);
	
	static public function getInstance($vargaAbbr, $options = null) {
		if (array_key_exists($vargaAbbr, self::$VARGA)) {
			
			$vargaClass = 'Jyotish\\Varga\\Object\\' . $vargaAbbr;
			$vargaObject = new $vargaClass($options);
			self::$_vargaAbbr = $vargaAbbr;
			self::$_vargaObject = $vargaObject;

			return $vargaObject;
		} else {
			throw new Exception\InvalidArgumentException("Varga '$vargaAbbr' is not defined.");
		}
	}
	
	public function getVargaData($ganitaData) {
		if(is_null($ganitaData)) {
			throw new Exception\InvalidArgumentException("Ganita data must be an array of calculation positions.");
		}
		
		if(self::$_vargaAbbr == self::VARGA_D1){
			return $ganitaData;
		}
		
		$bhava1Varga = self::$_vargaObject->getVargaRashi($ganitaData['bhava'][1]);
		
		foreach ($ganitaData['bhava'] as $k => $v) {
			if($k == 1) {
				$rashi = $bhava1Varga['rashi'];
			} else {
				$rashi = Math::numberNext($rashi);
			}
			$vargaData['bhava'][$k] = array(
				'rashi' => $rashi,
				'degree' => $bhava1Varga['degree'],
				'longitude' => 30 * ($rashi - 1) + $bhava1Varga['degree'],
			);
		}
		foreach ($ganitaData['graha'] as $k => $v) {
			$result = self::$_vargaObject->getVargaRashi($v);
			$vargaData['graha'][$k] = array(
				'rashi' => $result['rashi'],
				'degree' => $result['degree'],
				'speed' => $ganitaData['graha'][$k]['speed'],
				'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
				'latitude' => $v['latitude'],
			);
		}
		foreach ($ganitaData['extra'] as $k => $v) {
			$result = self::$_vargaObject->getVargaRashi($v);
			$vargaData['extra'][$k] = array(
				'rashi' => $result['rashi'],
				'degree' => $result['degree'],
				'longitude' => 30 * ($result['rashi'] - 1) + $result['degree'],
			);
		}
		return $vargaData;
	}
	
}