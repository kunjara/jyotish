<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Base\Biblio;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * Class of graha Ra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ra extends GrahaObject
{
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
     * Amsha of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 2.
     */
    protected $grahaAmsha = Graha::AMSHA_PARAMATMA;
    
    /**
     * Avatara of the Graha.
     * 
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara = 'Varaha';
    
    /**
     * Names of the graha.
     * 
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 3.
     */
    protected $objectNames = [
        'Tamas',
        'Agu',
        'Asura',
    ];

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
    protected $grahaDrishti = [];

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
    protected $grahaLongitudeSpeedAvg = ['d' => 0, 'm' => 3, 's' => 10.8];

    /**
     * Set exaltation, sebilitation, mooltrikon and own.
     * 
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 47, Verse 34-39.
     * @see Venkatesh Sharma. Sarvarth Chintamani. Chapter 16, Verse 1-2.
     */
    protected function setGrahaSpecificRashiByViewpoint()
    {
        switch ($this->optionSpecificRashi) {
            case Biblio::BOOK_SC:
                $this->setGrahaSpecificRashi(['ucha' => 2, 'mool' => 11, 'swa' => null, 'neecha' => 8]);
                break;
            case Biblio::BOOK_BPHS:
            default:
                $this->setGrahaSpecificRashi(['ucha' => 2, 'mool' => 3, 'swa' => 11, 'neecha' => 8]);
        }
    }

    /**
     * Set graha drishti.
     */
    protected function setGrahaDrishti()
    {
        switch ($this->optionDrishtiRahu) {
            case 'srath':
                $this->grahaDrishti = [
                    2 => 1,
                    7 => 1,
                    12 => 1
                ];
                break;
            default:
                $this->grahaDrishti = [
                    5 => 1,
                    7 => 1,
                    9 => 1
                ];
                break;
        }
    }

    /**
     * Set natural relationships.
     */
    protected function setGrahaRelation()
    {
        if ($this->optionRelationChaya == 'friends') {
            foreach (Graha::$graha as $key => $name) {
                if ($key != Graha::KEY_KE) {
                    $this->grahaRelation[$key] = -1;
                } else {
                    $this->grahaRelation[$key] = 1;
                }
            }
        } else {
            $this->grahaRelation = [
                Graha::KEY_SY => -1,
                Graha::KEY_CH => -1,
                Graha::KEY_MA => -1,
                Graha::KEY_BU => 1,
                Graha::KEY_GU => 0,
                Graha::KEY_SK => 1,
                Graha::KEY_SA => 1,
                Graha::KEY_KE => -1,
            ];
        }
        $this->grahaRelation[$this->objectKey] = $this->optionRelationSame ? 1 : null;
    }

    public function __construct($options = null)
    {
        parent::__construct($options);
        
        $this->setGrahaSpecificRashiByViewpoint();
        $this->setGrahaDrishti();
    }
}