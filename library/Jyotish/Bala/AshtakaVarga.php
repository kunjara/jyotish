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
	protected $binduSy = array(
		Graha::GRAHA_SY => array(1, 2, 4, 7, 8, 9, 10, 11),
		Graha::GRAHA_CH => array(3, 6, 10, 11),
		Graha::GRAHA_MA => array(1, 2, 4, 7, 8, 9, 10, 11),
		Graha::GRAHA_BU => array(3, 5, 6, 9, 10, 11, 12),
		Graha::GRAHA_GU => array(5, 6, 9, 11),
		Graha::GRAHA_SK => array(6, 7, 12),
		Graha::GRAHA_SA => array(1, 2, 4, 7, 8, 9, 10, 11),
		Graha::LAGNA    => array(3, 4, 6, 10, 11, 12)
	);
	
	/**
	 * Bindu in Chandra Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 46-48.
	 */
	protected $binduCh = array(
		Graha::GRAHA_SY => array(3, 6, 7, 8, 10, 11),
		Graha::GRAHA_CH => array(1, 3, 6, 7, 9, 10, 11),
		Graha::GRAHA_MA => array(2, 3, 5, 6, 10, 11),
		Graha::GRAHA_BU => array(1, 3, 4, 5, 7, 8, 10, 11),
		Graha::GRAHA_GU => array(1, 2, 4, 7, 8, 10, 11),
		Graha::GRAHA_SK => array(3, 4, 5, 7, 9, 10, 11),
		Graha::GRAHA_SA => array(3, 5, 6, 11),
		Graha::LAGNA    => array(3, 6, 10, 11)
	);
	
	/**
	 * Bindu in Mangal Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 49-50.
	 */
	protected $binduMa = array(
		Graha::GRAHA_SY => array(3, 5, 6, 10, 11),
		Graha::GRAHA_CH => array(3, 6, 11),
		Graha::GRAHA_MA => array(1, 2, 4, 7, 8, 10, 11),
		Graha::GRAHA_BU => array(3, 5, 6, 11),
		Graha::GRAHA_GU => array(6, 10, 11, 12),
		Graha::GRAHA_SK => array(6, 8, 11, 12),
		Graha::GRAHA_SA => array(1, 4, 7, 8, 9, 10, 11),
		Graha::LAGNA    => array(1, 3, 6, 10, 11)
	);
	
	/**
	 * Bindu in Buddha Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 51-52.
	 */
	protected $binduBu = array(
		Graha::GRAHA_SY => array(5, 6, 9, 11, 12),
		Graha::GRAHA_CH => array(2, 4, 6, 8, 10, 11),
		Graha::GRAHA_MA => array(1, 2, 4, 7, 8, 9, 10, 11),
		Graha::GRAHA_BU => array(1, 3, 5, 6, 9, 10, 11, 12),
		Graha::GRAHA_GU => array(6, 8, 11, 12),
		Graha::GRAHA_SK => array(1, 2, 3, 4, 5, 8, 9, 11),
		Graha::GRAHA_SA => array(1, 2, 4, 7, 8, 9, 10, 11),
		Graha::LAGNA    => array(1, 2, 4, 6, 8, 10, 11)
	);
	
	/**
	 * Bindu in Guru Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 53-55.
	 */
	protected $binduGu = array(
		Graha::GRAHA_SY => array(1, 2, 3, 4, 7, 8, 9, 10, 11),
		Graha::GRAHA_CH => array(2, 5, 7, 9, 11),
		Graha::GRAHA_MA => array(1, 2, 4, 7, 8, 10, 11),
		Graha::GRAHA_BU => array(1, 2, 4, 5, 6, 9, 10, 11),
		Graha::GRAHA_GU => array(1, 2, 3, 4, 7, 8, 10, 11),
		Graha::GRAHA_SK => array(2, 5, 6, 9, 10, 11),
		Graha::GRAHA_SA => array(3, 5, 6, 12),
		Graha::LAGNA    => array(1, 2, 4, 5, 6, 7, 9, 10, 11)
	);
	
	/**
	 * Bindu in Shukra Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 56-58.
	 */
	protected $binduSk = array(
		Graha::GRAHA_SY => array(8, 11, 12),
		Graha::GRAHA_CH => array(1, 2, 3, 4, 5, 8, 9, 11, 12),
		Graha::GRAHA_MA => array(3, 4, 6, 9, 11, 12),
		Graha::GRAHA_BU => array(3, 5, 6, 9, 11),
		Graha::GRAHA_GU => array(5, 8, 9, 10, 11),
		Graha::GRAHA_SK => array(1, 2, 3, 4, 5, 8, 9, 10, 11),
		Graha::GRAHA_SA => array(3, 4, 5, 8, 9, 10, 11),
		Graha::LAGNA    => array(1, 2, 3, 4, 5, 8, 9, 11)
	);
	
	/**
	 * Bindu in Shani Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 59-60.
	 */
	protected $binduSa = array(
		Graha::GRAHA_SY => array(1, 2, 4, 7, 8, 10, 11),
		Graha::GRAHA_CH => array(3, 6, 11),
		Graha::GRAHA_MA => array(3, 5, 6, 10, 11, 12),
		Graha::GRAHA_BU => array(6, 8, 9, 10, 11, 12),
		Graha::GRAHA_GU => array(5, 6, 11, 12),
		Graha::GRAHA_SK => array(6, 11, 12),
		Graha::GRAHA_SA => array(3, 5, 6, 11),
		Graha::LAGNA    => array(1, 3, 4, 6, 10, 11)
	);
	
	/**
	 * Bindu in Lagna Ashtakavarga.
	 * 
	 * @var array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 65-68.
	 */
	protected $binduLg = array(
		Graha::GRAHA_SY => array(3, 4, 6, 10, 11, 12),
		Graha::GRAHA_CH => array(3, 6, 10, 11, 12),
		Graha::GRAHA_MA => array(1, 3, 6, 10, 11),
		Graha::GRAHA_BU => array(1, 2, 4, 6, 8, 10, 11),
		Graha::GRAHA_GU => array(1, 2, 4, 5, 6, 7, 9, 10, 11),
		Graha::GRAHA_SK => array(1, 2, 3, 4, 5, 8, 9),
		Graha::GRAHA_SA => array(1, 3, 4, 6, 10, 11),
		Graha::LAGNA    => array(3, 6, 10, 11)
	);
	
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
	
	public function rewind() {
		$this->position = 0;
    }
	
	public function current() {
		return $this->bhinnAshtakavarga[$this->key()];
    }
	
	public function key() {
		return $this->ashtakavarga[$this->position];
    }
	
	public function next() {
		++$this->position;
    }
	
	public function valid() {
		return isset($this->ashtakavarga[$this->position]);
    }
}
