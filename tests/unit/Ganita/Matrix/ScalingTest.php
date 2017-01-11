<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix\Scaling;

/**
 * @group ganita
 */
class ScalingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix\Scaling::__construct
     * @dataProvider providerConstruct
     */
    public function testConstruct($xScale, $yScale, $matrixArray)
    {
        $Matrix = new Scaling($xScale, $yScale);
        $arrayActual = $Matrix->toArray();
        $this->assertEquals($matrixArray, $arrayActual);
    }
    
    /**
     * @covers Jyotish\Ganita\Matrix\Scaling::__construct
     * @dataProvider providerConstructException
     * @expectedException InvalidArgumentException
     */
    public function testConstructException($xScale, $yScale)
    {
        $Matrix = new Scaling($xScale, $yScale);
    }
    
    public function providerConstruct()
    {
        return [
            [3, 3,
                [
                    [3, 0, 0],
                    [0, 3, 0],
                    [0, 0, 1],
                ]
            ],
            [0.5, 0.8,
                [
                    [0.5, 0, 0],
                    [0, 0.8, 0],
                    [0, 0, 1],
                ]
            ],
            [1, 1,
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [0, 0, 1],
                ]
            ],
        ];
    }
    
    public function providerConstructException()
    {
        return [
            [-3, 3],
            [0, 3],
            [1, -1],
        ];
    }
}
