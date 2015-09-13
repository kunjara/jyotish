<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga;

/**
 * Class with the names of divisional charts and their parameters.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Varga
{
    const KEY_D1  = 'D1';
    const KEY_D2  = 'D2';
    const KEY_D3  = 'D3';
    const KEY_D4  = 'D4';
    const KEY_D7  = 'D7';
    const KEY_D9  = 'D9';
    const KEY_D10 = 'D10';
    const KEY_D12 = 'D12';
    const KEY_D16 = 'D16';
    const KEY_D20 = 'D20';
    const KEY_D24 = 'D24';
    const KEY_D27 = 'D27';
    const KEY_D30 = 'D30';
    const KEY_D40 = 'D40';
    const KEY_D45 = 'D45';
    const KEY_D60 = 'D60';

    /**
     * Vargas names.
     * 
     * @var array 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 2-4.
     */
    public static $varga = [
        self::KEY_D1  => 'Rashi',
        self::KEY_D2  => 'Hora',
        self::KEY_D3  => 'Drekkana',
        self::KEY_D4  => 'Chaturthamsha',
        self::KEY_D7  => 'Saptamamsha',
        self::KEY_D9  => 'Navamsha',
        self::KEY_D10 => 'Dashamsha',
        self::KEY_D12 => 'Dvadashamsha',
        self::KEY_D16 => 'Shodashamsha',
        self::KEY_D20 => 'Vimshamsha',
        self::KEY_D24 => 'Chaturvimshamsha',
        self::KEY_D27 => 'Saptavimshamsha',
        self::KEY_D30 => 'Trimshamsha',
        self::KEY_D40 => 'Khavedamsha',
        self::KEY_D45 => 'Akshavedamsha',
        self::KEY_D60 => 'Shashtiamsha',
    ];

    /**
     * The full Bal for each of the divisions consisting Shad Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
     */
    public static $balaShadVarga = [
        self::KEY_D1  => 6,
        self::KEY_D2  => 2,
        self::KEY_D3  => 4,
        self::KEY_D9  => 5,
        self::KEY_D12 => 2,
        self::KEY_D30 => 1
    ];

    /**
     * The full Bal for each of the divisions consisting Sapta Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
     */
    public static $balaSaptaVarga = [
        self::KEY_D1  => 5,
        self::KEY_D2  => 2,
        self::KEY_D3  => 3,
        self::KEY_D9  => 2.5,
        self::KEY_D12 => 4.5,
        self::KEY_D30 => 2,
        self::KEY_D7  => 1
    ];

    /**
     * The full Bal for each of the divisions consisting Dasha Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 20.
     */
    public static $balaDashaVarga = [
        self::KEY_D1  => 3,
        self::KEY_D2  => 1.5,
        self::KEY_D3  => 1.5,
        self::KEY_D9  => 1.5,
        self::KEY_D12 => 1.5,
        self::KEY_D30 => 1.5,
        self::KEY_D7  => 1.5,
        self::KEY_D10 => 1.5,
        self::KEY_D16 => 1.5,
        self::KEY_D60 => 5
    ];

    /**
     * The full Bal for each of the divisions consisting Shodasha Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 21-25.
     */
    public static $balaShodashaVarga = [
        self::KEY_D1  => 3.5,
        self::KEY_D2  => 1,
        self::KEY_D3  => 1,
        self::KEY_D9  => 3,
        self::KEY_D12 => 0.5,
        self::KEY_D30 => 1,
        self::KEY_D7  => 0.5,
        self::KEY_D10 => 0.5,
        self::KEY_D16 => 2,
        self::KEY_D60 => 4,
        self::KEY_D20 => 0.5,
        self::KEY_D24 => 0.5,
        self::KEY_D27 => 0.5,
        self::KEY_D4  => 0.5,
        self::KEY_D40 => 0.5,
        self::KEY_D45 => 0.5
    ];

    /**
     * Returns the requested instance of varga class.
     * 
     * @param string $key The key of varga
     * @param null|array $options Options to set (optional)
     * @return the requested instance of varga class
     * @throws Exception\InvalidArgumentException
     */
    public static function getInstance($key, $options = null) {
        $keyUcfirst = ucfirst($key);
        
        if (!array_key_exists($keyUcfirst, self::$varga)) {
            throw new Exception\InvalidArgumentException("Varga '$key' is not defined.");
        }
        
        $vargaClass = 'Jyotish\\Varga\\Object\\' . ucfirst($keyUcfirst);
        $vargaObject = new $vargaClass($options);

        return $vargaObject;
    }
}