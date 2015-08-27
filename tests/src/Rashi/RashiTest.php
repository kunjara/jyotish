<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Rashi;

use Jyotish\Rashi\Rashi;
use Jyotish\Graha\Graha;

/**
 * @group Rashi
 */
class RashiTest extends \PHPUnit_Framework_TestCase
{
    /**
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

    public function testListTrimshamshaRuler()
    {
        $data = [
            Graha::KEY_SK => 5,
            Graha::KEY_BU => 7,
            Graha::KEY_GU => 8,
            Graha::KEY_SA => 5,
            Graha::KEY_MA => 5,
        ];
        $this->assertSame(Rashi::listTrimshamshaRuler(2), $data);
        
        $this->assertEquals(Rashi::listTrimshamshaRuler(1), $data);
        $this->assertNotSame(Rashi::listTrimshamshaRuler(1), $data);
    }
}
