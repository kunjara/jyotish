<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base;

use Jyotish\Base\Utility;

/**
 * @group Base
 */
class UtilityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Base\Utility::htmlToRgb
     * @dataProvider providerHtmlToRgb
     */
    public function testHtmlToRgb($color, $rgb)
    {
        $rgbExpected = Utility::htmlToRgb($color);
        $this->assertEquals($rgbExpected, $rgb);
    }
    
    public function providerHtmlToRgb()
    {
        return [
            ['#000', ['r' => 0, 'g' => 0, 'b' => 0]],
            ['#ffffff', ['r' => 255, 'g' => 255, 'b' => 255]],
            ['ffffff', ['r' => 255, 'g' => 255, 'b' => 255]],
            ['fffff', false],
        ];
    }
    
    /**
     * @covers Jyotish\Base\Utility::dmsToStirng
     */
    public function testDmsToStirng()
    {
        $dms = ['d' => 30, 'm' => 20, 's' => 33];
        $this->assertEquals(Utility::dmsToStirng($dms), '30&deg;20\'33"');
        
        $dms = ['d' => 30, 'm' => 20, 's' => 0];
        $this->assertEquals(Utility::dmsToStirng($dms), '30&deg;20\'');
        
        $dms = ['d' => 30, 'm' => 0, 's' => 0];
        $this->assertEquals(Utility::dmsToStirng($dms), '30&deg;');
        
        $dms = ['d' => 30];
        $this->assertEquals(Utility::dmsToStirng($dms), '30&deg;');
    }
}
