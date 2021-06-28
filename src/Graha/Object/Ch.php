<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Kala;
use Jyotish\Tattva\Maha;
use Jyotish\Base\Data;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of graha Ch.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ch extends GrahaBaseObject
{
    /**
     * Abbreviation of the graha
     *
     * @var string
     */
    protected $objectKey = 'Ch';

    /**
     * Unicode of the Graha.
     *
     * @var string
     */
    protected $grahaUnicode = '263D';

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
    protected $grahaAvatara = 'Krishna';

    /**
     * Names of the graha.
     *
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 2.
     */
    protected $objectNames = [
        'Sitarashmi',
    ];

    /**
     * Devanagari title 'chandra' in transliteration.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['ca','na','virama','da','virama','ra'];

    /**
     * Character of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaCharacter = Graha::CHARACTER_SHUBHA;

    /**
     * Colors of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 16-17.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 4-5.
     */
    protected $grahaColor = [
        Maha::COLOR_WHITE,
        Maha::COLOR_FAWN,
    ];

    /**
     * Deva of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva = Deva::DEVA_VARUNA;

    /**
     * Gender of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaGender = Manusha::GENDER_FEMALE;

    /**
     * Bhuta of the Graha.
     *
     * @var string
     */
    protected $grahaBhuta = Maha::BHUTA_JALA;

    /**
     * Varna of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 21.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaVarna = Manusha::VARNA_VAISHYA;

    /**
     * Guna of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 22.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 7.
     */
    protected $grahaGuna = Maha::GUNA_SATTVA;

    /**
     * Dhatu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
     */
    protected $grahaDhatu = array
    (
        Ayurveda::DHATU_RAKTA,
    );

    /**
     * Kala of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala = Kala::KALA_MUHURTA;

    /**
     * Rasa of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa = Ayurveda::RASA_LAVANA;

    /**
     * Ritu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 12.
     */
    protected $grahaRitu = Kala::RITU_VARSHA;

    /**
     * Graha basis.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis = Maha::BASIS_DHATU;

    /**
     * Graha exaltation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = [
        'rashi' => 2,
        'degree' => 3
    ];

    /**
     * Graha debilitation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [
        'rashi' => 8,
        'degree' => 3
    ];

    /**
     * Graha mooltrikon.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [
        'rashi' => 2,
        'start' => 3,
        'end' => 30
    ];

    /**
     * Own sign of the graha.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [
        [
            'rashi' => 4,
            'start' => 0,
            'end' => 30
        ]
    ];

    /**
     * Graha disha
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha = Maha::DISHA_VAYAVYA;

    /**
     * Graha drishti
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 26, Verse 2-5.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 13.
     */
    protected $grahaDrishti = [
        1 => 0,
        2 => 0,
        3 => 0.25,
        4 => 0.75,
        5 => 0.5,
        6 => 0,
        7 => 1,
        8 => 0.75,
        9 => 0.5,
        10 => 0.25,
        11 => 0,
        12 => 0,
    ];

    /**
     * Prakriti of graha
     *
     * @var array
     */
    protected $grahaPrakriti = array
    (
        Ayurveda::PRAKRITI_KAPHA,
        Ayurveda::PRAKRITI_VATA
    );
    protected $grahaAgeMaturity = 24;
    protected $grahaAgePeriod = array
    (
        'start' => 0,
        'end' => 4
    );
    protected $grahaLongitudeSpeedAvg = ['d' => 13, 'm' => 10, 's' => 35];

    /**
     * Set environment.
     *
     * @param \Jyotish\Base\Data $Data
     * @return \Jyotish\Graha\Object\Ch
     */
    public function setEnvironment(Data $Data)
    {
        parent::setEnvironment($Data);

        $this->setGrahaCharacter();

        return $this;
    }

    /**
     * Set graha character.
     *
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 11.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected function setGrahaCharacter()
    {
        $lonCh = $this->getEnvironment()['graha'][Graha::KEY_CH]['longitude'];
        $lonSy = $this->getEnvironment()['graha'][Graha::KEY_SY]['longitude'];

        if ($lonCh < $lonSy) $lonCh = $lonCh + 360;

        $tithiUnits = Math::partsToUnits(($lonCh - $lonSy), 12);

        if ($tithiUnits['units'] >= 8 && $tithiUnits['units'] < 23) {
            $this->grahaCharacter = Graha::CHARACTER_SHUBHA;
        } else {
            $this->grahaCharacter = Graha::CHARACTER_PAPA;
        }
    }
}
