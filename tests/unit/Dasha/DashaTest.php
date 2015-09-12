<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Dasha;

use Jyotish\Dasha\Dasha;

/**
 * @group dasha
 */
class DashaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Dasha\Dasha::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Dasha = Dasha::getInstance('vimshottari');
        $this->assertInstanceOf('\Jyotish\Dasha\Object\Vimshottari', $Dasha);
        
        $Dasha = Dasha::getInstance('ashtottari');
        $this->assertInstanceOf('\Jyotish\Dasha\Object\Ashtottari', $Dasha);
        
        $Dasha = Dasha::getInstance('Vimshottari');
        $this->assertInstanceOf('\Jyotish\Dasha\Object\Vimshottari', $Dasha);
        
        $Dasha = Dasha::getInstance('ASHTOTTARI');
        $this->assertInstanceOf('\Jyotish\Dasha\Object\Ashtottari', $Dasha);
        
        // testing exception
        $Dasha = Dasha::getInstance('nanottari');
    }
}
