<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Alphabet;

use Jyotish\Base\Utils;

/**
 * Language class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Language
{
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
            $html = self::trToHtml($tr);
        }

        return $html;
    }

    protected static function trToHtml($tr)
    {
        switch ($tr) {
            case null:
                return;
            case ' ':
                return $tr;
            default:
                break;
        }

        if (defined('static::'.$tr)) {
            return Utils::unicodeToHtml(constant('static::'.$tr));
        } else {
            throw new Exception\InvalidArgumentException("Transliteration '$tr' is not defined.");
        }
    }
}