<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Method;

use DateTime;
use DateInterval;
use DateTimeZone;
use Jyotish\Base\Data;
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
        Graha::KEY_MA => '4',
        Graha::KEY_BU => '2',
        Graha::KEY_GU => '5',
        Graha::KEY_SK => '3',
        Graha::KEY_SA => '6',
        Graha::KEY_RA => 'm',
    );

    protected $outputPlanets = array(
        'Sun'      => Graha::KEY_SY,
        'Moon'     => Graha::KEY_CH,
        'Mars'     => Graha::KEY_MA,
        'Mercury'  => Graha::KEY_BU,
        'Jupiter'  => Graha::KEY_GU,
        'Venus'    => Graha::KEY_SK,
        'Saturn'   => Graha::KEY_SA,
        'meanNode' => Graha::KEY_RA,
    );
    protected $outputHouses = array(
        'house1'   => 1,
        'house2'   => 2,
        'house3'   => 3,
        'house4'   => 4,
        'house5'   => 5,
        'house6'   => 6,
        'house7'   => 7,
        'house8'   => 8,
        'house9'   => 9,
        'house10'  => 10,
        'house11'  => 11,
        'house12'  => 12,
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
     * @param array $params Array of blocks (optional)
     * @param null|array $options Options to set (optional)
     * @return Swetest
     */
    public function calcParams(array $params = null, array $options = null)
    {
        $this->setOptions($options);

        $dateTimeObject = Time::createDateTimeUtc($this->data['user']);

        $dir     = ' -edir'.$this->swe['sweph'];
        $date    = ' -b'.$dateTimeObject->format(Time::FORMAT_DATA_DATE);
        $time    = ' -ut'.$dateTimeObject->format(Time::FORMAT_DATA_TIME);
        $sid     = ' -sid'.$this->inputAyanamsha[$this->options['ayanamsha']];
        
        $stringHouses = ' -house'.$this->data['user']['longitude'].','.$this->data['user']['latitude'].',a';
        $stringPlanets = implode('', $this->inputPlanets);
        
        if(is_null($params)){
            $planets = ' -p'.$stringPlanets;
            $houses  = $stringHouses;
        }else{
            $planets = ' -p';
            $houses = '';
            
            foreach($params as $block){
                switch ($block){
                    case Data::BLOCK_GRAHA:
                        $planets = ' -p'.$stringPlanets;
                        break;
                    case Data::BLOCK_BHAVA:
                        $houses = $stringHouses;
                        break;
                    default:
                        continue;
                }
            }
        }

        $string = 'swetest'.$dir.$date.$time.$planets.$houses.$sid.' -fPlbsad -g, -head';

        putenv("PATH={$this->swe['swetest']}");
        exec($string, $out);

        $dataParams = $this->formatParams($out, $params);

        $this->data = array_merge($this->data, $dataParams);
        
        return $this;
    }

    /**
     * Calculation of rising and setting time of planet.
     * 
     * @param string $graha
     * @param null|array $options Options to set (optional)
     * @return Swetest
     */
    public function calcRising($graha = Graha::KEY_SY, array $options = null)
    {
        $this->setOptions($options);

        $dateTimeObject = Time::createDateTimeUtc($this->data['user']);
        $dateTimeObject->sub(new DateInterval('P2D'));

        $dir    = ' -edir'.$this->swe['sweph'];
        $date   = ' -b'.$dateTimeObject->format(Time::FORMAT_DATA_DATE);
        $planet = ' -p'.$this->inputPlanets[$graha];
        $geopos	= ' -geopos'.$this->data['user']['longitude'].','.$this->data['user']['latitude'].',0';
        $rising = ' -'.$this->options['rising'];

        $string = 'swetest'.$dir.$date.$planet.$geopos.$rising.' -n5 -rise';

        putenv("PATH={$this->swe['swetest']}");
        exec($string, $out);

        $this->data['rising'] = $this->formatRising($out, $graha);
        
        return $this;
    }

    /**
     * Format params.
     * 
     * @param array $input Input data
     * @param array $params Array of blocks
     * @return array
     */
    private function formatParams($input, $params)
    {
        $dataParams = [];
        if(is_null($params) or (in_array(Data::BLOCK_GRAHA, $params) and in_array(Data::BLOCK_BHAVA, $params))){
            $count = 22;
        }elseif(in_array(Data::BLOCK_GRAHA, $params)){
            $count = 8;
        }elseif(in_array(Data::BLOCK_BHAVA, $params)){
            $count = 14;
        }

        foreach ($input as $k => $v) {
            // Break if swetest warning
            if($k == $count) break;

            $parametersString = str_replace(' ', '', $v);
            $parameters = explode(',', $parametersString);
            $bodyName   = $parameters[0];
            $units      = Math::partsToUnits($parameters[1]);

            if (array_key_exists($bodyName, $this->outputPlanets)) {
                $dataParams['graha'][$this->outputPlanets[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'latitude' => (float)$parameters[2],
                    'speed' => (float)$parameters[3],
                    'ascension' => (float)$parameters[4],
                    'declination' => (float)$parameters[5],
                    'rashi' => $units['units'],
                    'degree' => $units['parts'],
                );
            } elseif (array_key_exists($bodyName, $this->outputHouses)) {
                $dataParams['bhava'][$this->outputHouses[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'ascension' => (float)$parameters[2],
                    'declination' => (float)$parameters[3],
                    'rashi' => $units['units'],
                    'degree' => $units['parts'],
                );
            } elseif (array_key_exists($bodyName, $this->outputExtra)) {
                $dataParams['extra'][$this->outputExtra[$bodyName]] = array(
                    'longitude' => (float)$parameters[1],
                    'ascension' => (float)$parameters[2],
                    'declination' => (float)$parameters[3],
                    'rashi'     => $units['units'],
                    'degree'    => $units['parts'],
                );
            }
        }

        if(is_null($params) or in_array(Data::BLOCK_GRAHA, $params)){
            $longitudeKe = Math::oppositeValue($dataParams['graha'][Graha::KEY_RA]['longitude'], 360);
            $ascensionKe = Math::oppositeValue($dataParams['graha'][Graha::KEY_RA]['ascension'], 360);
            $units = Math::partsToUnits($longitudeKe);

            $dataParams['graha'][Graha::KEY_KE] = array(
                'longitude'   => $longitudeKe,
                'latitude'    => $dataParams['graha'][Graha::KEY_RA]['latitude'],
                'speed'       => $dataParams['graha'][Graha::KEY_RA]['speed'],
                'rashi'       => $units['units'],
                'degree'      => $units['parts'],
                'ascension'   => $ascensionKe,
                'declination' => $dataParams['graha'][Graha::KEY_RA]['declination']
            );
        }

        return $dataParams;
    }
    
    /**
     * Format rising.
     * 
     * @param array $input Input data
     * @param string $graha Graha key
     * @return array
     */
    private function formatRising($input, $graha)
    {
        $dataRising = [];
        for($i = 1; $i <= 4; $i++) {
            preg_match("#rise\s((.*\d+)\s+(\d{1,2}:.*))\sset\s((.*\d+)\s+(\d{1,2}:[\d\s\.:]+))#", $input[$i+1], $matches);

            $risingString  = str_replace(' ', '', $matches[2]).' '.str_replace(' ', '', $matches[3]);
            $settingString = str_replace(' ', '', $matches[5]).' '.str_replace(' ', '', $matches[6]);

            $risingObject = new DateTime($risingString, new DateTimeZone('UTC'));
            $risingObject->setTimezone(new DateTimeZone($this->data['user']['timezone']));
            $settingObject = new DateTime($settingString, new DateTimeZone('UTC'));
            $settingObject->setTimezone(new DateTimeZone($this->data['user']['timezone']));

            $rising = $risingObject->format(Time::FORMAT_DATETIME);
            $setting = $settingObject->format(Time::FORMAT_DATETIME);

            $dataRising[$graha][$i] = array(
                'rising'  => $rising,
                'setting' => $setting,
            );
        }
        $risingObject3 = new DateTime($dataRising[$graha][3]['rising']);
        if($this->data['user']['date'] == $risingObject3->format(Time::FORMAT_DATA_DATE)){
            array_shift($dataRising[$graha]);
        }else{
            array_pop($dataRising[$graha]);
        }

        $risings[$graha] = array_values($dataRising[$graha]);
        return $risings;
    }
}