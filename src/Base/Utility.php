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
class Utility
{
    const LABEL_TRADITIONAL = 0;
    const LABEL_UNICODE = 1;
    const LABEL_USER = 2;

    public static $labelTypes = [
        self::LABEL_TRADITIONAL,
        self::LABEL_UNICODE,
        self::LABEL_USER,
    ];

    /**
     * Convert unicode to html code.
     * 
     * @param array|string $unicode
     * @return string
     */
    public static function unicodeToHtml($unicode)
    {
        if (is_array($unicode)) {
            $html = '';
            foreach ($unicode as $code) {
                $html .= '&#x' . $code . ';';
            }
        } else {
            $html = '&#x' . $unicode . ';';
        }

        return $html;
    }

    /**
     * Convert html color to rgb representation.
     * 
     * @param string $color
     * @return bool|array
     */
    public static function htmlToRgb($color)
    {
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        if (strlen($color) == 6) {
            list($r, $g, $b) = [
                $color[0] . $color[1],
                $color[2] . $color[3],
                $color[4] . $color[5]
            ];
        } elseif (strlen($color) == 3) {
            list($r, $g, $b) = [
                $color[0] . $color[0],
                $color[1] . $color[1],
                $color[2] . $color[2]
            ];
        } else {
            return false;
        }

        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return ['r' => $r, 'g' => $g, 'b' => $b];
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
    public static function dmsToStirng(array $dms)
    {
        $d = $dms['d'].'&deg;';
        $m = !empty($dms['m']) ? $dms['m'].'\'' : '';
        $s = !empty($dms['s']) ? $dms['s'].'"' : '';

        return $d.$m.$s;
    }
}