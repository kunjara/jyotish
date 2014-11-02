<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of graha Ra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ra extends GrahaObject {
    /**
     * Abbreviation of the graha
     * 
     * @var string
     */
    protected $objectKey = 'Ra';

    /**
     * Unicode of the Graha.
     * 
     * @var string
     */
    protected $grahaUnicode = '260A';

    /**
     * Avatara of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara = 'Varaha';

    /**
     * Main name of the graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     */
    protected $objectName = 'Rahu';

    /**
     * Devanagari title 'rahu' in transliteration.
     * 
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['ra','aa','ha','u'];

    /**
     * Character of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     */
    protected $grahaCharacter = Graha::CHARACTER_PAPA;

    /**
     * Deva of the Graha.
     * 
     * @var string
     */
    protected $grahaDeva = null;

    /**
     * Gender of the Graha.
     * 
     * @var string
     */
    protected $grahaGender = Manusha::GENDER_NEUTER;

    /**
     * Bhuta of the Graha.
     * 
     * @var string
     */
    protected $grahaBhuta = null;

    /**
     * Varna of the Graha.
     * 
     * @var string
     */
    protected $grahaVarna = Manusha::VARNA_MLECHHA;

    /**
     * Guna of the Graha.
     * 
     * @var string
     */
    protected $grahaGuna = Maha::GUNA_TAMA;

    /**
     * Dhatu of the Graha.
     * 
     * @var string
     */
    protected $grahaDhatu = null;

    /**
     * Kala of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 46.
     */
    protected $grahaKala = '8 masas';

    /**
     * Rasa of the Graha.
     * 
     * @var string
     */
    protected $grahaRasa = null;

    /**
     * Ritu of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     */
    protected $grahaRitu = '8 masas';

    /**
     * Graha basis.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis = Maha::BASIS_DHATU;

    /**
     * Graha disha
     * 
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha = Maha::DISHA_NAIRUTYA;

    /**
     * Graha drishti
     * 
     * @var array
     */
    protected $grahaDrishti = null;

    /**
     * Prakriti of graha
     * 
     * @var array
     */
    protected $grahaPrakriti = null;
    protected $grahaAgeMaturity = 48;
    protected $grahaAgePeriod = array
    (
        'start' => 69,
        'end' => 108
    );

    /**
     * Set exaltation, sebilitation, mooltrikon and own.
     * 
     * @param null|array $options Options to set
     */
    protected function setGrahaSpecificRashiByViewpoint($options)
    {
        switch ($options['specificRashi']){
            case('parashara'):
                $this->setGrahaSpecificRashi(['ex' => 2, 'mt' => 3, 'ow' => 11, 'db' => 8]);
                break;
            default:
                $this->setGrahaSpecificRashi(['ex' => 3, 'mt' => 11, 'ow' => 6, 'db' => 9]);
                break;
        }
    }

    /**
     * Set graha drishti.
     * 
     * @param null|array $options Options to set
     */
    protected function setGrahaDrishti($options)
    {
        switch ($options['drishtiRahu']){
            case('srath'):
                $this->grahaDrishti = array(
                    2 => 1,
                    7 => 1,
                    12 => 1
                );
                break;
            default:
                $this->grahaDrishti = array(
                    5 => 1,
                    7 => 1,
                    9 => 1
                );
                break;
        }
    }

    /**
     * Set natural relationships.
     * 
     * @param null|array $options Options to set
     */
    protected function setGrahaNaturalRelation($options)
    {
        if($options['relationChaya'] == 'friends'){
            foreach (Graha::$graha as $key => $name){
                if($key != Graha::GRAHA_KE){
                    $this->grahaNaturalRelation[$key] = -1;
                }else{
                    $this->grahaNaturalRelation[$key] = 1;
                }
            }
        }else{
            $this->grahaNaturalRelation = array(
                Graha::GRAHA_SY => -1,
                Graha::GRAHA_CH => -1,
                Graha::GRAHA_MA => -1,
                Graha::GRAHA_BU => 1,
                Graha::GRAHA_GU => 0,
                Graha::GRAHA_SK => 1,
                Graha::GRAHA_SA => 1,
                Graha::GRAHA_KE => -1,
            );
        }
        $this->grahaNaturalRelation[$this->objectKey] = $options['relationSame'] ? 1 : null;
    }

    public function __construct($options)
    {
        parent::__construct($options);
        
        $this->setGrahaSpecificRashiByViewpoint($this->options);
        $this->setGrahaDrishti($this->options);
    }
}