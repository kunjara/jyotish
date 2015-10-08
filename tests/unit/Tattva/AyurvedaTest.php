<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Tattva;

use Jyotish\Tattva\Ayurveda;

/**
 * @group tattva
 */
class AyurvedaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Tattva\Ayurveda::listPrakriti
     */
    public function testListPrakriti()
    {
        $list = Ayurveda::listPrakriti(true);
        $this->assertEquals([
            Ayurveda::PRAKRITI_KAPHA,
            Ayurveda::PRAKRITI_PITTA,
            Ayurveda::PRAKRITI_VATA,
            Ayurveda::PRAKRITI_MISHRA,
        ], $list);
        
        $list = Ayurveda::listPrakriti(false);
        $this->assertEquals([
            Ayurveda::PRAKRITI_KAPHA,
            Ayurveda::PRAKRITI_PITTA,
            Ayurveda::PRAKRITI_VATA,
        ], $list);
    }
    
    /**
     * @covers Jyotish\Tattva\Ayurveda::listRasa
     */
    public function testListRasa()
    {
        $list = Ayurveda::listRasa(true);
        $this->assertEquals([
            Ayurveda::RASA_MADHURA,
            Ayurveda::RASA_LAVANA,
            Ayurveda::RASA_AMLA,
            Ayurveda::RASA_KASHAYA,
            Ayurveda::RASA_TIKTA,
            Ayurveda::RASA_KATU,
            Ayurveda::RASA_MISHRA,
        ], $list);
        
        $list = Ayurveda::listRasa(false);
        $this->assertEquals([
            Ayurveda::RASA_MADHURA,
            Ayurveda::RASA_LAVANA,
            Ayurveda::RASA_AMLA,
            Ayurveda::RASA_KASHAYA,
            Ayurveda::RASA_TIKTA,
            Ayurveda::RASA_KATU,
        ], $list);
    }
}
