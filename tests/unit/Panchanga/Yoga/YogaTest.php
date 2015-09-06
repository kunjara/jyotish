<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Panchanga\Yoga;

use Jyotish\Panchanga\Yoga\Yoga;

/**
 * @group panchanga
 */
class YogaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Panchanga\Yoga\Yoga::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testTithiGetInstance()
    {
        $Yoga = Yoga::getInstance(3);
        $this->assertInstanceOf('\Jyotish\Panchanga\Yoga\Object\Y3', $Yoga);
        
        $Yoga = Yoga::getInstance('11');
        $this->assertInstanceOf('\Jyotish\Panchanga\Yoga\Object\Y11', $Yoga);
        
        // testing exception
        $Yoga = Yoga::getInstance(34);
    }
}
