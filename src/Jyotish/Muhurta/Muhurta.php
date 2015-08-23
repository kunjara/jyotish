<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta;

use Jyotish\Panchanga\Panchanga;
use Jyotish\Panchanga\AngaDefiner;
use Jyotish\Ganita\Time;

/**
 * Muhurta class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Muhurta
{
    const PANCHAKA_MRITYU = 1;
    const PANCHAKA_AGNI   = 2;
    const PANCHAKA_RAJA   = 4;
    const PANCHAKA_CHORA  = 6;
    const PANCHAKA_ROGA   = 8;
    
    protected $AngaDefiner = null;
    
    protected $ganitaData = null;

    protected $dateTimeObject = null;
    
    protected $dateTimeObjectStart = null;
    
    protected $dateTimeObjectEnd = null;
    
    protected $timeStamps = array();

    /**
     * Constructor
     * 
     * @param \Jyotish\Panchanga\AngaDefiner $AngaDefiner
     */
    public function __construct(AngaDefiner $AngaDefiner)
    {
        $this->AngaDefiner = $AngaDefiner;
        $this->ganitaData = $this->AngaDefiner->getData();
    }
    
    /**
     * Get timestamps of muhurta.
     * 
     * @param int $period Period of time in days, which is calculated muhurta
     * @param null|array $angas Components of Panchanga
     * @return array
     */
    public function getTimeStamps($period = 1, array $angas = null)
    {
        $this->init($period);
        
        if (is_null($angas)) {
            $angas = Panchanga::$anga;
        }
        
        foreach ($angas as $angaName) {
            $this->calcPanchanga($angaName);
        }
        
        $this->clear();
        $this->sort();
        
        return $this->timeStamps;
    }
    
    /**
     * Calculate timestamps of panchanga.
     * 
     * @param string $angaName
     * @return void
     */
    protected function calcPanchanga($angaName)
    {
        $getAnga = 'get' . ucfirst($angaName);
        $angaData = $this->AngaDefiner->$getAnga(true);
        $nextTime = $angaData['end'];
        
        if (!isset($this->dateTimeObject)) {
            $this->dateTimeObject = clone($this->dateTimeObjectStart);
            $angaData['start'] = null;
        } else {
            if ($angaName != Panchanga::ANGA_VARA) {
                $angaData['start'] = end($this->timeStamps)['end'];
            }
        }
        
        $this->timeStamps[] = $angaData;
        
        // Eliminate the error of end calculation
        $this->dateTimeObject->modify($nextTime)->modify('+ 8 minutes');
        
        if ($nextTime < $this->dateTimeObjectEnd->format(Time::FORMAT_DATETIME)) {
            $this->AngaDefiner->setData([
                'date' => $this->dateTimeObject->format(Time::FORMAT_DATA_DATE),
                'time' => $this->dateTimeObject->format(Time::FORMAT_DATA_TIME),
            ], $angaName);
            
            $this->calcPanchanga($angaName);
        }
        
        $this->reset();
    }
    
    protected function init($period)
    {
        $this->dateTimeObjectStart = Time::createDateTime($this->ganitaData['user']);
        $this->dateTimeObjectEnd = clone($this->dateTimeObjectStart);
        $this->dateTimeObjectStart->modify('-28 hours');
        
        $this->AngaDefiner->setData([
            'date' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_DATE),
            'time' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_TIME),
        ]);
        
        if ($period > 1) 
            $this->dateTimeObjectEnd->modify('+' . $period - 1 . ' days');
    }

    protected function clear()
    {
        $dateTimeEnd = Time::createDateTime($this->ganitaData['user']);
        
        foreach ($this->timeStamps as $key => $timeStamp) {
            if (is_null($timeStamp['start']) or $timeStamp['end'] < $dateTimeEnd->format(Time::FORMAT_DATETIME)) {
                unset($this->timeStamps[$key]);
            }
        }
    }

    protected function sort()
    {
        usort($this->timeStamps, 
            function ($stamp1, $stamp2) {
                if ($stamp1['start'] == $stamp2['start']) {
                    return 0;
                } else {
                    return ($stamp1['start'] > $stamp2['start']) ? 1 : -1;
                }
            }
        );
    }

    protected function reset()
    {
        unset($this->dateTimeObject);
        
        $this->AngaDefiner->setData([
            'date' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_DATE),
            'time' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_TIME),
        ]);
    }
}
