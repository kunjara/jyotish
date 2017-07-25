<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Time;
use DateTimeImmutable;

/**
 * Muhurta class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Muhurta
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * Abhijit muhurta
     */
    const NAME_ABHIJIT = 'abhijit';
    /**
     * Brahma muhurta
     */
    const NAME_BRAHMA = 'brahma';
    
    public static $muhurta = [
        self::NAME_ABHIJIT,
        self::NAME_BRAHMA,
    ];
    
    private $timeZone;
    private $dateTimeRising;
    private $dateTimeSetting;

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
     * Get Abhijit muhurta.
     * 
     * @return array
     */
    public function getMuhurtaAbhijit()
    {
        $timeRisingU = $this->dateTimeRising->format('U');
        $timeSettingU = $this->dateTimeSetting->format('U');
        $half = round(($timeSettingU - $timeRisingU) / 2);
        
        $StartMuhurta = $this->dateTimeRising->modify("+{$half} seconds")->modify('-24 minutes');
        $EndMuhurta = $StartMuhurta->modify('+48 minutes');
        
        return [
            'start' => $StartMuhurta->format(Time::FORMAT_DATETIME),
            'end' => $EndMuhurta->format(Time::FORMAT_DATETIME),
        ];
    }
}
