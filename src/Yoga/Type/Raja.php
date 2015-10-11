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
     * Generate list of Raja yogas.
     * 
     * @return \Iterator
     * @see Maharishi Parashara. Brihat Parashara Hora Shastra. Chapter 41, Verse 28.
     */
    public function generateYoga()
    {
        $Analysis = new Analysis($this->Data);
        
        $bhavaKendra = Bhava::$bhavaKendra;
        array_shift($bhavaKendra);
        $kendraRulers = $Analysis->getBhavaRulers($bhavaKendra);
        $trikonaRulers = $Analysis->getBhavaRulers(Bhava::$bhavaTrikona);
        
        foreach ($kendraRulers as $kendraRuler) {
            foreach ($trikonaRulers as $trikonaRuler) {
                $KendraRuler = Graha::getInstance($kendraRuler);
                $KendraRuler->setEnvironment($this->Data);
                $TrikonaRuler = Graha::getInstance($trikonaRuler);
                $TrikonaRuler->setEnvironment($this->Data);
                
                // Parivarthana
                if ($this->hasParivarthana($kendraRuler, $trikonaRuler)) {
                    yield [
                        'kendra' => $kendraRuler,
                        'trikona' => $trikonaRuler,
                        'interplay' => Yoga::INTERPLAY_PARIVARTHANA,
                    ];
                }
                
                // Conjunct
                $kendraRulerIsConjuncted = $KendraRuler->isConjuncted();
                if (isset($kendraRulerIsConjuncted[$trikonaRuler])) {
                    yield [
                        'kendra' => $kendraRuler,
                        'trikona' => $trikonaRuler,
                        'interplay' => Yoga::INTERPLAY_CONJUNCT,
                    ];
                }
                
                // Aspect
                $kendraRulerIsAspected = $KendraRuler->isAspectedByGraha();
                $trikonaRulerIsAspected = $TrikonaRuler->isAspectedByGraha();
                if (
                    $kendraRulerIsAspected[$trikonaRuler] == 1 &&
                    $trikonaRulerIsAspected[$kendraRuler] == 1
                ) {
                    yield [
                        'kendra' => $kendraRuler,
                        'trikona' => $trikonaRuler,
                        'interplay' => Yoga::INTERPLAY_ASPECT,
                    ];
                }
            }
        }
    }
}
