<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base;

use Jyotish\Base\Locality;

/**
 * @group base
 */
class LocalityTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->Locality = new Locality([]);
    }
    
    public function tearDown()
    {
        $this->Locality = null;
    }

    /**
     * @covers Jyotish\Base\Locality::setLongitude
     * @covers Jyotish\Base\Locality::getLongitude
     * @expectedException InvalidArgumentException
     */
    public function testLongitude()
    {
        $this->Locality->setLongitude(45);
        $this->assertEquals(45, $this->Locality->getLongitude());
        
        $this->Locality->setLongitude(-90.5);
        $this->assertEquals(-90.5, $this->Locality->getLongitude());
        
        $this->Locality->setLongitude('80');
        $this->assertEquals(80, $this->Locality->getLongitude());
        
        // test exception
        $this->Locality->setLongitude(270);
        $this->assertEquals(270, $this->Locality->getLongitude());
    }
    
    /**
     * @covers Jyotish\Base\Locality::setLatitude
     * @covers Jyotish\Base\Locality::getLatitude
     * @expectedException InvalidArgumentException
     */
    public function testLatitude()
    {
        $this->Locality->setLatitude(45);
        $this->assertEquals(45, $this->Locality->getLatitude());
        
        $this->Locality->setLatitude(-20.5);
        $this->assertEquals(-20.5, $this->Locality->getLatitude());
        
        $this->Locality->setLatitude('80');
        $this->assertEquals(80, $this->Locality->getLatitude());
        
        // test exception
        $this->Locality->setLatitude(95);
        $this->assertEquals(95, $this->Locality->getLatitude());
    }
    
    /**
     * @covers Jyotish\Base\Locality::setAltitude
     * @covers Jyotish\Base\Locality::getAltitude
     * @expectedException InvalidArgumentException
     */
    public function testAltitude()
    {
        $this->Locality->setAltitude(45);
        $this->assertEquals(45, $this->Locality->getAltitude());
        
        $this->Locality->setAltitude(-5.5);
        $this->assertEquals(-5.5, $this->Locality->getAltitude());
        
        $this->Locality->setAltitude('800');
        $this->assertEquals(800, $this->Locality->getAltitude());
        
        // test exception
        $this->Locality->setAltitude('95a');
        $this->assertEquals(95, $this->Locality->getAltitude());
    }
    
    /**
     * @covers Jyotish\Base\Locality::__construct
     * @depends testLongitude
     * @depends testLatitude
     * @depends testAltitude
     */
    public function testConstruct()
    {
        $data = ['longitude' => 50, 'latitude' => 30, 'altitude' => 10];
        $Locality = new Locality($data);
        $this->assertEquals(50, $Locality->getLongitude());
        $this->assertEquals(30, $Locality->getLatitude());
        $this->assertEquals(10, $Locality->getAltitude());
    }
}
