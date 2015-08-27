<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

/**
 * Class of mahatattva data.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Maha
{
    /**
     * Mode of goodness
     */
    const GUNA_SATTVA = 'sattva';
    /**
     * Mode of passion
     */
    const GUNA_RAJA = 'raja';
    /**
     * Mode of ignorance
     */
    const GUNA_TAMA = 'tama';

    /**
     * Ether
     */
    const BHUTA_AKASH = 'akash';
    /**
     * Air
     */
    const BHUTA_VAYU = 'vayu';
    /**
     * Fire
     */
    const BHUTA_AGNI = 'agni';
    /**
     * Water
     */
    const BHUTA_JALA = 'jala';
    /**
     * Earth
     */
    const BHUTA_PRITVI = 'pritvi';

    /**
     * North
     */
    const DISHA_UTTARA = 'uttara';
    /**
     * North-east
     */
    const DISHA_ISHANYA = 'ishanya';
    /**
     * East
     */
    const DISHA_PURVA = 'purva';
    /**
     * South-east
     */
    const DISHA_AGNEYA = 'agneya';
    /**
     * South
     */
    const DISHA_DAKSHINA = 'dakshina';
    /**
     * South-west
     */
    const DISHA_NAIRUTYA = 'nairutya';
    /**
     * West
     */
    const DISHA_PASCHIMA = 'paschima';
    /**
     * North-west
     */
    const DISHA_VAYAVYA = 'vayavya';
    /**
     * Zenith
     */
    const DISHA_URDHWA = 'urdhwa';
    /**
     * Nadir
     */
    const DISHA_ADHARA = 'adhara';

    /**
     * Mineral
     */
    const BASIS_DHATU = 'dhatu';
    /**
     * Plants and trees
     */
    const BASIS_MULA = 'mula';
    /**
     *  Living beings
     */
    const BASIS_JIVA = 'jiva';
    
    const COLOR_BLACK = 'black';
    const COLOR_COPPER = 'copper';
    const COLOR_FAWN = 'fawn';
    const COLOR_GOLD = 'gold';
    const COLOR_GREEN = 'green';
    const COLOR_INDIAN_RED = 'indian red';
    const COLOR_RED = 'red';
    const COLOR_SCARLET = 'scarlet';
    const COLOR_SPRING_GREEN = 'spring green';
    const COLOR_VARIEGATED = 'variegated';
    const COLOR_WHITE = 'white';
    const COLOR_YELLOW = 'yellow';
    
    /**
     * List of gunas.
     * 
     * @var array
     */
    public static $guna = [
        self::GUNA_SATTVA,
        self::GUNA_RAJA,
        self::GUNA_TAMA,
    ];
    
    /**
     * List of bhutas.
     * 
     * @var array
     */
    public static $bhuta = [
        self::BHUTA_AKASH,
        self::BHUTA_VAYU,
        self::BHUTA_AGNI,
        self::BHUTA_JALA,
        self::BHUTA_PRITVI,
    ];
    
    /**
     * List of dishas.
     * 
     * @var array
     */
    public static $disha = [
        self::DISHA_UTTARA,
        self::DISHA_ISHANYA,
        self::DISHA_PURVA,
        self::DISHA_AGNEYA,
        self::DISHA_DAKSHINA,
        self::DISHA_NAIRUTYA,
        self::DISHA_PASCHIMA,
        self::DISHA_VAYAVYA,
        self::DISHA_URDHWA,
        self::DISHA_ADHARA,
    ];
    
    /**
     * List of basises.
     * 
     * @var array
     */
    public static $basis = [
        self::BASIS_DHATU,
        self::BASIS_MULA,
        self::BASIS_JIVA,
    ];

    /**
     * List of colors.
     * 
     * @var array
     */
    public static $color = [
        self::COLOR_BLACK => '000000',
        self::COLOR_COPPER => 'b87333',
        self::COLOR_FAWN => 'e5aa70',
        self::COLOR_GOLD => 'ffd700',
        self::COLOR_GREEN => '008000',
        self::COLOR_INDIAN_RED => 'cd5c5c',
        self::COLOR_RED => 'ff0000',
        self::COLOR_SCARLET => 'ff2400',
        self::COLOR_SPRING_GREEN => '00ff7f',
        self::COLOR_WHITE => 'ffffff',
        self::COLOR_YELLOW => 'ffff00',
    ];
    
    /**
     * Get list of dishas.
     * 
     * @param int $number Number of dishas.
     * @return array List of dishas.
     */
    public static function listDisha($number)
    {
        switch ($number) {
            case 2:
                $list = array_slice(self::$disha, 8, 2);
                break;
            case 4:
                $list = [
                    self::DISHA_UTTARA,
                    self::DISHA_PURVA,
                    self::DISHA_DAKSHINA,
                    self::DISHA_PASCHIMA,
                ];
                break;
            case 8:
                $list = array_slice(self::$disha, 0, 8);
                break;
            case 10:
            default:
                $list = self::$disha;
        }
        return $list;
    }
}
