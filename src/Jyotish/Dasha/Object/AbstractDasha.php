<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use DateTime;
use DateInterval;
use Jyotish\Panchanga\Panchanga;
use Jyotish\Base\Utils;
use Jyotish\Ganita\Time;

/**
 * Dasha object class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractDasha {
    
    use \Jyotish\Base\Traits\GetTrait;
    
    /**
     * Options of dasha object.
     * 
     * @var array
     */
    protected $options = array(
        'nesting' => 3,
    );
    
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
    
    protected $panchangaObject = null;
    
    protected $ganitaData = null;

    /**
     * Get start period.
     * 
     * @abstract
     * @return array
     */
    abstract public function getStartPeriod();

    /**
     * Get the order of the grahas.
     * 
     * @param string $graha
     * @return array
     */
    public function getOrderGraha($graha)
    {
        $result = Utils::shiftArray($this->durationGraha, $graha);

        return $result;
    }

    /**
     * Get all periods and subperiods.
     * 
     * @return array
     */
    public function getPeriods()
    {
        $this->checkPanchanga();
        
        $this->dateTimeObject = Time::createDateTime($this->ganitaData['user']);
        $periodStart = $this->getStartPeriod();

        $this->dateTimeObject->sub(new DateInterval('PT'.$periodStart['start'].'S'));
        $periodStartString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
        $this->dateTimeObject->add(new DateInterval('PT'.$periodStart['total'].'S'));
        $periodEndString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);

        $periodData = array(
            'nesting'  => 0,
            'name'     => $this->dashaKey,
            'key'      => '',
            'duration' => $periodStart['total'],
            'start'    => $periodStartString,
            'end'      => $periodEndString,
            'order'    => $this->getOrderGraha($periodStart['graha']),
        );

        $calcPeriods = $this->calcPeriods($periodData);
        unset($calcPeriods['order']);
        
        return $calcPeriods;
    }

    /**
     * Recursive calculation of periods.
     * 
     * @param array $periodData
     * @return array
     */
    public function calcPeriods($periodData)
    {
        $i = 0;
        
        foreach($periodData['order'] as $graha => $info){
            $i++;

            $nesting = $periodData['nesting'] + 1;
            $periodData['periods'][$graha]['nesting'] = $nesting;
            $periodData['periods'][$graha]['name'] = constant('Jyotish\Dasha\Dasha::NESTING_'.$nesting);
            $periodData['periods'][$graha]['key'] = $graha;

            $duration = round($periodData['duration'] * $this->durationGraha[$graha] / $this->durationTotal);
            $periodData['periods'][$graha]['duration'] = (int)$duration;

            if($i == 1){
                $this->dateTimeObject = new DateTime($periodData['start']);
                $periodData['periods'][$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }else{
                $periodData['periods'][$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }

            //if($i == count($periodData['order'])){
            //	$periodData['periods'][$graha]['end'] = $periodData['end'];
            //}else{
                $this->dateTimeObject->add(new DateInterval('PT'.$duration.'S'));
                $periodData['periods'][$graha]['end'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            //}

            // Define subperiods
            if($nesting < $this->options['nesting']){
                $periodData['periods'][$graha]['order'] = $this->getOrderGraha($graha);
                $periodData['periods'][$graha] = $this->calcPeriods($periodData['periods'][$graha]);
            }
            unset($periodData['periods'][$graha]['order']);
        }
        return $periodData;
    }
    
    /**
     * Set panchanga.
     * 
     * @param \Jyotish\Panchanga\Panchanga $Panchanga
     */
    public function setPanchanga(Panchanga $Panchanga)
    {
        $this->panchangaObject = $Panchanga;
        $this->ganitaData = $this->panchangaObject->getData();
    }
    
    /**
     * Check panchanga.
     * 
     * @throws Exception\UnderflowException
     */
    protected function checkPanchanga()
    {
        if(is_null($this->panchangaObject))
            throw new \Jyotish\Dasha\Exception\UnderflowException("Panchanga for dasha object must be setted.");
    }
}
