<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Service;

/**
 * Class of utility functions.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Utils {

	const LABEL_TRADITIONAL = 0;
	const LABEL_UNICODE = 1;
	const LABEL_USER = 2;

	static public $labelTypes = array(
		self::LABEL_TRADITIONAL,
		self::LABEL_UNICODE,
		self::LABEL_USER,
	);
	
	/**
	 * Convert unicode to html code.
	 * 
	 * @param array|string $unicode
	 * @return string
	 */
	static public function unicodeToHtml($unicode) {
		if(is_array($unicode)){
			$htmlArray = array();
			
			foreach ($unicode as $code){
				$html .= '&#x' . $code . ';';
			}
		}else{
			$html = '&#x' . $unicode . ';';
		}
		
		return $html;
	}

	static public function htmlToRgb($color) {
		if ($color[0] == '#')
			$color = substr($color, 1);

		if (strlen($color) == 6)
			list($r, $g, $b) = array(
				$color[0] . $color[1],
				$color[2] . $color[3],
				$color[4] . $color[5]);
		elseif (strlen($color) == 3)
			list($r, $g, $b) = array(
				$color[0] . $color[0],
				$color[1] . $color[1],
				$color[2] . $color[2]);
		else
			return false;

		$r = hexdec($r);
		$g = hexdec($g);
		$b = hexdec($b);

		return array('r' => $r, 'g' => $g, 'b' => $b);
	}
	
	static public function partsToUnits($totalParts, $partsInUnit = 30, $flagRound = 'ceil') {
		switch ($flagRound) {
			case 'floor':
				$totalUnits	= floor($totalParts / $partsInUnit);
				break;
			case 'ceil':
			default:
				$totalUnits	= ceil($totalParts / $partsInUnit);
				break;
		}
		
		$restParts	= fmod($totalParts, $partsInUnit);
		
		return array ('units' => $totalUnits, 'parts' => $restParts);
	}

}