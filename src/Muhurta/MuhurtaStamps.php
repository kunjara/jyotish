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
 * Class for determining muhurta stamps.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class MuhurtaStamps
{
    use \Jyotish\Base\Traits\OptionTrait;
    
    const PANCHAKA_MRITYU = 1;
    const PANCHAKA_AGNI   = 2;
    const PANCHAKA_RAJA   = 4;
    const PANCHAKA_CHORA  = 6;
    const PANCHAKA_ROGA   = 8;
    
    /**
     * Duration of the calculated period in days.
     *
     * @var int
     */
    protected $optionDuration = 1;
    
    /**
     * Instance of AngaDefiner.
     * 
     * @var Jyotish\Panchanga\AngaDefiner;
     */
    protected $AngaDefiner = null;
    
    protected $userData = null;

    protected $dateTimeObject = null;
    
    protected $dateTimeObjectStart = null;
    
    protected $dateTimeObjectEnd = null;
    
    protected $muhurtaStamps = [];

    /**
     * Constructor
     * 
     * @param \Jyotish\Panchanga\AngaDefiner $AngaDefiner
     */
    public function __construct(AngaDefiner $AngaDefiner)
    {
        $this->AngaDefiner = $AngaDefiner;
        $this->userData = $this->AngaDefiner->getData()['user'];
        
        $this->dateTimeObjectStart = Time::createDateTime($this->userData);
        $this->dateTimeObjectEnd = clone($this->dateTimeObjectStart);
        $this->dateTimeObjectStart->modify('-28 hours');
        
        $this->AngaDefiner->setDateTime($this->dateTimeObjectStart);
    }
    
    /**
     * Get timestamps of muhurta.
     * 
     * @return array
     */
    public function getMuhurtaStamps()
    {
        $this->purifyMuhurtaStamps();
        $this->sortMuhurtaStamps();
        
        return $this->muhurtaStamps;
    }
    
    /**
     * Calculate timestamps of panchanga.
     * 
     * @param null|array $angas Components of Panchanga
     * @return void
     */
    public function calcPanchanga(array $angas = null)
    {
        if (is_null($angas)) {
            $angas = Panchanga::$anga;
        }
        
        foreach ($angas as $angaName) {
            $this->calcAnga($angaName);
        }
    }
    
    /**
     * Recursively calculate the timestamps of anga.
     * 
     * @param string $angaName
     * @return void
     */
    protected function calcAnga($angaName)
    {
        $getAnga = 'get' . ucfirst($angaName);
        $angaData = $this->AngaDefiner->$getAnga(true);
        $angaData['stamp'] = $angaData['anga'];
        unset($angaData['left'], $angaData['anga']);

        if (!isset($this->dateTimeObject)) {
            $this->dateTimeObject = clone($this->dateTimeObjectStart);
        } 
        
        if (!isset($angaData['start'])) {
            $angaData['start'] = null;
        }
        
        if ($angaName != Panchanga::ANGA_VARA) {
            $angaData['start'] = end($this->muhurtaStamps)['end'];
            $this->dateTimeObject
                ->modify($angaData['end'])
                ->modify('+ 8 minutes'); // Eliminate the error of end calculation
        } else {
            $this->dateTimeObject
                ->modify('+ 24 hours');
        }

        $this->muhurtaStamps[] = $this->unifyPart($angaData);

        if ($this->dateTimeObject < $this->dateTimeObjectEnd) {
            $this->AngaDefiner->setDateTime($this->dateTimeObject);
            $this->calcAnga($angaName);
        }

        $this->resetDateTime();
    }
    
    /**
     * Set duration for calculation.
     * 
     * @param int $duration
     * @return Jyotish\Muhurta\Muhurta
     * @throws \OutOfRangeException
     */
    public function setOptionDuration($duration)
    {
        if (!is_numeric($duration) || intval($duration) <= 0) {
            throw new \OutOfRangeException(
                'Duration should be greater than 0.'
            );
        }
        $this->optionDuration = intval($duration);
        if ($this->optionDuration > 1) {
            $this->dateTimeObjectEnd->modify('+' . $this->optionDuration - 1 . ' days');
        }
        return $this;
    }

    /**
     * Purify muhurta stamps.
     * 
     * @return void
     */
    protected function purifyMuhurtaStamps()
    {
        $dateTimeEnd = Time::createDateTime($this->userData);
        
        foreach ($this->muhurtaStamps as $key => $timeStamp) {
            if (is_null($timeStamp['start']) || $timeStamp['end'] < $dateTimeEnd->format(Time::FORMAT_DATETIME)) {
                unset($this->muhurtaStamps[$key]);
            }
        }
    }

    /**
     * Sort muhurta stamps.
     * 
     * @return void
     */
    protected function sortMuhurtaStamps()
    {
        usort($this->muhurtaStamps, 
            function ($stamp1, $stamp2) {
                if ($stamp1['start'] == $stamp2['start']) {
                    return 0;
                } else {
                    return ($stamp1['start'] > $stamp2['start']) ? 1 : -1;
                }
            }
        );
    }

    protected function resetDateTime()
    {
        unset($this->dateTimeObject);
        $this->AngaDefiner->setDateTime($this->dateTimeObjectStart);
    }
    
    protected function unifyPart($part)
    {
        $basicKeys = ['stamp', 'start', 'end'];
        $partUnified = [];
        
        foreach ($basicKeys as $key) {
            if (array_key_exists($key, $part)) {
                $partUnified[$key] = $part[$key];
                unset($part[$key]);
            }
        }
        $partUnified['details'] = $part;
        
        return $partUnified;
    }
}
