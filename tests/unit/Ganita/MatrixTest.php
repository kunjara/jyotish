<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix;

/**
 * @group ganita
 */
class MatrixTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix::toArray
     * @dataProvider providerToArray
     */
    public function testToArray($array)
    {
        $Matrix = new Matrix($array);
        $this->assertEquals($array, $Matrix->toArray());
    }

    /**
     * @covers Jyotish\Ganita\Matrix::getDimensions
     * @dataProvider providerGetDimensions
     */
    public function testGetDimensions($array, $toString, $dimensions)
    {
        $Matrix = new Matrix($array);
        $this->assertEquals($dimensions, $Matrix->getDimensions($toString));
    }
    
    /**
     * @covers Jyotish\Ganita\Matrix::addMatrix
     * @dataProvider providerAddMatrix
     */
    public function testAddMatrix($array1, $array2, $arrayResult)
    {
        $Matrix1 = new Matrix($array1);
        $Matrix2 = new Matrix($array2);
        $MatrixExpected = new Matrix($arrayResult);
        $MatrixActual = $Matrix1->addMatrix($Matrix2);
        $this->assertEquals($MatrixExpected, $MatrixActual);
    }
    
    /**
     * @covers Jyotish\Ganita\Matrix::addMatrix
     * @expectedException RuntimeException
     */
    public function testAddMatrixException()
    {
        $Matrix1 = new Matrix([[12, 2], [-3, 4], [0, 7]]);
        $Matrix2 = new Matrix([43, 23], [23, 11]);
        $Matrix1->addMatrix($Matrix2);
    }

    /**
     * @covers Jyotish\Ganita\Matrix::multiNumeric
     * @dataProvider providerMultiNumeric
     */
    public function testMultiNumeric($array, $numeric, $arrayResult)
    {
        $Matrix = new Matrix($array);
        $MatrixExpected = new Matrix($arrayResult);
        $MatrixActual = $Matrix->multiNumeric($numeric);
        $this->assertEquals($MatrixExpected, $MatrixActual);
    }
    
    /**
     * @covers Jyotish\Ganita\Matrix::multiMatrix
     * @dataProvider providerMultiMatrix
     */
    public function testMultiMatrix($array1, $array2, $arrayResult)
    {
        $Matrix1 = new Matrix($array1);
        $Matrix2 = new Matrix($array2);
        $MatrixExpected = new Matrix($arrayResult);
        $MatrixActual = $Matrix1->multiMatrix($Matrix2);
        $this->assertEquals($MatrixExpected, $MatrixActual);
    }
    
    /**
     * @covers Jyotish\Ganita\Matrix::multiMatrix
     * @expectedException RuntimeException
     */
    public function testMultiMatrixException()
    {
        $Matrix1 = new Matrix([43, 23], [23, 11]);
        $Matrix2 = new Matrix([[12, 2], [-3, 4], [0, 7]]);
        $Matrix1->multiMatrix($Matrix2);
    }

    public function providerToArray()
    {
        return [
            [['a', 'b', 'c'], ['d', 'e', 'f']],
            [['1', '2'], ['3', '4']],
            [[]],
        ];
    }

    public function providerGetDimensions()
    {
        return [
            [
                [[1, 1, 1]],
                 false,
                ['rows' => 1, 'cols' => 3],
               
            ],
            [
                [[1], [2], [3]],
                false,
                ['rows' => 3, 'cols' => 1],
            ],
            [
                [['a', 'b', 'c'], [1, 'a', '&'], [33, 44, 55]],
                false,
                ['rows' => 3, 'cols' => 3],
            ],
            [
                [[1, 1], [3, 4]],
                true,
                '2x2',
            ],
            [
                [[1]],
                true,
                '1x1',
            ],
            [
                [[]],
                true,
                '0x0',
            ],
        ];
    }
    
    public function providerAddMatrix()
    {
        return [
            [
                [[12, 2], [-3, 4], [0, 7]],
                [[-4, 8], [-3, 6], [10, 1]],
                [[8, 10], [-6, 10], [10, 8]],
            ],
            [
                [[4, 2], [9, 0]],
                [[3, 1], [-3, 4]],
                [[7, 3], [6, 4]],
            ],
        ];
    }
    
    public function providerMultiNumeric()
    {
        return [
            [
                [[-2, 1], [0, 4]],
                2,
                [[-4, 2], [0, 8]],
            ],
            [
                [[-2, 1], [0, 4]],
                -3,
                [[6, -3], [0, -12]],
            ],
        ];
    }
    
    public function providerMultiMatrix()
    {
        return [
            [
                [[1, 2], [3, 4]],
                [[5, 6], [7, 8]],
                [[19, 22], [43, 50]],
            ],
            [
                [[5, 6], [7, 8]],
                [[1, 2], [3, 4]],
                [[23, 34], [31, 46]],
            ],
            [
                [[1, 3, 2], [6, 4, 5]],
                [[3, 2, 1], [2, 1, 3], [4, 3, 0]],
                [[17, 11, 10], [46, 31, 18]],
            ],
        ];
    }
}
