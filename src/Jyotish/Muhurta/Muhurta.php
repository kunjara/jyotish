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
    /**
     * Constructor
     * 
     * @param \Jyotish\Panchanga\Panchanga $Panchanga
     */
    public function __construct(Panchanga $Panchanga)
    {
        $this->panchangaObject = $Panchanga;
    }
    
    /**
     * Get timestamps of muhurta.
     * 
     * @param int $period Period of time in days, which is calculated muhurta
     */
    public function getTimeStamps($period = 1)
    {
        $dateTimeObject = Time::getDateTimeUtc2($this->panchangaObject->getData()['user']);
        $dateTimeObject->modify('+' . $period . ' day');
        
        foreach (Panchanga::$anga as $angaName){
            $getAnga = 'get' . ucfirst($angaName);
            $timeStamps[] = $this->panchangaObject->$getAnga(true);
        }
        
        usort($timeStamps, 
            function ($stamp1, $stamp2){
                if($stamp1['end'] == $stamp2['end']) {
                    return 0;
                }else{
                    return ($stamp1['end'] > $stamp2['end']) ? 1 : -1;
                }
            }
        );
        
        return $timeStamps;
    }
}
