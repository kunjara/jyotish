<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Alphabet;

use Jyotish\Service\Utils;

/**
 * Language class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Language {
	
	/**
	 * Convert translit to html code.
	 * 
	 * @param array|string $translit
	 * @return string
	 */
	static public function translitToHtml($translit)
	{
		if(is_array($translit)){
			foreach ($translit as $tr){
				$html .= self::_trToHtml($tr);
			}
		}else{
			$html = self::_trToHtml($tr);
		}
		
		return $html;
	}
	
	static protected function _trToHtml($tr)
	{
		if(null === $tr) return;
		
		if(defined('static::'.$tr)){
			return Utils::unicodeToHtml(constant('static::'.$tr));
		}else{
			throw new Exception\InvalidArgumentException("Transliteration '$tr' is not defined.");
		}
	}
}

?>
