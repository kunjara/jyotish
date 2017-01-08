<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix\Rotation;

/**
 * @group ganita
 */
class RotationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix\Rotation::__construct
     * @dataProvider providerConstruct
     */
    public function testConstruct($angle, $matrixArray)
    {
        $Matrix = new Rotation($angle);
        $arrayActual = $Matrix->toArray();
        $this->assertEquals($matrixArray, $arrayActual);
    }
    
    public function providerConstruct()
    {
        return [
            [M_PI_2, 
                [
                    [0, 1, 0],
                    [-1, 0, 0],
                    [0, 0, 1],
                ]
            ],
            [M_PI_4, 
                [
                    [M_SQRT2 / 2, M_SQRT2 / 2, 0],
                    [-M_SQRT2 / 2, M_SQRT2 / 2, 0],
                    [0, 0, 1],
                ]
            ],
            [M_PI_2 / 3, 
                [
                    [M_SQRT3 / 2, 0.5, 0],
                    [-0.5, M_SQRT3 / 2, 0],
                    [0, 0, 1],
                ]
            ],
            [0, 
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [0, 0, 1],
                ]
            ],
        ];
    }
}
