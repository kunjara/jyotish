<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga;

use Jyotish\Yoga\Yoga;

/**
 * @group yoga
 */
class YogaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Yoga\Yoga::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Yoga = Yoga::getInstance('mahapurusha');
        $this->assertInstanceOf('\Jyotish\Yoga\Type\Mahapurusha', $Yoga);
        
        $Yoga = Yoga::getInstance('Dhana');
        $this->assertInstanceOf('\Jyotish\Yoga\Type\Dhana', $Yoga);
        
        $Yoga = Yoga::getInstance('RAJA');
        $this->assertInstanceOf('\Jyotish\Yoga\Type\Raja', $Yoga);
        
        // testing exception
        $Yoga = Yoga::getInstance('Super');
    }
}
