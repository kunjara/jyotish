<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use DateTime;
use DateInterval;
use DateTimeZone;
use Jyotish\Graha\Graha;
use Jyotish\Graha\Lagna;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Ayanamsha;

/**
 * Class for calculate the positions of the planets using the application swetest.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Swetest extends AbstractGanita{

    protected $swe = array(
        'swetest'   => null,
        'sweph'     => null,
    );

    protected $inputAyanamsha = array(
        Ayanamsha::AYANAMSHA_FAGAN => '0',
        Ayanamsha::AYANAMSHA_LAHIRI => '1',
        Ayanamsha::AYANAMSHA_DELUCE => '2',
        Ayanamsha::AYANAMSHA_RAMAN => '3',
        Ayanamsha::AYANAMSHA_USHASHASHI => '4',
        Ayanamsha::AYANAMSHA_KRISHNAMURTI => '5',
        Ayanamsha::AYANAMSHA_DJWHALKHUL => '6',
        Ayanamsha::AYANAMSHA_YUKTESHWAR => '7',
        Ayanamsha::AYANAMSHA_JNBHASIN => '8',
        Ayanamsha::AYANAMSHA_SASSANIAN => '16',
    );

    protected $inputPlanets = array(
        Graha::KEY_SY => '0',
        Graha::KEY_CH => '1',
        Graha::KEY_BU => '2',
        Graha::KEY_SK => '3',
        Graha::KEY_MA => '4',
        Graha::KEY_GU => '5',
        Graha::KEY_SA => '6',
        Graha::KEY_RA => 'm',
    );

    protected $outputPlanets = array(
        'Sun'       => Graha::KEY_SY,
        'Moon'      => Graha::KEY_CH,
        'Mercury'   => Graha::KEY_BU,
        'Venus'     => Graha::KEY_SK,
        'Mars'      => Graha::KEY_MA,
        'Jupiter'   => Graha::KEY_GU,
        'Saturn'    => Graha::KEY_SA,
        'meanNode'  => Graha::KEY_RA,
    );
    protected $outputHouses = array(
        'house1'    => 1,
        'house2'    => 2,
        'house3'    => 3,
        'house4'    => 4,
        'house5'    => 5,
        'house6'    => 6,
        'house7'    => 7,
        'house8'    => 8,
        'house9'    => 9,
        'house10'   => 10,
        'house11'   => 11,
        'house12'   => 12,
    );
    protected $outputExtra = array(
        'Ascendant' => Lagna::KEY_LG,
        'MC'        => Lagna::KEY_MLG,
        //'ARMC'      => 'ARMC',
        //'Vertex'    => 'Vertex',
    );

    public function __construct($swe)
    {
        if (empty($swe['swetest'])) {
            throw new Exception\InvalidArgumentException("Swe key 'swetest' is required and must be path to swetest app.");
        }

        if (!file_exists($swe['swetest'])) {
            throw new Exception\InvalidArgumentException("In the directory '{$swe['swetest']}' there is no swetest file.");
        }

        $this->swe['swetest'] = $swe['swetest'];

        if (empty($swe['sweph'])) {
            $this->swe['sweph'] = $swe['swetest'];
        } else {
            $this->swe['sweph'] = $swe['sweph'];
        }
    }

    /**
     * Calculation of coordinates and other parameters of planets and houses.
     * 
     * @param null|array $options Options to set (optional)
     * @return array
     */
    public function calcParams(array $options = null)
    {
        $this->setOptions($options);

        $dateTimeObject = Time::createDateTimeUtc($this->data['user']);

        $dir    = $this->swe['sweph'];
        $date   = $dateTimeObject->format(Time::FORMAT_DATA_DATE);
        $time   = $dateTimeObject->format(Time::FORMAT_DATA_TIME);
        $house  = $this->data['user']['longitude'].','.$this->data['user']['latitude'].',a';
        $sid    = $this->inputAyanamsha[$this->options['ayanamsha']];

        $string =
                'swetest'.
                ' -edir'.$dir.
                ' -b'.$date.
                ' -ut'.$time.
                ' -p0123456m'.
                ' -house'.$house.
                ' -sid'.$sid.
                ' -fPlbsad'.
                ' -g,'.
                ' -head';

        putenv("PATH={$this->swe['swetest']}");
        exec($string, $out);

        $dataParams = $this->formatParams($out);

        $this->data = array_merge($this->data, $dataParams);
    }

    /**
     * Calculation of rising and setting time of planet.
     * 
     * @param string $graha
     * @param null|array $options Options to set (optional)
     * @return array
     */
    public function calcRising($graha = Graha::KEY_SY, array $options = null)
    {
        $this->setOptions($options);

        $dateTimeObject = new DateTime($this->data['user']['date']);
        $dateTimeObject->sub(new DateInterval('P2D'));

        $dir    = $this->swe['sweph'];
        $date   = $dateTimeObject->format(Time::FORMAT_DATA_DATE);
        $planet = $this->inputPlanets[$graha];
        $geopos	= $this->data['user']['longitude'].','.$this->data['user']['latitude'].',0';
        $rising = $this->options['rising'];

        $string =
                'swetest'.
                ' -edir'.$dir.
                ' -n5'.
                ' -b'.$date.
                ' -p'.$planet.
                ' -geopos'.$geopos.
                ' -'.$rising.
                ' -rise';

        putenv("PATH={$this->swe['swetest']}");
        exec($string, $out);

        for($i = 1; $i <= 4; $i++) {
            preg_match("#rise\s((.*\d+)\s+(\d{1,2}:.*))\sset\s((.*\d+)\s+(\d{1,2}:[\d\s\.:]+))#", $out[$i+1], $matches);

            $risingString  = str_replace(' ', '', $matches[2]).' '.str_replace(' ', '', $matches[3]);
            $settingString = str_replace(' ', '', $matches[5]).' '.str_replace(' ', '', $matches[6]);

            $risingObject = new DateTime($risingString, new DateTimeZone('UTC'));
            $risingObject->setTimezone(new DateTimeZone($this->data['user']['timezone']));
            $settingObject = new DateTime($settingString, new DateTimeZone('UTC'));
            $settingObject->setTimezone(new DateTimeZone($this->data['user']['timezone']));

            $dateRising = $risingObject->format(Time::FORMAT_DATETIME);
            $dateSetting = $settingObject->format(Time::FORMAT_DATETIME);

            $dataRisings[$graha][$i] = array(
                'rising'  => $dateRising,
                'setting' => $dateSetting,
            );
        }

        $this->data['rising'] = $dataRisings;
    }

    private function formatParams($input)
    {
        $bodyParameters = array();

        foreach ($input as $k => $v) {
            // Break if swetest warning
            if($k == 22) break;

            $parametersString = str_replace(' ', '', $v);
            $parameters = explode(',', $parametersString);
            $bodyName   = $parameters[0];
            $units      = Math::partsToUnits($parameters[1]);

            if (array_key_exists($bodyName, $this->outputPlanets)) {
                $bodyParameters['graha'][$this->outputPlanets[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'latitude' => (float)$parameters[2],
                    'speed' => (float)$parameters[3],
                    'ascension' => (float)$parameters[4],
                    'declination' => (float)$parameters[5],
                    'rashi' => $units['units'],
                    'degree' => $units['parts'],
                );
            } elseif (array_key_exists($bodyName, $this->outputHouses)) {
                $bodyParameters['bhava'][$this->outputHouses[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'ascension' => (float)$parameters[2],
                    'declination' => (float)$parameters[3],
                    'rashi' => $units['units'],
                    'degree' => $units['parts'],
                );
            } else {
                $bodyParameters['extra'][$this->outputExtra[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'ascension' => (float)$parameters[2],
                    'declination' => (float)$parameters[3],
                    'rashi'     => $units['units'],
                    'degree'    => $units['parts'],
                );
            }
        }

        $longitudeKe = Math::oppositeValue($bodyParameters['graha'][Graha::KEY_RA]['longitude'], 360);
        $ascensionKe = Math::oppositeValue($bodyParameters['graha'][Graha::KEY_RA]['ascension'], 360);
        $units = Math::partsToUnits($longitudeKe);

        $bodyParameters['graha'][Graha::KEY_KE] = array(
            'longitude'   => $longitudeKe,
            'latitude'    => $bodyParameters['graha'][Graha::KEY_RA]['latitude'],
            'speed'       => $bodyParameters['graha'][Graha::KEY_RA]['speed'],
            'rashi'       => $units['units'],
            'degree'      => $units['parts'],
            'ascension'   => $ascensionKe,
            'declination' => $bodyParameters['graha'][Graha::KEY_RA]['declination']
        );

        asort($bodyParameters['graha']);
        reset($bodyParameters['graha']);

        return $bodyParameters;
    }
}