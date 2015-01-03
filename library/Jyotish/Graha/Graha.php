<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha;

use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Class with Graha names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Graha {
    /**
     * Key of Sun
     */
    const KEY_SY = 'Sy';
    /**
     * Key of Moon
     */
    const KEY_CH = 'Ch';
    /**
     * Key of Mars
     */
    const KEY_MA = 'Ma';
    /**
     * Key of Mercury
     */
    const KEY_BU = 'Bu';
    /**
     * Key of Jupiter
     */
    const KEY_GU = 'Gu';
    /**
     * Key of Venus
     */
    const KEY_SK = 'Sk';
    /**
     * Key of Saturn
     */
    const KEY_SA = 'Sa';
    /**
     * Key of Rahu (north lunar node)
     */
    const KEY_RA = 'Ra';
    /**
     * Key of Ketu (south lunar node)
     */
    const KEY_KE = 'Ke';
    /**
     * Key of Ascendant
     */
    const KEY_LG = 'Lg';
    
    /**
     * Name of Rahu (north lunar node)
     */
    const NAME_RA = 'Rahu';
    /**
     * Name of Ketu (south lunar node)
     */
    const NAME_KE = 'Ketu';
    /**
     * Name of Ascendant
     */
    const NAME_LG = 'Lagna';

    /**
     * Benefic character
     */
    const CHARACTER_SHUBHA = 'shubha';
    /**
     * Malefic character
     */
    const CHARACTER_PAPA = 'papa';
    /**
     * Mixed character
     */
    const CHARACTER_MISHA = 'mishra';
    
    /**
     * Paramatma amsha
     */
    const AMSHA_PARAMATMA = 'paramatma';
    /**
     * Jeeva amsha
     */
    const AMSHA_JIVATMA = 'jivatma';

    const RISING_NOREFRAC   = 'norefrac';
    const RISING_DISCCENTER = 'disccenter';
    const RISING_HINDU      = 'hindu';
    
    /**
     * Nine grahas
     */
    const LIST_NAVA  = 'nava';
    /**
     * Seven grahas (without Rahu and Ketu)
     */
    const LIST_SAPTA = 'sapta';
    /**
     * five grahas (without Surya, Chandra, Rahu and Ketu)
     */
    const LIST_PANCHA = 'pancha';
    /**
     * Shadowy grahas (Rahu and Ketu)
     */
    const LIST_CHAYA = 'chaya';

    /**
     * List of Grahas.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    static public $graha = array(
        self::KEY_SY => Deva::DEVA_SURYA,
        self::KEY_CH => Deva::DEVA_CHANDRA,
        self::KEY_MA => Deva::DEVA_MANGAL,
        self::KEY_BU => Deva::DEVA_BUDHA,
        self::KEY_GU => Deva::DEVA_GURU,
        self::KEY_SK => Deva::DEVA_SHUKRA,
        self::KEY_SA => Deva::DEVA_SHANI,
        self::KEY_RA => self::NAME_RA,
        self::KEY_KE => self::NAME_KE,
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
     * @param string $key The key of graha
     * @param null|array $options (Optional) Options to set
     * - `relationSame`: relationship between the same grahas
     * - `relationChaya`: relationship between the chaya grahas
     * - `specificRashi`: set specific rashi for chaya grahas
     * - `drishtiRahu`: set drishti for Rahu
     * @return the requested instance of graha class
     * @throws Exception\InvalidArgumentException
     */
    static public function getInstance($key, $options = null) {
        if (!array_key_exists($key, self::$graha)) {
            throw new Exception\InvalidArgumentException("Graha with the key '$key' does not exist.");
        }
        
        $grahaClass = 'Jyotish\Graha\Object\\' . $key;
        $grahaObject = new $grahaClass($options);

        return $grahaObject;
    }

    /**
     * Get grahas by feature.
     * 
     * @param string $feature Feature of graha
     * @param string $value Value of feature
     * @return array
     */
    static public function getGrahaByFeature($feature, $value)
    {
        $result = array();

        foreach (Graha::$graha as $key => $name){
            $Graha = self::getInstance($key);
            
            $grahaFeature = 'graha' . ucfirst(strtolower($feature));
            
            if(!property_exists($Graha, $grahaFeature)){
                throw new Exception\UnexpectedValueException("Graha feature '$grahaFeature' does not exist.");
            }

            if($Graha->$grahaFeature == $value)
                $result[$key] = $name;
            else
                continue;
        }
        return $result;
    }

    /**
     * Get mutual relationship between grahas in points.
     * 
     * @param string $graha1 Graha key
     * @param string $graha2 Graha key
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
    
    /**
     * Get list of grahas.
     * 
     * @param string $option The option to list grahas.
     * @return array List of grahas.
     */
    static public function grahaList($option = self::LIST_NAVA)
    {
        switch ($option){
            case self::LIST_SAPTA:
                $list = array_slice(self::$graha, 0, 7);
                break;
            case self::LIST_PANCHA:
                $list = array_slice(self::$graha, 2, 5);
                break;
            case self::LIST_CHAYA:
                $list = array_slice(self::$graha, 7);
                break;
            case self::LIST_NAVA:
            default:
                $list = self::$graha;
        }
        return $list;
    }
}