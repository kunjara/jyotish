<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

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
            foreach ($unicode as $code){
                $html .= '&#x' . $code . ';';
            }
        }else{
            $html = '&#x' . $unicode . ';';
        }

        return $html;
    }

    /**
     * Convert html color to rgb representation.
     * 
     * @param string $color
     * @return array
     */
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

    /**
     * Shift to the right array key
     * 
     * @param array $array
     * @param string $startKey
     * @return array
     */ 
    static public function shiftArray($array, $startKey, $preserveKeys = false){
        reset($array);
        $tab = 0;

        while(key($array) != $startKey){
            $tab++;
            next($array);

            if($tab > count($array)) {
                return $array;
            }
        }

        $result = array_slice($array, $tab, null, $preserveKeys) + array_slice($array, 0, $tab, $preserveKeys);

        return $result;
    }

    /**
     * Degree, minutes and seconds to string.
     * 
     * @param array $dms Array of values: d - degrees, m - minutes, s - seconds.
     * For example,
     * <pre>
     * ['d' => 30, 'm' => 20, 's' => 10]
     * </pre>
     * @return string
     */	
    static function dmsToStirng(array $dms)
    {
        $d = $dms['d'].'&deg;';
        $m = !empty($dms['m']) ? $dms['m'].'\'' : '';
        $s = !empty($dms['s']) ? $dms['s'].'"' : '';

        return $d.$m.$s;
    }
}