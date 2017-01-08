<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix\Translation;

/**
 * @group ganita
 */
class TranslationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix\Translation::__construct
     * @dataProvider providerConstruct
     */
    public function testConstruct($x, $y, $matrixArray)
    {
        $Matrix = new Translation($x, $y);
        $arrayActual = $Matrix->toArray();
        $this->assertEquals($matrixArray, $arrayActual);
    }
    
    public function providerConstruct()
    {
        return [
            [3, 3, 
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [3, 3, 1],
                ]
            ],
            [5.5, 3.1, 
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [5.5, 3.1, 1],
                ]
            ],
            [0, 0, 
                [
                    [1, 0, 0],
                    [0, 1, 0],
                    [0, 0, 1],
                ]
            ],
            [1, -1, 
                [
                    [1, 0,0],
                    [0, 1, 0],
                    [1, -1, 1],
                ]
            ],
        ];
    }
}
