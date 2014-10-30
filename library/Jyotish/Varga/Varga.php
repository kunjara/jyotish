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
class Varga {

    const VARGA_D1 = 'D1';
    const VARGA_D2 = 'D2';
    const VARGA_D3 = 'D3';
    const VARGA_D4 = 'D4';
    const VARGA_D7 = 'D7';
    const VARGA_D9 = 'D9';
    const VARGA_D10 = 'D10';
    const VARGA_D12 = 'D12';
    const VARGA_D16 = 'D16';
    const VARGA_D20 = 'D20';
    const VARGA_D24	= 'D24';
    const VARGA_D27 = 'D27';
    const VARGA_D30 = 'D30';
    const VARGA_D40 = 'D40';
    const VARGA_D45 = 'D45';
    const VARGA_D60 = 'D60';

    /**
     * Vargas names.
     * 
     * @var array 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 2-4.
     */
    static public $varga = array(
        self::VARGA_D1 => 'Rashi',
        self::VARGA_D2 => 'Hora',
        self::VARGA_D3 => 'Drekkana',
        self::VARGA_D4 => 'Chaturthamsha',
        self::VARGA_D7 => 'Saptamamsha',
        self::VARGA_D9 => 'Navamsha',
        self::VARGA_D10 => 'Dashamsha',
        self::VARGA_D12 => 'Dvadashamsha',
        self::VARGA_D16 => 'Shodashamsha',
        self::VARGA_D20 => 'Vimshamsha',
        self::VARGA_D24 => 'Chaturvimshamsha',
        self::VARGA_D27 => 'Saptavimshamsha',
        self::VARGA_D30 => 'Trimshamsha',
        self::VARGA_D40 => 'Khavedamsha',
        self::VARGA_D45 => 'Akshavedamsha',
        self::VARGA_D60 => 'Shashtiamsha',
    );

    /**
     * The full Bal for each of the divisions consisting Shad Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
     */
    static public $balaShadVarga = array(
        self::VARGA_D1	=> 6,
        self::VARGA_D2	=> 2,
        self::VARGA_D3	=> 4,
        self::VARGA_D9	=> 5,
        self::VARGA_D12 => 2,
        self::VARGA_D30 => 1
    );

    /**
     * The full Bal for each of the divisions consisting Sapta Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 17-19.
     */
    static public $balaSaptaVarga = array(
        self::VARGA_D1	=> 5,
        self::VARGA_D2	=> 2,
        self::VARGA_D3	=> 3,
        self::VARGA_D9	=> 2.5,
        self::VARGA_D12 => 4.5,
        self::VARGA_D30 => 2,
        self::VARGA_D7	=> 1
    );

    /**
     * The full Bal for each of the divisions consisting Dasha Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 20.
     */
    static public $balaDashaVarga = array(
        self::VARGA_D1	=> 3,
        self::VARGA_D2	=> 1.5,
        self::VARGA_D3	=> 1.5,
        self::VARGA_D9	=> 1.5,
        self::VARGA_D12 => 1.5,
        self::VARGA_D30 => 1.5,
        self::VARGA_D7	=> 1.5,
        self::VARGA_D10 => 1.5,
        self::VARGA_D16 => 1.5,
        self::VARGA_D60 => 5
    );

    /**
     * The full Bal for each of the divisions consisting Shodasha Varga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 7, Verse 21-25.
     */
    static public $balaShodashaVarga = array(
        self::VARGA_D1	=> 3.5,
        self::VARGA_D2	=> 1,
        self::VARGA_D3	=> 1,
        self::VARGA_D9	=> 3,
        self::VARGA_D12 => 0.5,
        self::VARGA_D30 => 1,
        self::VARGA_D7	=> 0.5,
        self::VARGA_D10 => 0.5,
        self::VARGA_D16 => 2,
        self::VARGA_D60 => 4,
        self::VARGA_D20 => 0.5,
        self::VARGA_D24 => 0.5,
        self::VARGA_D27 => 0.5,
        self::VARGA_D4	=> 0.5,
        self::VARGA_D40 => 0.5,
        self::VARGA_D45 => 0.5
    );

    /**
     * Returns the requested instance of varga class.
     * 
     * @param string $key The acronym of varga
     * @param null|array $options (Optional) Options to set
     * @return the requested instance of varga class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key, $options = null) {
        if (array_key_exists($key, self::$varga)) {
            $vargaClass = 'Jyotish\\Varga\\Object\\' . $key;
            $vargaObject = new $vargaClass($options);

            return $vargaObject;
        } else {
            throw new Exception\InvalidArgumentException("Varga '$key' is not defined.");
        }
    }
}