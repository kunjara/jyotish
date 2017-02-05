<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Graha;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva;
use Jyotish\Tattva\Jiva\Nara\Deva;
use Jyotish\Tattva\Jiva\Nara\Manusha;

/**
 * @group graha
 */
class GrahaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Graha\Graha::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Graha = Graha::getInstance('Sy');
        $this->assertInstanceOf('\Jyotish\Graha\Object\Sy', $Graha);
        
        $Graha = Graha::getInstance('Ra');
        $this->assertInstanceOf('\Jyotish\Graha\Object\Ra', $Graha);
        
        // testing exception
        $Graha = Graha::getInstance('Ka');
    }

    /**
     * @covers Jyotish\Graha\Graha::listGraha
     * @dataProvider dataListGraha
     */
    public function testListGraha($option, $data)
    {
        $this->assertEquals($data, array_keys(Graha::listGraha($option)));
    }
    
    public function dataListGraha()
    {
        return [
            [Graha::LIST_SAPTA, ['Sy', 'Ch', 'Ma', 'Bu', 'Gu', 'Sk', 'Sa']],
            [Graha::LIST_PANCHA, ['Ma', 'Bu', 'Gu', 'Sk', 'Sa']],
            [Graha::LIST_CHAYA, ['Ra', 'Ke']],
            [Graha::LIST_NAVA, ['Sy', 'Ch', 'Ma', 'Bu', 'Gu', 'Sk', 'Sa', 'Ra', 'Ke']],
            [Graha::LIST_CHESHTA, ['Sa', 'Gu', 'Ma', 'Sy', 'Sk', 'Bu', 'Ch']],
        ];
    }

    /**
     * @covers Jyotish\Graha\Graha::listGrahaByFeature
     * @dataProvider dataListGrahaByFeature
     */
    public function testListGrahaByFeature($feature, $value, $data)
    {
        $this->assertEquals($data, array_keys(Graha::listGrahaByFeature($feature, $value)));
    }
    
    /**
     * @covers Jyotish\Graha\Graha::listGrahaByFeature
     * @expectedException UnexpectedValueException
     */
    public function testListRashiByFeatureException()
    {
        $feature = 'some';
        $this->assertEquals([], Graha::listGrahaByFeature($feature, 'value'));
    }
    
    public function dataListGrahaByFeature()
    {
        return [
            ['gender', Jiva::GENDER_MALE, [Graha::KEY_SY, Graha::KEY_MA, Graha::KEY_GU]],
            ['gender', Jiva::GENDER_NEUTER, [Graha::KEY_BU, Graha::KEY_SA, Graha::KEY_RA, Graha::KEY_KE]],
            ['bhuta', Maha::BHUTA_JALA, [Graha::KEY_CH, Graha::KEY_SK]],
            ['bhuta', Maha::BHUTA_AGNI, [Graha::KEY_SY, Graha::KEY_MA]],
            ['varna', Manusha::VARNA_BRAHMANA, [Graha::KEY_GU, Graha::KEY_SK]],
            ['varna', Manusha::VARNA_VAISHYA, [Graha::KEY_CH, Graha::KEY_BU]],
        ];
    }
}
