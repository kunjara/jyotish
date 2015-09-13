<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Varga;

use Jyotish\Varga\Varga;

/**
 * @group varga
 */
class VargaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Varga\Varga::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Varga = Varga::getInstance('D1');
        $this->assertInstanceOf('\Jyotish\Varga\Object\D1', $Varga);
        
        $Varga = Varga::getInstance('d9');
        $this->assertInstanceOf('\Jyotish\Varga\Object\D9', $Varga);
        
        // testing exception
        $Varga = Varga::getInstance('D14');
    }
}
