<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use Jyotish\Dasha\Dasha;
use DateInterval;
use Jyotish\Base\Utils;
use Jyotish\Ganita\Time;

/**
 * Dasha object class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractDasha {
    /**
     * Dasha key
     * 
     * @var string
     */
    protected $dashaKey;

    /**
     * Duration of dasha.
     * 
     * @var int
     */
    protected $durationTotal = null;

    /**
     * Duration of dasha by subperiods.
     * 
     * @var array
     */
    protected $durationGraha = array();

    /**
     * Nakshatra order.
     * 
     * @var array
     */
    protected $orderNakshatra = array();

    /**
     * Get start period.
     * 
     * @abstract
     * @param array $nakshatra
     * @return array
     */
    abstract public function getStartPeriod(array $nakshatra);

    /**
     * Get the order of the grahas.
     * 
     * @abstract
     * @param string $graha
     * @param int $nesting
     * @return array
     */
    abstract public function getOrderGraha($graha, $nesting = null);

    /**
     * Get all periods and subperiods.
     * 
     * @param \Jyotish\Panchanga\Panchanga $Panchanga
     * @param int $nestingMax
     * @return array
     */
    public function getDashaPeriods(\Jyotish\Panchanga\Panchanga $Panchanga, $nestingMax = 3)
    {
        if(!is_numeric($nestingMax) || intval($nestingMax) > Dasha::NESTING_MAX){
            throw new Exception\InvalidArgumentException(
                "Maximum nesting must be less than or equals 6."
            );
        }

        if($this->dashaKey == Dasha::NAME_ASHTOTTARI)
            $withAbhijit = true;
        else
            $withAbhijit = false;

        $userData       = $Panchanga->getData()['user'];
        $dateTimeString = $userData['date'] . ' ' . $userData['time'];
        $dateTimeFormat = Time::FORMAT_DATA_DATE . ' ' . Time::FORMAT_DATA_TIME;
        $this->dateTimeObject = Time::getDateTimeUtc($dateTimeFormat, $dateTimeString, $userData['timezone']);

        $nakshatra  = $Panchanga->getNakshatra(true, $withAbhijit);
        $periodData = $this->getStartPeriod($nakshatra);

        $this->dateTimeObject->sub(new DateInterval('PT'.$periodData['start'].'S'));
        $periodStartString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
        $this->dateTimeObject->add(new DateInterval('PT'.$periodData['total'].'S'));
        $periodEndString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);

        $periodOrder = Utils::shiftArray($this->durationGraha(), $periodData['graha']);

        $periodTotal = array(
            'nesting'  => 0,
            'name'     => $this->dashaKey,
            'duration' => $periodData['total'],
            'start'    => $periodStartString,
            'end'      => $periodEndString,
            'order'    => $periodOrder,
        );

        $periodsCalc	= $this->calcDashaPeriods($periodTotal, $nestingMax);
        
        return $periodsCalc;
    }

    /**
     * Recursive calculation of periods.
     * 
     * @param array $periodData
     * @param int $nestingMax
     * @return array
     */
    private function calcDashaPeriods($periodData, $nestingMax = 3)
    {
        $i = 0;
        foreach($periodData['order'] as $graha => $info){
            $i++;

            $nesting = $periodData['nesting'] + 1;
            $periodData[$graha]['nesting'] = $nesting;
            $periodData[$graha]['name'] = constant('Jyotish\Dasha\Dasha::NESTING_'.$nesting);

            $durationGraha = $this->durationGraha();
            $duration = round($periodData['duration'] * $durationGraha[$graha] / $this->durationTotal());
            $periodData[$graha]['duration'] = (int)$duration;

            if($i == 1){
                $this->dateTimeObject = Time::getDateTimeUtc(Time::FORMAT_DATETIME, $periodData['start']);
                $periodData[$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }else{
                $periodData[$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }

            //if($i == count($periodData['order'])){
            //	$periodData[$graha]['end'] = $periodData['end'];
            //}else{
                $this->dateTimeObject->add(new DateInterval('PT'.$duration.'S'));
                $periodData[$graha]['end'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            //}

            // Define subperiods
            if($nesting < $nestingMax){
                $periodData[$graha]['order'] = $this->getOrderGraha($graha, $nesting);
                $periodData[$graha]	= $this->calcDashaPeriods($periodData[$graha]);
            }else{
                $periodData[$graha]['order'] = null;
            }
        }	
        return $periodData;
    }

    public function durationTotal()
    {
        return $this->durationTotal;
    }

    public function durationGraha()
    {
        return $this->durationGraha;
    }

    public function orderNakshatra()
    {
        return $this->orderNakshatra;
    }
}
