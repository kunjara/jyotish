<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */
namespace Jyotish\Muhurta;
use Jyotish\Graha\Graha;
use Jyotish\Ganita\Time;
use DateTimeImmutable;
use DateInterval;
use DatePeriod;
/**
 * Yamaghanta Kala class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 * @Contributed by Rahulyhg <therahulyhg@gmail.com>
 */
class YamaghantaKala
{
    use \Jyotish\Base\Traits\DataTrait;
    
    private $timeZone;
    private $dateTimeRising;
    private $dateTimeSetting;
    
    private $weekYamaghantaKala = [
        0 => 5,
        1 => 4,
        2 => 3,
        3 => 2,
        4 => 1,
        5 => 7,
        6 => 6,
    ];
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setDataInstance($Data);
        
        if (!isset($this->getData()['rising'])) {
            $this->getDataInstance()->calcRising();
        }
        
        $this->timeZone = $this->getDataInstance()->getDateTime()->getTimezone();
        $this->dateTimeRising = new DateTimeImmutable(
            $this->getData()['rising'][Graha::KEY_SY][1]['rising'], 
            $this->timeZone
        );
        $this->dateTimeSetting = new DateTimeImmutable(
            $this->getData()['rising'][Graha::KEY_SY][1]['setting'], 
            $this->timeZone
        );
    }
    
    /**
     * Get Yamaghanta kala.
     * 
     * @return array
     */
    public function getYamaghantaKala()
    {
        $timeRisingU = $this->dateTimeRising->format('U');
        $timeSettingU = $this->dateTimeSetting->format('U');
        $durationDay = $timeSettingU - $timeRisingU;
        $durationPart = round($durationDay / 8);
        
        $dateTime = $this->getDataInstance()->getDateTime();
        $week = $dateTime->format('w');
        
        $interval = new DateInterval("PT{$durationPart}S");
        $period = new DatePeriod( $this->dateTimeRising, $interval, $this->dateTimeSetting );
        
        $parts = [];
        $i = 1;
        foreach ($period as $part) {
            $parts[$i] = $part;
            $i++;
        }
        
        $index = $this->weekYamaghantaKala[$week];
        return [
            'start' => $parts[$index]->format(Time::FORMAT_DATETIME),
            'end' => $parts[$index]->modify("{$durationPart} seconds")->format(Time::FORMAT_DATETIME),
        ];
    }
}
