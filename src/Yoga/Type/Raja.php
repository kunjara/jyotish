<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Yoga;
use Jyotish\Graha\Graha;
use Jyotish\Bhava\Bhava;
use Jyotish\Base\Analysis;

/**
 * Raja yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Raja extends YogaBase
{
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_RAJA;
    
    /**
     * Combinations list.
     * 
     * @var array 
     */
    public static $yoga = [
        'Yogakaraka',
        'RulKnTrInterplay',
    ];
    
    /**
     * If one and the same graha gets the lordships of a Trikon, as well as a Kendra.
     * 
     * @return bool|string
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 34, Verse 13.
     */
    public function hasYogakaraka()
    {
        foreach (Graha::listGraha(Graha::LIST_SAPTA) as $key => $name) {
            $Graha = Graha::getInstance($key);
            $Graha->setEnvironment($this->Data);
            if ($Graha->isYogakaraka()) {
                return $key;
            }
        }
        return false;
    }
    
    /**
     * Lords of Kendras and Trikonas Related.
     * 
     * @return array
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 28.
     */
    public function hasRulKnTrInterplay()
    {
        $Analysis = new Analysis($this->Data);
        
        $bhavaKendra = Bhava::$bhavaKendra;
        array_shift($bhavaKendra);
        $kendraRulers = $Analysis->getBhavaRulers($bhavaKendra);
        $trikonaRulers = $Analysis->getBhavaRulers(Bhava::$bhavaTrikona);
        $dkaRulers = $Analysis->getBhavaRulers([9, 10]);
        
        $assingYoga = function($kendraRuler, $trikonaRuler, $interplay, $dkaPossible) {
            $yoga = [
                'kendraRuler' => $kendraRuler,
                'trikonaRuler' => $trikonaRuler,
                'interplay' => $interplay,
            ];
            if ($dkaPossible) {
                $yoga['name'] = 'dharmaKarmaAdhipati';
            }
            return $yoga;
        };
        
        $result = [];
        foreach ($kendraRulers as $kendraRuler) {
            foreach ($trikonaRulers as $trikonaRuler) {
                if ($trikonaRuler == $kendraRuler) {
                    continue;
                }
                
                if (empty(array_diff([$kendraRuler, $trikonaRuler], $dkaRulers))) {
                    $dkaPossible = true;
                } else {
                    $dkaPossible = false;
                }
                
                $KendraRuler = Graha::getInstance($kendraRuler);
                $KendraRuler->setEnvironment($this->Data);
                $TrikonaRuler = Graha::getInstance($trikonaRuler);
                $TrikonaRuler->setEnvironment($this->Data);
                
                // Parivarthana
                if ($this->hasParivarthana($kendraRuler, $trikonaRuler)) {
                    $result[] = $assingYoga($kendraRuler, $trikonaRuler, Yoga::INTERPLAY_PARIVARTHANA, $dkaPossible);
                }
                
                // Conjunct
                $kendraRulerIsConjuncted = $KendraRuler->isConjuncted();
                if (isset($kendraRulerIsConjuncted[$trikonaRuler])) {
                    $result[] = $assingYoga($kendraRuler, $trikonaRuler, Yoga::INTERPLAY_CONJUNCT, $dkaPossible);
                }
                
                // Aspect
                $kendraRulerIsAspected = $KendraRuler->isAspectedByGraha();
                $trikonaRulerIsAspected = $TrikonaRuler->isAspectedByGraha();
                if (
                    $kendraRulerIsAspected[$trikonaRuler] == 1 &&
                    $trikonaRulerIsAspected[$kendraRuler] == 1
                ) {
                    $result[] = $assingYoga($kendraRuler, $trikonaRuler, Yoga::INTERPLAY_ASPECT, $dkaPossible);
                }
            }
        }
        return $result;
    }
}
