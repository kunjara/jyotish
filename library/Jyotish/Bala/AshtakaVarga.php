<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bala;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;

/**
 * AshtakaVarga class. Northern India the benefic points are called rekhas or 
 * vertical lines while malefic points are known as bindus. It is the reverse 
 * of the terminology used in South India.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class AshtakaVarga implements \Iterator {
	/**
	 * Array of ganita data.
	 * 
	 * @var array
	 */
	protected $ganitaData = array();
	
	/**
	 * Bhinnashtakavarga (Prashtarashtakavarga) of 7 grahas and lagna.
	 * 
	 * @var array
	 */
	protected $bhinnAshtakavarga = array();
	
	/**
	 * Sarvashtakavarga (Samudayashtakavarga).
	 * 
	 * @var array
	 */
	protected $sarvAshtakavarga = array();

	/**
	 * Eight vargas.
	 * 
	 * @var type 
	 */
	protected $ashtakavarga = array(
		Graha::GRAHA_SY,
		Graha::GRAHA_CH,
		Graha::GRAHA_MA,
		Graha::GRAHA_BU,
		Graha::GRAHA_GU,
		Graha::GRAHA_SK,
		Graha::GRAHA_SA,
		Graha::LAGNA
	);

	/**
	 * Bindu in Surya Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 43-45.
	 */
	protected $binduSy = [
		Graha::GRAHA_SY => [1, 2, 4, 7, 8, 9, 10, 11],
		Graha::GRAHA_CH => [3, 6, 10, 11],
		Graha::GRAHA_MA => [1, 2, 4, 7, 8, 9, 10, 11],
		Graha::GRAHA_BU => [3, 5, 6, 9, 10, 11, 12],
		Graha::GRAHA_GU => [5, 6, 9, 11],
		Graha::GRAHA_SK => [6, 7, 12],
		Graha::GRAHA_SA => [1, 2, 4, 7, 8, 9, 10, 11],
		Graha::LAGNA    => [3, 4, 6, 10, 11, 12]
	];
	
	/**
	 * Bindu in Chandra Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 46-48.
	 */
	protected $binduCh = [
		Graha::GRAHA_SY => [3, 6, 7, 8, 10, 11],
		Graha::GRAHA_CH => [1, 3, 6, 7, 9, 10, 11],
		Graha::GRAHA_MA => [2, 3, 5, 6, 10, 11],
		Graha::GRAHA_BU => [1, 3, 4, 5, 7, 8, 10, 11],
		Graha::GRAHA_GU => [1, 2, 4, 7, 8, 10, 11],
		Graha::GRAHA_SK => [3, 4, 5, 7, 9, 10, 11],
		Graha::GRAHA_SA => [3, 5, 6, 11],
		Graha::LAGNA    => [3, 6, 10, 11]
	];
	
	/**
	 * Bindu in Mangal Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 49-50.
	 */
	protected $binduMa = [
		Graha::GRAHA_SY => [3, 5, 6, 10, 11],
		Graha::GRAHA_CH => [3, 6, 11],
		Graha::GRAHA_MA => [1, 2, 4, 7, 8, 10, 11],
		Graha::GRAHA_BU => [3, 5, 6, 11],
		Graha::GRAHA_GU => [6, 10, 11, 12],
		Graha::GRAHA_SK => [6, 8, 11, 12],
		Graha::GRAHA_SA => [1, 4, 7, 8, 9, 10, 11],
		Graha::LAGNA    => [1, 3, 6, 10, 11]
	];
	
	/**
	 * Bindu in Buddha Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 51-52.
	 */
	protected $binduBu = [
		Graha::GRAHA_SY => [5, 6, 9, 11, 12],
		Graha::GRAHA_CH => [2, 4, 6, 8, 10, 11],
		Graha::GRAHA_MA => [1, 2, 4, 7, 8, 9, 10, 11],
		Graha::GRAHA_BU => [1, 3, 5, 6, 9, 10, 11, 12],
		Graha::GRAHA_GU => [6, 8, 11, 12],
		Graha::GRAHA_SK => [1, 2, 3, 4, 5, 8, 9, 11],
		Graha::GRAHA_SA => [1, 2, 4, 7, 8, 9, 10, 11],
		Graha::LAGNA    => [1, 2, 4, 6, 8, 10, 11]
	];
	
	/**
	 * Bindu in Guru Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 53-55.
	 */
	protected $binduGu = [
		Graha::GRAHA_SY => [1, 2, 3, 4, 7, 8, 9, 10, 11],
		Graha::GRAHA_CH => [2, 5, 7, 9, 11],
		Graha::GRAHA_MA => [1, 2, 4, 7, 8, 10, 11],
		Graha::GRAHA_BU => [1, 2, 4, 5, 6, 9, 10, 11],
		Graha::GRAHA_GU => [1, 2, 3, 4, 7, 8, 10, 11],
		Graha::GRAHA_SK => [2, 5, 6, 9, 10, 11],
		Graha::GRAHA_SA => [3, 5, 6, 12],
		Graha::LAGNA    => [1, 2, 4, 5, 6, 7, 9, 10, 11]
	];
	
	/**
	 * Bindu in Shukra Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 56-58.
	 */
	protected $binduSk = [
		Graha::GRAHA_SY => [8, 11, 12],
		Graha::GRAHA_CH => [1, 2, 3, 4, 5, 8, 9, 11, 12],
		Graha::GRAHA_MA => [3, 4, 6, 9, 11, 12],
		Graha::GRAHA_BU => [3, 5, 6, 9, 11],
		Graha::GRAHA_GU => [5, 8, 9, 10, 11],
		Graha::GRAHA_SK => [1, 2, 3, 4, 5, 8, 9, 10, 11],
		Graha::GRAHA_SA => [3, 4, 5, 8, 9, 10, 11],
		Graha::LAGNA    => [1, 2, 3, 4, 5, 8, 9, 11]
	];
	
	/**
	 * Bindu in Shani Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 59-60.
	 */
	protected $binduSa = [
		Graha::GRAHA_SY => [1, 2, 4, 7, 8, 10, 11],
		Graha::GRAHA_CH => [3, 6, 11],
		Graha::GRAHA_MA => [3, 5, 6, 10, 11, 12],
		Graha::GRAHA_BU => [6, 8, 9, 10, 11, 12],
		Graha::GRAHA_GU => [5, 6, 11, 12],
		Graha::GRAHA_SK => [6, 11, 12],
		Graha::GRAHA_SA => [3, 5, 6, 11],
		Graha::LAGNA    => [1, 3, 4, 6, 10, 11]
	];
	
	/**
	 * Bindu in Lagna Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 65-68.
	 */
	protected $binduLg = [
		Graha::GRAHA_SY => [3, 4, 6, 10, 11, 12],
		Graha::GRAHA_CH => [3, 6, 10, 11, 12],
		Graha::GRAHA_MA => [1, 3, 6, 10, 11],
		Graha::GRAHA_BU => [1, 2, 4, 6, 8, 10, 11],
		Graha::GRAHA_GU => [1, 2, 4, 5, 6, 7, 9, 10, 11],
		Graha::GRAHA_SK => [1, 2, 3, 4, 5, 8, 9],
		Graha::GRAHA_SA => [1, 3, 4, 6, 10, 11],
		Graha::LAGNA    => [3, 6, 10, 11]
	];
	
	/**
	 * Get Bhinnashtakavarga.
	 * 
	 * @return array
	 */
	public function getBhinnAshtakavarga()
	{
		return $this->bhinnAshtakavarga;
	}
	
	/**
	 * Get Sarvashtakavarga.
	 * 
	 * @return array
	 */
	public function getSarvAshtakavarga($withLagna = false)
	{
		if($withLagna){
			return Math::arraySum($this->sarvAshtakavarga, $this->bhinnAshtakavarga[Graha::LAGNA]);
		}else{
			return $this->sarvAshtakavarga;
		}
	}

	public function __construct($ganitaData)
	{
		$this->ganitaData = $ganitaData;
		$this->rewind();
		
		foreach($this->ashtakavarga as $varga){
			$binduVarga = 'bindu'.$varga;
			
			foreach($this->ashtakavarga as $graha){
				for($i = 1; $i <= 12; $i++){
					$bindu = in_array($i, $this->{$binduVarga}[$graha]) ? 1 : 0; 
					
					if($graha != Graha::LAGNA){
						$distance = Math::numberInCycle($this->ganitaData['graha'][$graha]['rashi'], $i);
					}else{
						$distance = Math::numberInCycle($this->ganitaData['extra'][$graha]['rashi'], $i);
					}

					$this->bhinnAshtakavarga[$varga][$distance] += $bindu;
				}
			}
			ksort($this->bhinnAshtakavarga[$varga]);
			
			if($varga != Graha::LAGNA)
				$this->sarvAshtakavarga = Math::arraySum($this->bhinnAshtakavarga[$varga], $this->sarvAshtakavarga);
		}
	}
	
	/**
	 * rewind(): defined by Iterator interface.
	 *
	 * @see    Iterator::rewind()
	 * @return void
	 */
	public function rewind() {
		$this->position = 0;
    }
	
	/**
	 * current(): defined by Iterator interface.
	 *
	 * @see    Iterator::current()
	 * @return mixed
	 */
	public function current() {
		return $this->bhinnAshtakavarga[$this->key()];
    }
	
	/**
	 * key(): defined by Iterator interface.
	 *
	 * @see    Iterator::key()
	 * @return mixed
	 */
	public function key() {
		return $this->ashtakavarga[$this->position];
    }
	
	/**
	 * next(): defined by Iterator interface.
	 *
	 * @see    Iterator::next()
	 * @return void
	 */
	public function next() {
		++$this->position;
    }
	
	/**
	 * valid(): defined by Iterator interface.
	 *
	 * @see    Iterator::valid()
	 * @return bool
	 */
	public function valid() {
		return isset($this->ashtakavarga[$this->position]);
    }
}
