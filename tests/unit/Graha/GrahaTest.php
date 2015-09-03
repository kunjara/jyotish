<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Graha;

use Jyotish\Graha\Graha;
use Jyotish\Tattva\Jiva\Nara\Deva;

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
     */
    public function testListGraha()
    {
        $data = [
            Graha::KEY_MA => Deva::DEVA_MANGAL,
            Graha::KEY_BU => Deva::DEVA_BUDHA,
            Graha::KEY_GU => Deva::DEVA_GURU,
            Graha::KEY_SK => Deva::DEVA_SHUKRA,
            Graha::KEY_SA => Deva::DEVA_SHANI,
        ];
        $this->assertEquals($data, Graha::listGraha(Graha::LIST_PANCHA));
        
        $data = [
            Graha::KEY_KE => Graha::NAME_KE,
            Graha::KEY_RA => Graha::NAME_RA,
        ];
        $this->assertEquals($data, Graha::listGraha(Graha::LIST_CHAYA));
    }
    
    /**
     * @covers Jyotish\Graha\Graha::listGrahaByFeature
     * @expectedException UnexpectedValueException
     */
    public function testListGrahaByFeature()
    {
        $feature = 'gender';
        $data = [
            Graha::KEY_SY => Deva::DEVA_SURYA,
            Graha::KEY_MA => Deva::DEVA_MANGAL,
            Graha::KEY_GU => Deva::DEVA_GURU,
        ];
        $this->assertEquals($data, Graha::listGrahaByFeature($feature, 'male'));
        
        // testing exception
        $feature = 'home';
        $data = [];
        $this->assertEquals($data, Graha::listGrahaByFeature($feature, 'male'));
    }
}
