<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use DateTime;
use DateInterval;
use Jyotish\Graha\Graha;
use Jyotish\Panchanga\AngaDefiner;
use Jyotish\Base\Utils;
use Jyotish\Ganita\Time;

/**
 * Dasha object class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractDasha {
    
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
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
    protected $dashaType;

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
    
    protected $AngaDefiner = null;
    
    protected $ganitaData = null;

    /**
     * Get start period.
     * 
     * @abstract
     * @return array
     */
    abstract public function getStartPeriod();
    
    /**
     * Constructor
     * 
     * @param null|array $options Options to set
     */
    public function __construct($options)
    {
        $this->setOptions($options);
    }

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
     * @param string $periodKey Key of period
     * @return array
     */
    public function getPeriods($periodKey = null)
    {
        $this->checkPanchanga();
        
        $timeZone = isset($this->ganitaData['timezone']) ? new DateTimeZone($this->ganitaData['timezone']) : null;
        $periodStart = $this->getStartPeriod();
        
        $this->dateTimeObjectNow = new DateTime('now', $timeZone);
        $this->dateTimeObject = Time::createDateTime($this->ganitaData['user']);

        $this->dateTimeObject->sub(new DateInterval('PT'.$periodStart['start'].'S'));
        $periodStartString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
        $this->dateTimeObject->add(new DateInterval('PT'.$periodStart['total'].'S'));
        $periodEndString = $this->dateTimeObject->format(Time::FORMAT_DATETIME);

        $periodData = array(
            'nesting'  => 0,
            'type'     => $this->dashaType,
            'key'      => '',
            'duration' => $periodStart['total'],
            'start'    => $periodStartString,
            'end'      => $periodEndString,
            'order'    => $this->getOrderGraha($periodStart['graha']),
        );

        $calcPeriods = $this->calcPeriods($periodData, $periodKey);
        unset($calcPeriods['order']);
        
        return $calcPeriods;
    }

    /**
     * Recursive calculation of periods.
     * 
     * @param array $periodData
     * @param string $periodKey
     * @return array
     */
    private function calcPeriods($periodData, $periodKey)
    {
        $i = 0;
        
        foreach($periodData['order'] as $graha => $info){
            $i++;

            $nesting = $periodData['nesting'] + 1;
            $periodData['periods'][$graha]['nesting'] = $nesting;
            $periodData['periods'][$graha]['type'] = constant('Jyotish\Dasha\Dasha::NESTING_'.$nesting);
            $periodData['periods'][$graha]['key'] = $periodData['key'].$graha;

            $duration = round($periodData['duration'] * $this->durationGraha[$graha] / $this->durationTotal);
            $periodData['periods'][$graha]['duration'] = (int)$duration;

            if($i == 1){
                $this->dateTimeObject = new DateTime($periodData['start']);
                $periodData['periods'][$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }else{
                $periodData['periods'][$graha]['start'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            }
            $dateTimeObjectStart = clone($this->dateTimeObject);

            //if($i == count($periodData['order'])){
            //	$periodData['periods'][$graha]['end'] = $periodData['end'];
            //}else{
                $this->dateTimeObject->add(new DateInterval('PT'.$duration.'S'));
                $periodData['periods'][$graha]['end'] = $this->dateTimeObject->format(Time::FORMAT_DATETIME);
            //}
            $dateTimeObjectEnd = clone($this->dateTimeObject);
            
            // Choose period with the specified key
            if($periodKey == 'now'){
                if(!($dateTimeObjectStart < $this->dateTimeObjectNow and $dateTimeObjectEnd > $this->dateTimeObjectNow)){
                    $subperiodKey = 'now';
                    continue;
                }
            }elseif(!is_null($periodKey)){
                $periodArray = str_split($periodKey, 2);
                $gr = array_shift($periodArray);
                if(!empty($gr) and !array_key_exists($gr, Graha::$graha)){
                    throw new \Jyotish\Dasha\Exception\RuntimeException(
                        "Period key '$gr' does not exist."
                    );
                }
                $subperiodKey = implode('', $periodArray);

                if($graha != $gr){
                    continue;
                }
            }

            // Define subperiods
            if($nesting < $this->options['nesting']){
                $periodData['periods'][$graha]['order'] = $this->getOrderGraha($graha);
                $periodData['periods'][$graha] = $this->calcPeriods($periodData['periods'][$graha], $subperiodKey);
                unset($periodData['periods'][$graha]['order']);
            } 
        }
        return $periodData;
    }
    
    /**
     * Set panchanga.
     * 
     * @param \Jyotish\Panchanga\AngaDefiner $AngaDefiner
     */
    public function setPanchanga(AngaDefiner $AngaDefiner)
    {
        $this->AngaDefiner = $AngaDefiner;
        $this->ganitaData = $this->AngaDefiner->getData();
    }
    
    /**
     * Set nesting of periods.
     * 
     * @param int $nesting
     * @throws \Jyotish\Dasha\Exception\InvalidArgumentException
     */
    public function setOptionNesting($nesting)
    {
        if(!is_numeric($nesting) || intval($nesting) > 6){
            throw new \Jyotish\Dasha\Exception\InvalidArgumentException(
                "Maximum nesting must be less than or equals 6."
            );
        }
        $this->options['nesting'] = $nesting;
    }

    /**
     * Check panchanga.
     * 
     * @throws \Jyotish\Dasha\Exception\UnderflowException
     */
    protected function checkPanchanga()
    {
        if(is_null($this->AngaDefiner)){
            throw new \Jyotish\Dasha\Exception\UnderflowException("Panchanga for dasha object must be setted.");
        }
    }
}