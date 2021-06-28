<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Graha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Kala;
use Jyotish\Tattva\Maha;
use Jyotish\Base\Data;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;
use Jyotish\Tattva\Ayurveda;

/**
 * Class of graha Bu.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Bu extends GrahaBaseObject
{
    /**
     * Abbreviation of the graha
     *
     * @var string
     */
    protected $objectKey = 'Bu';

    /**
     * Unicode of the Graha.
     *
     * @var string
     */
    protected $grahaUnicode = '263F';

    /**
     * Amsha of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 2.
     */
    protected $grahaAmsha = Graha::AMSHA_JIVATMA;

    /**
     * Avatara of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 2, Verse 5-7.
     */
    protected $grahaAvatara = 'Budda';

    /**
     * Names of the graha.
     *
     * @var array
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 2.
     */
    protected $objectNames = [
        'Hemna',
        'Vit',
        'Gna',
        'Bodhana',
        'Induputra',
    ];

    /**
     * Devanagari title 'budha' in transliteration.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 10.
     * @see Jyotish\Alphabet\Devanagari
     */
    protected $grahaTranslit = ['ba','u','dha'];

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
        Maha::COLOR_GREEN,
        Maha::COLOR_SPRING_GREEN,
    ];

    /**
     * Deva of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 18.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDeva = Deva::DEVA_VISHNU_MAHA;

    /**
     * Gender of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 19.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaGender = Manusha::GENDER_NEUTER;

    /**
     * Bhuta of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 20.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 6.
     */
    protected $grahaBhuta = Maha::BHUTA_PRITVI;

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
    protected $grahaGuna = Maha::GUNA_RAJA;

    /**
     * Dhatu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 31.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 11.
     */
    protected $grahaDhatu = array
    (
        Ayurveda::DHATU_RASA,
    );

    /**
     * Kala of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 33.
     */
    protected $grahaKala = Kala::KALA_RITU;

    /**
     * Rasa of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 34.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 14.
     */
    protected $grahaRasa = Ayurveda::RASA_MISHRA;

    /**
     * Ritu of the Graha.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 45-46.
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 12.
     */
    protected $grahaRitu = Kala::RITU_SHARAD;

    /**
     * Graha basis.
     *
     * @var string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 47.
     */
    protected $grahaBasis = Maha::BASIS_JIVA;

    /**
     * Graha exaltation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaUcha = [
        'rashi' => 6,
        'degree' => 15
    ];

    /**
     * Graha debilitation.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 49-50.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 13.
     */
    protected $grahaNeecha = [
        'rashi' => 12,
        'degree' => 15
    ];

    /**
     * Graha mooltrikon.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     * @see Varahamihira. Brihat Jataka. Chapter 1, Verse 14.
     */
    protected $grahaMool = [
        'rashi' => 6,
        'start' => 15,
        'end' => 20
    ];

    /**
     * Own sign of the graha.
     *
     * @var array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 3, Verse 51-54.
     */
    protected $grahaSwa = [
        'positive' => [
            'rashi' => 3,
            'start' => 0,
            'end' => 30
        ],
        'negative' => [
            'rashi' => 6,
            'start' => 20,
            'end' => 30
        ]
    ];

    /**
     * Graha disha
     *
     * @var string
     * @see Varahamihira. Brihat Jataka. Chapter 2, Verse 5.
     */
    protected $grahaDisha = Maha::DISHA_UTTARA;

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
        Ayurveda::PRAKRITI_PITTA,
        Ayurveda::PRAKRITI_VATA
    );
    protected $grahaAgeMaturity = 32;
    protected $grahaAgePeriod = array
    (
        'start' => 5,
        'end' => 14
    );
    protected $grahaLongitudeSpeedAvg = ['d' => 4, 'm' => 5, 's' => 32.4];

    /**
     * Set environment.
     *
     * @param \Jyotish\Base\Data $Data
     * @return \Jyotish\Graha\Object\Bu
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
        $this->grahaCharacter = $this->getConjunctCharacter();
    }
}
