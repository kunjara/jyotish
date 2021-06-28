<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Rashi\Object;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of rashi 9.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class R9 extends RashiBaseObject
{
    /**
     * Rashi key
     *
     * @var int
     */
    protected $objectKey = 9;

    /**
     * Devanagari title 'dhanu' in transliteration.
     *
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $rashiTranslit = ['dha','na','u'];

    /**
     * Unicode of rashi.
     *
     * @var string
     */
    protected $rashiUnicode = '2650';

    /**
     * Names of the rashi.
     *
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 8.
     */
    protected $objectNames = [
        'Toukshika',
    ];

    /**
     * Limb of Kaal Purush.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 4-4 1/2.
     */
    protected $rashiLimb = Manusha::LIMB_THIGHS;

    /**
     * Prakriti of rashi.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 5-5 1/2.
     */
    protected $rashiPrakriti = Ayurveda::PRAKRITI_PITTA;

    /**
     * Bala of rashi.
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiBala  = Rashi::BALA_RATRI;

    /**
     * Daya of rashi.
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 10.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 24.
     */
    protected $rashiDaya = Rashi::DAYA_PRUSHTA;

    /**
     * Type of rashi.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 17-18 1/2.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    protected $rashiType = array
    (
        'hora1' => Manusha::TYPE_NARA,
        'hora2' => Manusha::TYPE_PASU,
    );

    /**
     * Bhuta of rashi.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 17-18 1/2.
     */
    protected $rashiBhuta = Maha::BHUTA_AGNI;

    /**
     * Ruler of rashi.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 17-18 1/2.
     * @see Kalyana Varma. Saravali. Chapter 3, Verse 11.
     */
    protected $rashiRuler = Graha::KEY_GU;

    /**
     * Varna of rashi.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 4, Verse 17-18 1/2.
     */
    protected $rashiVarna = Manusha::VARNA_KSHATRIYA;
}
