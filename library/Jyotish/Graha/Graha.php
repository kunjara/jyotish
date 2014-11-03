<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha {
    const GRAHA_SY = 'Sy';
    const GRAHA_CH = 'Ch';
    const GRAHA_MA = 'Ma';
    const GRAHA_BU = 'Bu';
    const GRAHA_GU = 'Gu';
    const GRAHA_SK = 'Sk';
    const GRAHA_SA = 'Sa';
    const GRAHA_RA = 'Ra';
    const GRAHA_KE = 'Ke';

    const LAGNA = 'Lg';

    /**
     * Benefic character
     */
    const CHARACTER_SHUBHA = 'shubha';
    /**
     * Malefic character
     */
    const CHARACTER_PAPA   = 'papa';
    /**
     * Mixed character
     */
    const CHARACTER_MISHA  = 'mishra';

    const RISING_NOREFRAC   = 'norefrac';
    const RISING_DISCCENTER = 'disccenter';
    const RISING_HINDU      = 'hindu';

    /**
     * Names of Grahas.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    static public $graha = array(
        self::GRAHA_SY => 'Surya',
        self::GRAHA_CH => 'Chandra',
        self::GRAHA_MA => 'Mangala',
        self::GRAHA_BU => 'Budha',
        self::GRAHA_GU => 'Guru',
        self::GRAHA_SK => 'Shukra',
        self::GRAHA_SA => 'Shani',
        self::GRAHA_RA => 'Rahu',
        self::GRAHA_KE => 'Ketu'
    );

    /**
     * Specifications for risings and settings.
     * 
     * @var array
     */
    static public $risingType = array(
        self::RISING_NOREFRAC,
        self::RISING_DISCCENTER,
        self::RISING_HINDU,
    );

    /**
     * Devanagari 'graha' in transliteration.
     * 
     * @var array
     * @see Jyotish\Alphabet\Devanagari
     */
    static public $translit = ['ga','virama','ra','ha'];

    /**
     * Returns the requested instance of graha class.
     * 
     * @param string $key The acronym of graha
     * @param null|array $options (Optional) Options to set
     * @return the requested instance of graha class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key, $options = null) {
        if (array_key_exists($key, self::$graha)) {
            $grahaClass = 'Jyotish\Graha\Object\\' . $key;
            $grahaObject = new $grahaClass($options);

            return $grahaObject;
        } else {
            throw new Exception\InvalidArgumentException("Graha with the key '$key' does not exist.");
        }
    }

    /**
     * Get grahas by character.
     * 
     * @param string $character
     * @return array
     */
    static public function getGrahaByCharacter($character)
    {
        $result = array();

        foreach (Graha::$graha as $key => $name){
            $Graha = self::getInstance($key);

            if($Graha->grahaCharacter == $character)
                $result[$key] = $name;
            else
                continue;
        }
        return $result;
    }

    /**
     * Get mutual relationship between grahas in points.
     * 
     * @param string $graha1
     * @param string $graha2
     * @return int
     */
    static public function getMutualRelation($graha1, $graha2)
    {
        $relation = function($graha1, $graha2)
        {
            $Graha = self::getInstance($graha1, array('relationSame' => true));
            return $Graha->grahaNaturalRelation[$graha2];
        };
        $relation1 = $relation($graha1, $graha2);
        $relation2 = $relation($graha2, $graha1);

        $add = ($relation1 < 0 or $relation2 < 0) ? 2 : 3;

        return $relation1 + $relation2 + $add;
    }
}