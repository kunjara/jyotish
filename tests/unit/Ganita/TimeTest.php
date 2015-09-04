<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Time;
use DateTime;
use DateTimeZone;

/**
 * @group ganita
 */
class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Time::formatOffset
     */
    public function testFormatOffset()
    {
        $offset = 3600;
        $this->assertEquals('01:00', Time::formatOffset($offset));
        
        $offset = -7200;
        $this->assertEquals('-02:00', Time::formatOffset($offset));
        
        $offset = 0;
        $this->assertEquals('00:00', Time::formatOffset($offset));
        
        $offset = 3665;
        $this->assertEquals('01:01', Time::formatOffset($offset));
    }
    
    /**
     * @covers Jyotish\Ganita\Time::disformatOffset
     */
    public function testDisformatOffset()
    {
        $offset = '01:00';
        $this->assertEquals(3600, Time::disformatOffset($offset));
        
        $offset = '-02:00';
        $this->assertEquals(-7200, Time::disformatOffset($offset));
        
        $offset = '00:00';
        $this->assertEquals(0, Time::disformatOffset($offset));
    }
    
    /**
     * @covers Jyotish\Ganita\Time::getTimeZoneOffset
     * @depends testFormatOffset
     */
    public function testGetTimeZoneOffset()
    {
        $DateTime = new DateTime('2015-09-04 09:00:00', new DateTimeZone('Europe/Volgograd'));
        $this->assertEquals(10800, Time::getTimeZoneOffset($DateTime));
        $this->assertEquals('03:00', Time::getTimeZoneOffset($DateTime, true));
    }
}
