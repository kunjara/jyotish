<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base;

use Jyotish\Base\Data;
use Mockery;
use DateTime;

/**
 * @group base
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $DateTime = new DateTime;
        
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude')->andReturn('Lon 1');
        $Locality->shouldReceive('getLatitude')->andReturn('Lat 1');
        $Locality->shouldReceive('getAltitude')->andReturn('Alt 1');
        
        $Ganita = Mockery::mock('Jyotish\Ganita\Method\AbstractGanita');
        
        $this->Data = new Data($DateTime, $Locality, $Ganita);
    }
    
    public function tearDown()
    {
        $this->Data = null;
        Mockery::close();
    }
    
    /**
     * @covers Jyotish\Base\Data::listBlock
     */
    public function testListBlock()
    {
        $blocks = ['bhava', 'graha', 'kala', 'lagna', 'panchanga', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('worising'));
        $this->assertEquals($blocks, $blocksActual);
        
        $blocks = ['bhava', 'graha', 'kala', 'lagna', 'panchanga', 'rising', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('calc'));
        $this->assertEquals($blocks, $blocksActual);
    }

    /**
     * @covers Jyotish\Base\Data::getDateTime
     * @covers Jyotish\Base\Data::setDateTime
     */
    public function testDateTime()
    {
        $this->assertInstanceOf('DateTime', $this->Data->getDateTime());
        
        $DateTime = new DateTime('2015-01-01 20:00:50');
        $this->Data->setDateTime($DateTime);
        $this->assertEquals($DateTime, $this->Data->getDateTime());
    }
    
    /**
     * @covers Jyotish\Base\Data::getLocality
     * @covers Jyotish\Base\Data::setLocality
     */
    public function testLocality()
    {
        $this->assertInstanceOf('Jyotish\Base\Locality', $this->Data->getLocality());
        $this->assertEquals('Lon 1', $this->Data->getLocality()->getLongitude());
        
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude')->andReturn('Lon 2');
        $Locality->shouldReceive('getLatitude')->andReturn('Lat 2');
        $Locality->shouldReceive('getAltitude')->andReturn('Alt 2');
        $this->Data->setLocality($Locality);
        $this->assertInstanceOf('Jyotish\Base\Locality', $this->Data->getLocality());
        $this->assertEquals('Lon 2', $this->Data->getLocality()->getLongitude());
    }
    
    /**
     * @covers Jyotish\Base\Data::getData
     */
    public function testGetData()
    {
        $this->assertArrayHasKey('user', $this->Data->getData());
        
        foreach (['datetime', 'timezone', 'longitude', 'latitude', 'altitude'] as $value) {
            $this->assertArrayHasKey($value, $this->Data->getData()['user']);
        }
	}
}
