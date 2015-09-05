<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Panchanga;

use Jyotish\Panchanga\Panchanga;

/**
 * @group panchanga
 */
class PanchangaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Panchanga\Panchanga::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Anga = Panchanga::getInstance('tithi', 3);
        $this->assertInstanceOf('\Jyotish\Panchanga\Tithi\Object\T3', $Anga);
        
        $Anga = Panchanga::getInstance('nakshatra', 13);
        $this->assertInstanceOf('\Jyotish\Panchanga\Nakshatra\Object\N13', $Anga);
        
        $Anga = Panchanga::getInstance('vara', 'Ma');
        $this->assertInstanceOf('\Jyotish\Panchanga\Vara\Object\Ma', $Anga);
        
        $Anga = Panchanga::getInstance('yoga', 17);
        $this->assertInstanceOf('\Jyotish\Panchanga\Yoga\Object\Y17', $Anga);
        
        $Anga = Panchanga::getInstance('Yoga', '17');
        $this->assertInstanceOf('\Jyotish\Panchanga\Yoga\Object\Y17', $Anga);
        
        // testing exception
        $Anga = Panchanga::getInstance('kripa', 22);
    }
}
