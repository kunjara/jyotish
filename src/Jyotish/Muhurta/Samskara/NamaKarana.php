<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta\Samskara;

/**
 * Class for Namakarana samskara
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class NamaKarana
{
    /**
     * List of the sounds appropriate to rashis.
     * 
     * @var array
     */
    public static $namaRashi = [
        1 => [
            'a'    => ['_a'],
            'la'   => ['la','aa'],
        ],
        2 => [
            'u'    => ['_u'],
            'va'   => ['va','aa'],
            'i'    => ['_i'],
            'e'    => ['_e'],
            'o'    => ['_o'],
        ],
        3 => [
            'ka'   => ['ka', 'aa'],
            'chha' => ['cha'],
            'bha'  => ['bha','aa'],
            'na'   => ['na','aa'],
        ],
        4 => [
            'bha'  => ['bha','aa'],
            'ha'   => ['ha','aa'],
        ],
        5 => [
            'ta'   => ['tta','aa'],
        ],
        6 => [
            'pa'   => ['pa','aa'],
            'tha'  => ['tha'],
            'ya'   => ['ya','aa'],
            'na'   => ['na','aa'],
        ],
        7 => [
            'ra'   => ['ra','aa'],
            'ta'   => ['ta','aa'],
        ],
        8 => [
            'na'   => ['na','aa'],
            'ya'   => ['ya','aa'],
        ],
        9 => [
            'bha'  => ['bha','aa'],
            'pha'  => ['pha','aa'],
            'dha'  => ['dha','aa'],
        ],
        10 => [
            'tha'  => ['ttha'],
            'ja'   => ['ja','aa'],
        ],
        11 => [
            'ga'   => ['ga','aa'],
            'sa'   => ['sa','aa'],
        ],
        12 => [
            'da'   => ['dda','aa'],
            'cha'  => ['ca','aa'],
            'na'   => ['na','aa'],
            'dha'  => ['dha','aa'],
        ]
    ];

    /**
     * List of the sounds appropriate to nakshatra padas.
     * 
     * @var array
     */
    public static $namaPada = [
        1 => [
            'chu'  => ['ca','u'],
            'che'  => ['ca','e'],
            'cho'  => ['ca','o'],
            'la'   => ['la','aa'],
        ],
        2 => [
            'li'   => ['la','ii'],
            'lu'   => ['la','u'],
            'le'   => ['la','e'],
            'lo'   => ['la','o'],
        ],
        3 => [
            'a'    => ['_a'],
            'i'    => ['_i'],
            'u'    => ['_u'],
            'e'    => ['_e'],
        ],
        4 => [
            'o'    => ['_o'],
            'va'   => ['va','aa'],
            'vi'   => ['va','ii'],
            'vu'   => ['va','u'],
        ],
        5 => [
            've'   => ['va','e'],
            'vo'   => ['va', 'o'],
            'ka'   => ['ka', 'aa'],
            'ki'   => ['ka', 'ii'],
        ],
        6 => [
            'ku'   => ['ka','u'],
            'gha'  => ['gha'],
            'nga'  => ['nga'],
            'chha' => ['cha'],
        ],
        7 => [
            'ke'   => ['ka','e'],
            'ko'   => ['ka','o'],
            'ha'   => ['ha','aa'],
            'hi'   => ['ha','ii'],
        ],
        8 => [
            'hu'   => ['ha','u'],
            'he'   => ['ha','e'],
            'ho'   => ['ha','o'],
            'da'   => ['dda','aa'],
        ],
        9 => [
            'di'   => ['dda','ii'],
            'du'   => ['dda','u'],
            'de'   => ['dda','e'],
            'do'   => ['dda','o'],
        ],
        10 => [
            'ma'   => ['ma','aa'],
            'mi'   => ['ma','ii'],
            'mu'   => ['ma','u'],
            'me'   => ['ma','e'],
        ],
        11 => [
            'mo'   => ['ma','o'],
            'ta'   => ['tta','aa'],
            'ti'   => ['tta','ii'],
            'tu'   => ['tta','u'],
        ],
        12 => [
            'te'   => ['tta','e'],
            'to'   => ['tta','o'],
            'pa'   => ['pa','aa'],
            'pi'   => ['pa','ii'],
        ],
        13 => [
            'pu'   => ['pa','u'],
            'sha'  => ['ssa'],
            'na'   => ['nna'],
            'tha'  => ['ttha'],
        ],
        14 => [
            'pe'   => ['pa','e'],
            'po'   => ['pa','o'],
            'ra'   => ['ra','aa'],
            'ri'   => ['ra','ii'],
        ],
        15 => [
            'ru'   => ['ra','u'],
            're'   => ['ra','e'],
            'ro'   => ['ra','o'],
            'ta'   => ['ta','aa'],
        ],
        16 => [
            'ti'   => ['ta','ii'],
            'tu'   => ['ta','u'],
            'te'   => ['ta','e'],
            'to'   => ['ta','o'],
        ],
        17 => [
            'na'   => ['na','aa'],
            'ni'   => ['na','ii'],
            'nu'   => ['na','u'],
            'ne'   => ['na','e'],
        ],
        18 => [
            'no'   => ['na','o'],
            'ya'   => ['ya','aa'],
            'yi'   => ['ya','ii'],
            'yu'   => ['ya','u'],
        ],
        19 => [
            'ye'   => ['ya','e'],
            'yo'   => ['ya','o'],
            'bha'  => ['bha','aa'],
            'bhi'  => ['bha','ii'],
        ],
        20 => [
            'bhu'  => ['bha','u'],
            'dha'  => ['dha','aa'],
            'pha'  => ['pha','aa'],
            'ddha' => ['ddha','aa'],
        ],
        21 => [
            'bhe'  => ['bha','e'],
            'bho'  => ['bha','o'],
            'ja'   => ['ja','aa'],
            'ji'   => ['ja','ii'],
        ],
        22 => [
            'ju'   => ['ja','u'],
            'je'   => ['ja','e'],
            'jo'   => ['ja','o'],
            'gha'  => ['ghha','aa'],
        ],
        23 => [
            'ga'   => ['ga','aa'],
            'gi'   => ['ga','ii'],
            'gu'   => ['ga','u'],
            'ge'   => ['ga','e'],
        ],
        24 => [
            'go'   => ['ga','o'],
            'sa'   => ['sa','aa'],
            'si'   => ['sa','ii'],
            'su'   => ['sa','u'],
        ],
        25 => [
            'se'   => ['sa','e'],
            'so'   => ['sa','o'],
            'da'   => ['da','aa'],
            'di'   => ['da','ii'],
        ],
        26 => [
            'du'   => ['da','u'],
            'tha'  => ['tha'],
            'jha'  => ['jha'],
            'tra'  => ['ta','virama','ra'],
        ],
        27 => [
            'de'   => ['da','e'],
            'do'   => ['da','o'],
            'cha'  => ['ca','aa'],
            'chi'  => ['ca','ii'],
        ],
    ];
}