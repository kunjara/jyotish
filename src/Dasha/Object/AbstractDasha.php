<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Dasha\Object;

use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;
use Jyotish\Ganita\Time;
use DateTime;
use DateInterval;

/**
 * Dasha object class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractDasha
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\GetTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Nesting of periods.
     * 
     * @var int
     */
    protected $optionNesting = 3;

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
    protected $durationGraha = [];

    /**
     * Nakshatra order.
     * 
     * @var array
     */
    protected $orderNakshatra = [];

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
     * @param null|array $options Options to set (optional)
     */
    public function __construct(array $options = null)
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
        $result = Math::shiftArray($this->durationGraha, $graha);

        return $result;
    }

    /**
     * Get all periods and subperiods.
     * 
     * @param null|string $periodKey Key of period (optional)
     * @return array
     */
    public function getPeriods($periodKey = null)
    {
        $this->checkData();
        
        $DateTime = $this->Data->getDateTime();
        $TimeZone = $DateTime->getTimezone();
        
        $this->temp['DateTimeNow'] = new DateTime('now', $TimeZone);
        $periodStart = $this->getStartPeriod();

        $DateTime->sub(new DateInterval('PT'.$periodStart['start'].'S'));
        $periodStartString = $DateTime->format(Time::FORMAT_DATETIME);
        $DateTime->add(new DateInterval('PT'.$periodStart['total'].'S'));
        $periodEndString = $DateTime->format(Time::FORMAT_DATETIME);

        $periodData = [
            'nesting'  => 0,
            'type'     => $this->dashaType,
            'key'      => '',
            'duration' => $periodStart['total'],
            'start'    => $periodStartString,
            'end'      => $periodEndString,
            'order'    => $this->getOrderGraha($periodStart['graha']),
        ];

        $subPeriods = $this->getSubPeriods($periodData, $periodKey);
        unset($subPeriods['order']);
        
        return $subPeriods;
    }
    
    /**
     * Set nesting of periods.
     * 
     * @param int $nesting
     * @return AbstractDasha
     * @throws \Jyotish\Dasha\Exception\InvalidArgumentException
     */
    public function setOptionNesting($nesting)
    {
        if (!is_numeric($nesting) || intval($nesting) > 6) {
            throw new \Jyotish\Dasha\Exception\InvalidArgumentException(
                "Maximum nesting must be less than or equals 6."
            );
        }
        $this->optionNesting = $nesting;
        
        return $this;
    }
    
    /**
     * Recursive calculation of periods.
     * 
     * @param array $periodData
     * @param string $periodKey
     * @return array
     */
    private function getSubPeriods($periodData, $periodKey)
    {
        $i = 0;
        foreach ($periodData['order'] as $graha => $info) {
            $i++;
            if ($i == 1) {
                $this->temp['DateTime'] = new DateTime($periodData['start']);
            }
            
            $nesting = $periodData['nesting'] + 1;
            $duration = round($periodData['duration'] * $this->durationGraha[$graha] / $this->durationTotal);
            
            $periodData['periods'][$graha]['nesting'] = $nesting;
            $periodData['periods'][$graha]['type'] = constant('Jyotish\Dasha\Dasha::NESTING_'.$nesting);
            $periodData['periods'][$graha]['key'] = $periodData['key'].$graha;
            $periodData['periods'][$graha]['duration'] = (int) $duration;
            $periodData['periods'][$graha]['start'] = $this->temp['DateTime']->format(Time::FORMAT_DATETIME);
            
            $DateTimeStart = clone($this->temp['DateTime']);
            $this->temp['DateTime']->add(new DateInterval('PT'.$duration.'S'));
            $periodData['periods'][$graha]['end'] = $this->temp['DateTime']->format(Time::FORMAT_DATETIME);
            $DateTimeEnd = clone($this->temp['DateTime']);
            
            // Choose period with the specified key
            if ($periodKey == 'now') {
                if (!($DateTimeStart < $this->temp['DateTimeNow'] && $DateTimeEnd > $this->temp['DateTimeNow'])) {
                    $subperiodKey = 'now';
                    continue;
                }
            } elseif (!is_null($periodKey)) {
                $periodArray = str_split($periodKey, 2);
                $gr = array_shift($periodArray);
                if (!empty($gr) && !array_key_exists($gr, Graha::$graha)) {
                    throw new \Jyotish\Dasha\Exception\RuntimeException(
                        "Period key '$gr' does not exist."
                    );
                }
                $subperiodKey = implode('', $periodArray);

                if ($graha != $gr) {
                    continue;
                }
            } else {
                $subperiodKey = null;
            }

            // Define subperiods
            if ($nesting < $this->optionNesting) {
                $periodData['periods'][$graha]['order'] = $this->getOrderGraha($graha);
                $periodData['periods'][$graha] = $this->getSubPeriods($periodData['periods'][$graha], $subperiodKey);
                unset($periodData['periods'][$graha]['order']);
            } 
        }
        return $periodData;
    }
    
    /**
     * Check data.
     * 
     * @param null|string $function Function name
     * @return void
     */
    private function checkData($function = null)
    {
        if (!isset($this->getData()['graha'])) {
            $this->Data->calcParams();
        }

        if (!isset($this->getData()['panchanga']['nakshatra'])) {
            $this->Data->calcPanchanga(['nakshatra'], true);
        }
    }
}