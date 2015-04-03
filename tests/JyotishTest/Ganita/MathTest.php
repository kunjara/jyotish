<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Math;

/**
 * @group Ganita
 */
class MathTest extends \PHPUnit_Framework_TestCase{
    /**
     * @dataProvider providerDmsToDecimal
     */
    public function testDmsToDecimal($dms, $decimalActual)
    {
        $decimalExpected = Math::dmsToDecimal($dms);
        $this->assertEquals($decimalExpected, $decimalActual);
    }
    
    public function providerDmsToDecimal()
    {
        return [
            [['d' => 13, 'm' => 20], 13.333333333333],
            [['d' => -13, 'm' => 20], -13.333333333333],
            [['d' => 26, 'm' => -80], -27.333333333333],
            [['d' => 26, 'm' => 0, 's' => 60], 26.016666666667],
            [['d' => -13, 'm' => -20, 's' => -60], -13.35],
        ];
    }
    
    /**
     * @dataProvider providerDecimalToDms
     */
    public function testDecimalToDms($decimal, $dmsActual)
    {
        $dmsExpected = Math::decimalToDms($decimal);
        $this->assertEquals($dmsExpected, $dmsActual);
    }
    
    public function providerDecimalToDms()
    {
        return [
            [13.3333333333333333, ['d' => 13, 'm' => 20]],
            [-13.3333333333333333, ['d' => -13, 'm' => 20]],
            [26.0166666666666667, ['d' => 26, 'm' => 1]],
            [-13.35, ['d' => -13, 'm' => 21]],
        ];
    }

    public function testNumberInCycle()
    {
        for ($i = -13; $i <= 13; $i++){
            if($i == 0) continue;
            $numbersExpected[] = Math::numberInCycle(1, $i);
        }
        $numbersActual = [
            1, 
            2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
            1
        ];
        $this->assertEquals($numbersExpected, $numbersActual);
    }
    
    /**
     * @dataProvider providerDistanceInCycle
     */
    public function testDistanceInCycle($n1, $n2, $distanceActual)
    {
        $distanceExpected = Math::distanceInCycle($n1, $n2, 12);
        $this->assertEquals($distanceExpected, $distanceActual);
    }
    
    public function providerDistanceInCycle()
    {
        return [
            [1, 6, 6],
            [6, 1, 8],
            [8, 4, 9],
        ];
    }
    
    /**
     * @dataProvider providerInRange
     */
    public function testInRange($value, $min, $max)
    {
        $this->assertTrue(Math::inRange($value, $min, $max));
    }
    
    public function providerInRange()
    {
        return [
            [2, 2, 3],
            [1, 0, 2],
            [1, -2, 2],
        ];
    }
    
    /**
     * @dataProvider providerSimplifyNumber
     */
    public function testSimplifyNumber($number, $numActual)
    {
        $numExpected = Math::simplifyNumber($number);
        $this->assertEquals($numExpected, $numActual);
    }
    
    public function providerSimplifyNumber()
    {
        return [
            [3, 3],
            [10, 1],
            [28, 1],
            [288, 9],
            [98765, 8]
        ];
    }
}
