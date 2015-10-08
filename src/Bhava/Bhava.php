<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava;

/**
 * Class with Bhava names.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bhava
{
    const NAME_1 = 'Tanu';
    const NAME_2 = 'Dhana';
    const NAME_3 = 'Sahaja';
    const NAME_4 = 'Sukha';
    const NAME_5 = 'Putra';
    const NAME_6 = 'Ari';
    const NAME_7 = 'Yuvati';
    const NAME_8 = 'Mrityu';
    const NAME_9 = 'Dharma';
    const NAME_10 = 'Karma';
    const NAME_11 = 'Labha';
    const NAME_12 = 'Vyaya';
    
    /**
     * List of bhavas.
     * 
     * @var array 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 37-38.
     */
    public static $bhava = [
        1 => self::NAME_1,
        2 => self::NAME_2,
        3 => self::NAME_3,
        4 => self::NAME_4,
        5 => self::NAME_5,
        6 => self::NAME_6,
        7 => self::NAME_7,
        8 => self::NAME_8,
        9 => self::NAME_9,
        10 => self::NAME_10,
        11 => self::NAME_11,
        12 => self::NAME_12,
    ];

    /**
     * Kendra (chatustaya) bhavas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 17.
     */
    public static $bhavaKendra = [1, 4, 7, 10];
    
    /**
     * Panaphara bhavas (succedents).
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 18.
     */
    public static $bhavaPanaphara = [2, 5, 8, 11];
    
    /**
     * Apoklima bhavas (cedents).
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 18.
     */
    public static $bhavaApoklima = [3, 6, 9, 12];

    /**
     * Trikona bhavas.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @var array
     */
    public static $bhavaTrikona = [1, 5, 9];
    
    /**
     * Dusthana bhavas.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @var array
     */
    public static $bhavaDusthana = [6, 8, 12];
    
    /**
     * Chaturashra bhavas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 16.
     */
    public static $bhavaChaturashra = [4, 8];

    /**
     * Upachaya bhavas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 33-36.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 15.
     */
    public static $bhavaUpachaya = [3, 6, 10, 11];
    
    /**
     * Trishadaya bhavas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 34, Verse 2-7.
     */
    public static $bhavaTrishadaya = [3, 6, 11];
    
    /**
     * Parashraya bhavas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 34, Verse 2-7.
     */
    public static $bhavaParashraya = [2, 8, 12];

    /**
     * Devanagari 'bhava' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    public static $translit = ['bha','aa','va'];

    /**
     * Returns the requested instance of bhava class.
     * 
     * @param int $number The number of bhava
     * @param null|array $options Options to set (optional)
     * @return the requested instance of bhava class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($number, array $options = null)
    {
        if (!array_key_exists($number, self::$bhava)) {
            throw new Exception\InvalidArgumentException("Bhava with the number '$number' does not exist.");
        }
        
        $bhavaClass = 'Jyotish\\Bhava\\Object\\B' . $number;
        $bhavaObject = new $bhavaClass($options);

        return $bhavaObject;
    }
}