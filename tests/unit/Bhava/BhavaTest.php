<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Bhava;

use Jyotish\Bhava\Bhava;

/**
 * @group bhava
 */
class BhavaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Bhava\Bhava::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Bhava = Bhava::getInstance(2);
        $this->assertInstanceOf('\Jyotish\Bhava\Object\B2', $Bhava);
        
        $Bhava = Bhava::getInstance('11');
        $this->assertInstanceOf('\Jyotish\Bhava\Object\B11', $Bhava);
        
        // testing exception
        $Bhava = Bhava::getInstance('14');
    }
}
