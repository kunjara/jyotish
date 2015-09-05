<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Panchanga\Vara;

use Jyotish\Panchanga\Vara\Vara;
use Jyotish\Graha\Graha;

/**
 * @group panchanga
 */
class VaraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Panchanga\Vara\Vara::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testVaraGetInstance()
    {
        $Vara = Vara::getInstance('Sy');
        $this->assertInstanceOf('\Jyotish\Panchanga\Vara\Object\Sy', $Vara);
        
        $Vara = Vara::getInstance('MA');
        $this->assertInstanceOf('\Jyotish\Panchanga\Vara\Object\Ma', $Vara);
        
        $Vara = Vara::getInstance('sk');
        $this->assertInstanceOf('\Jyotish\Panchanga\Vara\Object\Sk', $Vara);
        
        // testing exception
        $Vara = Vara::getInstance('Cu');
    }
    
    /**
     * @covers Jyotish\Panchanga\Vara\Vara::listVara
     * @expectedException InvalidArgumentException
     */
    public function testListVara()
    {
        $vara = [
            Graha::KEY_MA => Vara::NAME_MA,
            Graha::KEY_BU => Vara::NAME_BU,
            Graha::KEY_GU => Vara::NAME_GU,
            Graha::KEY_SK => Vara::NAME_SK,
            Graha::KEY_SA => Vara::NAME_SA,
            Graha::KEY_SY => Vara::NAME_SY,
            Graha::KEY_CH => Vara::NAME_CH,
        ];
        $this->assertSame($vara, Vara::listVara('Ma'));
        
        $vara = [
            Graha::KEY_GU => Vara::NAME_GU,
            Graha::KEY_SK => Vara::NAME_SK,
            Graha::KEY_SA => Vara::NAME_SA,
            Graha::KEY_SY => Vara::NAME_SY,
            Graha::KEY_CH => Vara::NAME_CH,
            Graha::KEY_MA => Vara::NAME_MA,
            Graha::KEY_BU => Vara::NAME_BU,
        ];
        $this->assertSame($vara, Vara::listVara('GU'));
        
        // testing exception
        $this->assertSame($vara, Vara::listVara('Li'));
    }
}
