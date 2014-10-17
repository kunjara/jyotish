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
	 * @param \Jyotish\Base\Data|array $data
	 * @throws Exception\InvalidArgumentException
	 */
	public function __construct($data) {
		if(
            (is_object($data) && !($data instanceof \Jyotish\Base\Data)) ||
            (!is_object($data) && !is_array($data))
        ){
            throw new Exception\InvalidArgumentException(
                "Data should be an array or instance of Jyotish\\Base\\Data"
            );
        }
		
		if (is_object($data)) {
            $this->data = $data->getData();
        }else{
			$this->data = $data;
		}
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
