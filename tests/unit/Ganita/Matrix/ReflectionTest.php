<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix\Reflection;

/**
 * @group ganita
 */
class ReflectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix\Reflection::__construct
     * @dataProvider providerConstruct
     */
    public function testConstruct($xCoord, $yCoord, $matrixArray)
    {
        $Matrix = new Reflection($xCoord, $yCoord);
        $arrayActual = $Matrix->toArray();
        $this->assertEquals($matrixArray, $arrayActual);
    }
    
    public function providerConstruct()
    {
        return [
            [true, true,
                [
                    [-1, 0, 0],
                    [0, -1, 0],
                    [0, 0, 1],
                ]
            ],
            [true, false,
                [
                    [1, 0, 0],
                    [0, -1, 0],
                    [0, 0, 1],
                ]
            ],
            [false, true,
                [
                    [-1, 0, 0],
                    [0, 1, 0],
                    [0, 0, 1],
                ]
            ],
            [false, false,
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [0, 0, 1],
                ]
            ],
        ];
    }
}
