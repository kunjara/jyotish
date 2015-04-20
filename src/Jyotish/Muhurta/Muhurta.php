<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Muhurta;

use Jyotish\Panchanga\Panchanga;
use Jyotish\Ganita\Time;

/**
 * Muhurta class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Muhurta {
    const PANCHAKA_MRITYU = 1;
    const PANCHAKA_AGNI   = 2;
    const PANCHAKA_RAJA   = 4;
    const PANCHAKA_CHORA  = 6;
    const PANCHAKA_ROGA   = 8;
    
    protected $panchangaObject = null;
    
    protected $dateTimeObject = null;
    
    protected $dateTimeObjectStart = null;
    
    protected $dateTimeObjectEnd = null;
    
    protected $timeStamps = array();

    /**
     * Constructor
     * 
     * @param \Jyotish\Panchanga\Panchanga $Panchanga
     */
    public function __construct(Panchanga $Panchanga)
    {
        $this->panchangaObject = $Panchanga;
        
        $this->ganitaData = $this->panchangaObject->getData();
        $dateTimeFormat = Time::FORMAT_DATA_DATE . ' ' . Time::FORMAT_DATA_TIME;
        $dateTimeString = $this->ganitaData['user']['date'] . ' ' . $this->ganitaData['user']['time'];
        
        $this->dateTimeObjectStart = Time::getDateTime($dateTimeFormat, $dateTimeString, $this->ganitaData['user']['timezone']);
        $this->dateTimeObjectEnd = clone($this->dateTimeObjectStart);
        $this->dateTimeObjectStart->modify('-1 day');
        
        $this->panchangaObject->setData([
            'date' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_DATE),
            'time' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_TIME),
        ]);
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
        if($period > 1)
            $this->dateTimeObjectEnd->modify('+' . $period . ' days');
        if(is_null($angas)) 
            $angas = Panchanga::$anga;
        
        foreach ($angas as $angaName){
            $this->calcPanchanga($angaName);
        }
        
        $this->sort();
        $this->clear();
        
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
        $angaData = $this->panchangaObject->$getAnga(true);
        $nextTime = $angaData['end'];
        
        if(!isset($this->dateTimeObject)){
            $this->dateTimeObject = clone($this->dateTimeObjectStart);
            $angaData['start'] = null;
        }else{
            $angaData['start'] = end($this->timeStamps)['end'];
        }
        
        $this->timeStamps[] = $angaData;
        
        $this->dateTimeObject->modify($nextTime)->modify('+ 4 minutes');
        
        if($nextTime < $this->dateTimeObjectEnd->format(Time::FORMAT_DATETIME)){
            $this->panchangaObject->setData([
                'date' => $this->dateTimeObject->format(Time::FORMAT_DATA_DATE),
                'time' => $this->dateTimeObject->format(Time::FORMAT_DATA_TIME),
            ]);
            
            $this->calcPanchanga($angaName);
        }
        
        $this->reset();
    }
    
    protected function sort()
    {
        usort($this->timeStamps, 
            function ($stamp1, $stamp2){
                if($stamp1['end'] == $stamp2['end']) {
                    return 0;
                }else{
                    return ($stamp1['end'] > $stamp2['end']) ? 1 : -1;
                }
            }
        );
    }
    
    protected function clear()
    {
        $dateTimeEnd = Time::getDateTime2($this->ganitaData['user']);
        
        foreach ($this->timeStamps as $key => $timeStamp){
            if(is_null($timeStamp['start']) or $timeStamp['end'] < $dateTimeEnd->format(Time::FORMAT_DATETIME)){
                unset($this->timeStamps[$key]);
            }
        }
    }

    protected function reset()
    {
        unset($this->dateTimeObject);
        
        $this->panchangaObject->setData([
            'date' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_DATE),
            'time' => $this->dateTimeObjectStart->format(Time::FORMAT_DATA_TIME),
        ]);
    }
}
