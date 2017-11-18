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
 * Gulika Kala class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 * @Contributed by Rahulyhg <therahulyhg@gmail.com>
 */
class GulikaKala
{
    use \Jyotish\Base\Traits\DataTrait;
    
    private $timeZone;
    private $dateTimeRising;
    private $dateTimeSetting;
    
    private $weekGulikaKala = [
        0 => 7,
        1 => 6,
        2 => 5,
        3 => 4,
        4 => 3,
        5 => 2,
        6 => 1,
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
     * Get Gulika kala.
     * 
     * @return array
     */
    public function getGulikaKala()
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
        
        $index = $this->weekGulikaKala[$week];
        return [
            'start' => $parts[$index]->format(Time::FORMAT_DATETIME),
            'end' => $parts[$index]->modify("{$durationPart} seconds")->format(Time::FORMAT_DATETIME),
        ];
    }
}
