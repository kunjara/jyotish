<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bala;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;

/**
 * AshtakaVarga class. Northern India the benefic points are called rekhas or 
 * vertical lines while malefic points are known as bindus. It is the reverse 
 * of the terminology used in South India.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class AshtakaVarga
{
    use \Jyotish\Base\Traits\DataTrait;

    /**
     * Bhinnashtakavarga (Prashtarashtakavarga) of 7 grahas and lagna.
     * 
     * @var array
     */
    protected $bhinnAshtakavarga = [];

    /**
     * Sarvashtakavarga (Samudayashtakavarga).
     * 
     * @var array
     */
    protected $sarvAshtakavarga = [];

    /**
     * Eight vargas.
     * 
     * @var type 
     */
    protected $ashtakavarga = [
        Graha::KEY_SY,
        Graha::KEY_CH,
        Graha::KEY_MA,
        Graha::KEY_BU,
        Graha::KEY_GU,
        Graha::KEY_SK,
        Graha::KEY_SA,
        Graha::KEY_LG
    ];

    /**
     * Bindu in Surya Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 43-45.
     */
    protected $binduSy = [
        Graha::KEY_SY => [1, 2, 4, 7, 8, 9, 10, 11],
        Graha::KEY_CH => [3, 6, 10, 11],
        Graha::KEY_MA => [1, 2, 4, 7, 8, 9, 10, 11],
        Graha::KEY_BU => [3, 5, 6, 9, 10, 11, 12],
        Graha::KEY_GU => [5, 6, 9, 11],
        Graha::KEY_SK => [6, 7, 12],
        Graha::KEY_SA => [1, 2, 4, 7, 8, 9, 10, 11],
        Graha::KEY_LG => [3, 4, 6, 10, 11, 12]
    ];

    /**
     * Bindu in Chandra Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 46-48.
     */
    protected $binduCh = [
        Graha::KEY_SY => [3, 6, 7, 8, 10, 11],
        Graha::KEY_CH => [1, 3, 6, 7, 9, 10, 11],
        Graha::KEY_MA => [2, 3, 5, 6, 10, 11],
        Graha::KEY_BU => [1, 3, 4, 5, 7, 8, 10, 11],
        Graha::KEY_GU => [1, 2, 4, 7, 8, 10, 11],
        Graha::KEY_SK => [3, 4, 5, 7, 9, 10, 11],
        Graha::KEY_SA => [3, 5, 6, 11],
        Graha::KEY_LG => [3, 6, 10, 11]
    ];

    /**
     * Bindu in Mangal Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 49-50.
     */
    protected $binduMa = [
        Graha::KEY_SY => [3, 5, 6, 10, 11],
        Graha::KEY_CH => [3, 6, 11],
        Graha::KEY_MA => [1, 2, 4, 7, 8, 10, 11],
        Graha::KEY_BU => [3, 5, 6, 11],
        Graha::KEY_GU => [6, 10, 11, 12],
        Graha::KEY_SK => [6, 8, 11, 12],
        Graha::KEY_SA => [1, 4, 7, 8, 9, 10, 11],
        Graha::KEY_LG => [1, 3, 6, 10, 11]
    ];

    /**
     * Bindu in Buddha Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 51-52.
     */
    protected $binduBu = [
        Graha::KEY_SY => [5, 6, 9, 11, 12],
        Graha::KEY_CH => [2, 4, 6, 8, 10, 11],
        Graha::KEY_MA => [1, 2, 4, 7, 8, 9, 10, 11],
        Graha::KEY_BU => [1, 3, 5, 6, 9, 10, 11, 12],
        Graha::KEY_GU => [6, 8, 11, 12],
        Graha::KEY_SK => [1, 2, 3, 4, 5, 8, 9, 11],
        Graha::KEY_SA => [1, 2, 4, 7, 8, 9, 10, 11],
        Graha::KEY_LG => [1, 2, 4, 6, 8, 10, 11]
    ];

    /**
     * Bindu in Guru Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 53-55.
     */
    protected $binduGu = [
        Graha::KEY_SY => [1, 2, 3, 4, 7, 8, 9, 10, 11],
        Graha::KEY_CH => [2, 5, 7, 9, 11],
        Graha::KEY_MA => [1, 2, 4, 7, 8, 10, 11],
        Graha::KEY_BU => [1, 2, 4, 5, 6, 9, 10, 11],
        Graha::KEY_GU => [1, 2, 3, 4, 7, 8, 10, 11],
        Graha::KEY_SK => [2, 5, 6, 9, 10, 11],
        Graha::KEY_SA => [3, 5, 6, 12],
        Graha::KEY_LG => [1, 2, 4, 5, 6, 7, 9, 10, 11]
    ];

    /**
     * Bindu in Shukra Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 56-58.
     */
    protected $binduSk = [
        Graha::KEY_SY => [8, 11, 12],
        Graha::KEY_CH => [1, 2, 3, 4, 5, 8, 9, 11, 12],
        Graha::KEY_MA => [3, 4, 6, 9, 11, 12],
        Graha::KEY_BU => [3, 5, 6, 9, 11],
        Graha::KEY_GU => [5, 8, 9, 10, 11],
        Graha::KEY_SK => [1, 2, 3, 4, 5, 8, 9, 10, 11],
        Graha::KEY_SA => [3, 4, 5, 8, 9, 10, 11],
        Graha::KEY_LG => [1, 2, 3, 4, 5, 8, 9, 11]
    ];

    /**
     * Bindu in Shani Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 59-60.
     */
    protected $binduSa = [
        Graha::KEY_SY => [1, 2, 4, 7, 8, 10, 11],
        Graha::KEY_CH => [3, 6, 11],
        Graha::KEY_MA => [3, 5, 6, 10, 11, 12],
        Graha::KEY_BU => [6, 8, 9, 10, 11, 12],
        Graha::KEY_GU => [5, 6, 11, 12],
        Graha::KEY_SK => [6, 11, 12],
        Graha::KEY_SA => [3, 5, 6, 11],
        Graha::KEY_LG => [1, 3, 4, 6, 10, 11]
    ];

    /**
     * Bindu in Lagna Ashtakavarga.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 66, Verse 65-68.
     */
    protected $binduLg = [
        Graha::KEY_SY => [3, 4, 6, 10, 11, 12],
        Graha::KEY_CH => [3, 6, 10, 11, 12],
        Graha::KEY_MA => [1, 3, 6, 10, 11],
        Graha::KEY_BU => [1, 2, 4, 6, 8, 10, 11],
        Graha::KEY_GU => [1, 2, 4, 5, 6, 7, 9, 10, 11],
        Graha::KEY_SK => [1, 2, 3, 4, 5, 8, 9],
        Graha::KEY_SA => [1, 3, 4, 6, 10, 11],
        Graha::KEY_LG => [3, 6, 10, 11]
    ];

    /**
     * Get Bhinnashtakavarga.
     * 
     * @return array
     */
    public function getBhinnAshtakavarga()
    {
        return $this->bhinnAshtakavarga;
    }

    /**
     * Get Sarvashtakavarga.
     * 
     * @return array
     */
    public function getSarvAshtakavarga($withLagna = false)
    {
        if ($withLagna) {
            return Math::arraySum($this->sarvAshtakavarga, $this->bhinnAshtakavarga[Graha::KEY_LG]);
        } else {
            return $this->sarvAshtakavarga;
        }
    }

    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);

        foreach ($this->ashtakavarga as $varga) {
            $binduVarga = 'bindu'.$varga;

            foreach ($this->ashtakavarga as $graha) {
                for ($i = 1; $i <= 12; $i++) {
                    $bindu = in_array($i, $this->{$binduVarga}[$graha]) ? 1 : 0; 

                    if ($graha != Graha::KEY_LG) {
                        $distance = Math::numberInCycle($this->getData()['graha'][$graha]['rashi'], $i);
                    } else {
                        $distance = Math::numberInCycle($this->getData()['lagna'][$graha]['rashi'], $i);
                    }
                    
                    if (!isset($this->bhinnAshtakavarga[$varga][$distance])) $this->bhinnAshtakavarga[$varga][$distance] = 0;
                    $this->bhinnAshtakavarga[$varga][$distance] += $bindu;
                }
            }
            ksort($this->bhinnAshtakavarga[$varga]);

            if ($varga != Graha::KEY_LG)
                $this->sarvAshtakavarga = Math::arraySum($this->bhinnAshtakavarga[$varga], $this->sarvAshtakavarga);
        }
    }
}
