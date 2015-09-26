<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Alphabet;

use Jyotish\Base\Utility;

/**
 * Language class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Language
{
    private static $notTranslit = [
        '', ' ', '-'
    ];

    /**
     * Convert translit to html code.
     * 
     * @param array|string $translit
     * @return string
     */
    public static function translitToHtml($translit)
    {
        $html = '';
        if (is_array($translit)) {
            foreach ($translit as $tr) {
                $html .= self::trToHtml($tr);
            }
        } else {
            $html = self::trToHtml($translit);
        }

        return $html;
    }

    /**
     * Convert translit symbol to html code.
     * 
     * @param string $tr
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    protected static function trToHtml($tr)
    {
        if (in_array($tr, self::$notTranslit)) {
            return $tr;
        }

        if (defined('static::'.$tr)) {
            return Utility::unicodeToHtml(constant('static::'.$tr));
        } else {
            throw new Exception\InvalidArgumentException("Transliteration '$tr' is not defined.");
        }
    }
}