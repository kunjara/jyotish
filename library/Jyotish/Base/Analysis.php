<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Karaka;

/**
 * Main class for analysis of horoscopes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Analysis {
	/**
	 * Analyzed data.
	 * 
	 * @var array
	 */
	protected $data = array();
	
	/**
	 * Constructor
	 * 
	 * @param \Jyotish\Base\Data $dataObject
	 */
	public function __construct(\Jyotish\Base\Data $dataObject) {
		$this->dataObject = $dataObject;
		$this->data = $this->dataObject->getAnalyzedData();
	}
	
	/**
	 * Get chara karaka.
	 * 
	 * @return array
	 * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 32, Verse 13-17.
	 */
	public function getCharaKaraka()
	{
		$grahas = $this->data['graha'];
		unset($grahas[Graha::GRAHA_KE]);
		$grahas[Graha::GRAHA_RA]['degree'] = 30 - $grahas[Graha::GRAHA_RA]['degree'];
		
		uasort($grahas, 
			function ($d1, $d2){
				if($d1['degree'] == $d2['degree']) {
					return 0;
				}else{
					return ($d1['degree'] < $d2['degree']) ? -1 : 1;
				}
			}
		);
		
		foreach($grahas as $key => $data){
			$i += 1;
			$grahaKaraka[$key] = Karaka::$karaka[$i];
		}
		
		return $grahaKaraka;
	}
}
