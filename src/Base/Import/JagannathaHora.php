<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Import;

use Jyotish\Base\Data;
use Jyotish\Ganita\Math;

/**
 * Class for importing the data from JH format to Jyotish array.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class JagannathaHora extends SourceBase
{
    use \Jyotish\Base\Traits\FileTrait;
    
    /**
     * Map of lines in JH files.
     * 
     * @var array
     */
    private $mapLines = [
        'Month',
        'Day',
        'Year',
        'Time',
        'Timezone',
        'Longitude',
        'Latitude',
        'Altitude',
    ];

    /**
     * @param string $filePath Path to file
     */
    public function __construct($filePath)
    {
        $this->fileOpen($filePath);
        $date = [];
        
        foreach ($this->getLines() as $num => $line) {
            $line = trim($line);
            switch ($num) {
                case 0: case 1:
                    $date[] = sprintf('%02d', $line);
                    break;
                case 2:
                    $date[] = sprintf('%04d', $line);
                    break;
                case 3:
                    $time = $line;
                    break;
                case 4:
                    $timezone = $line;
                    break;
                case 5:
                    $longitude = $line;
                    break;
                case 6:
                    $latitude = $line;
                    break;
                case 7:
                    $altitude = floatval($line);;
                    break;
                default:
                    break;
            }
        }
        
        $this->importData = [
            Data::BLOCK_USER => [
                'datetime' => $this->getDate($date) . ' ' . $this->getTime($time),
                'timezone' => $this->getTime($timezone, true),
                'longitude' => $this->getAngle($longitude, true),
                'latitude' => $this->getAngle($latitude),
                'altitude' => $altitude,
            ],
        ];
    }

    /**
     * Get converting date.
     * 
     * @param array $value
     * @return string
     */
    private function getDate(array $value)
    {
        $date = $value[2] . '-' . $value[0] . '-' . $value[1];
        
        return $date;
    }
    
    /**
     * Get converting time.
     * 
     * @param string $value
     * @param bool $isTimezone
     * @return string
     */
    private function getTime($value, $isTimezone = false)
    {
        $valueArray = $this->convertValue($value);
        
        $hours = abs($valueArray['d']);
        $hours = sprintf('%02d', $hours);
        $minutes = sprintf('%02d', $valueArray['m']);
        
        if ($isTimezone) {
            $sign = $valueArray['d'] < 0 ? '+' : ($valueArray['d'] > 0 ? '-' : '');
            $result = $sign . $hours . ':' . $minutes;
        } else {
            $seconds = sprintf('%02d', $valueArray['s']);
            $result = $hours . ':' . $minutes . ':' . $seconds;
        }
        
        return $result;
    }
    
    /**
     * Get converting value of angle.
     * 
     * @param string $value
     * @param bool $isLongitude
     * @return float
     */
    private function getAngle($value, $isLongitude = false)
    {
        $valueArray = $this->convertValue($value);
        
        $decimal = Math::dmsToDecimal($valueArray);
        
        if ($isLongitude) {
            $decimal *= -1;
        }
        
        return $decimal;
    }

    /**
     * Convert JH value to value array: [units, minutes, seconds].
     * 
     * @param string $value
     * @return array
     */
    private function convertValue($value)
    {
        $valueArray = explode('.', $value);
        
        $result = [];
        $result['d'] = (int)$valueArray[0];
        $result['m'] = (int)substr($valueArray[1], 0, 2);
        $result['s'] = 60 * (substr($valueArray[1], 2, 2) / 100);
        
        return $result;
    }
}
