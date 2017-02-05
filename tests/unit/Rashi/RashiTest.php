<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Rashi;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;
use Jyotish\Tattva\Maha;
use Jyotish\Tattva\Jiva;

/**
 * @group rashi
 */
class RashiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Rashi\Rashi::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Rashi = Rashi::getInstance('2');
        $this->assertInstanceOf('\Jyotish\Rashi\Object\R2', $Rashi);
        
        $Rashi = Rashi::getInstance('11');
        $this->assertInstanceOf('\Jyotish\Rashi\Object\R11', $Rashi);
        
        // testing exception
        $Rashi = Rashi::getInstance('14');
    }
    
    /**
     * @covers Jyotish\Rashi\Rashi::listRashiByFeature
     * @dataProvider dataListRashiByFeature
     */
    public function testListRashiByFeature($feature, $value, $data)
    {
        $this->assertEquals($data, array_keys(Rashi::listRashiByFeature($feature, $value)));
    }
    
    /**
     * @covers Jyotish\Rashi\Rashi::listRashiByFeature
     * @expectedException UnexpectedValueException
     */
    public function testListRashiByFeatureException()
    {
        $feature = 'some';
        $this->assertEquals([], Rashi::listRashiByFeature($feature, 'value'));
    }
    
    public function dataListRashiByFeature()
    {
        return [
            ['bhava', Rashi::BHAVA_CHARA, [1, 4, 7, 10]],
            ['bhava', Rashi::BHAVA_STHIRA, [2, 5, 8, 11]],
            ['gender', Jiva::GENDER_MALE, [1, 3, 5, 7, 9, 11]],
            ['gender', Jiva::GENDER_FEMALE, [2, 4, 6, 8, 10, 12]],
            ['bhuta', Maha::BHUTA_AGNI, [1, 5, 9]],
            ['bhuta', Maha::BHUTA_VAYU, [3, 7, 11]],
        ];
    }

    /**
     * @covers Jyotish\Rashi\Rashi::listTrimshamshaRuler
     */
    public function testListTrimshamshaRuler()
    {
        $data = [
            Graha::KEY_SK => 5,
            Graha::KEY_BU => 7,
            Graha::KEY_GU => 8,
            Graha::KEY_SA => 5,
            Graha::KEY_MA => 5,
        ];
        $this->assertSame($data, Rashi::listTrimshamshaRuler(2));
        
        $this->assertEquals($data, Rashi::listTrimshamshaRuler(1));
        $this->assertNotSame($data, Rashi::listTrimshamshaRuler(1));
    }
}
