<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Panchanga\Tithi;

use Jyotish\Panchanga\Tithi\Tithi;

/**
 * @group panchanga
 */
class TithiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Panchanga\Tithi\Tithi::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testTithiGetInstance()
    {
        $Tithi = Tithi::getInstance(3);
        $this->assertInstanceOf('\Jyotish\Panchanga\Tithi\Object\T3', $Tithi);
        
        $Tithi = Tithi::getInstance('11');
        $this->assertInstanceOf('\Jyotish\Panchanga\Tithi\Object\T11', $Tithi);
        
        // testing exception
        $Tithi = Tithi::getInstance(34);
    }
}
