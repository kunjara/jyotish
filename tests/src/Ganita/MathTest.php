<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Math;
use Jyotish\Bhava\Bhava;

/**
 * @group Ganita
 */
class MathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerDmsToDecimal
     */
    public function testDmsToDecimal($dms, $decimalActual)
    {
        $decimalExpected = Math::dmsToDecimal($dms);
        $this->assertEquals($decimalExpected, $decimalActual, '', .001);
    }
    
    public function providerDmsToDecimal()
    {
        return [
            [['d' => 13, 'm' => 20], 13.33333],
            [['d' => -13, 'm' => 20], -13.33333],
            [['d' => 26, 'm' => -80], -27.33333],
            [['d' => 26, 'm' => 0, 's' => 60], 26.01667],
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
    
    public function testPartsToUnits()
    {
        $value = 32.4;
        $this->assertEquals(['units' => 2, 'parts' => 2.4], Math::partsToUnits($value));
        $this->assertEquals(['units' => 1, 'parts' => 2.4], Math::partsToUnits($value, 30, 'floor'));
        $this->assertEquals(['units' => 4, 'parts' => 2.4], Math::partsToUnits($value, 10));
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
     * @expectedException InvalidArgumentException 
     */
    public function testNumberInCycle()
    {
        for ($i = -13; $i <= 13; $i++){
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
     * @depends testNumberInCycle
     */
    public function testNumberNext()
    {
        for($i = 1; $i <= 14; $i++){
            $numbersExpected[] = Math::numberNext($i);
        }
        $numbersActual = [
            2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3
        ];
        $this->assertEquals($numbersExpected, $numbersActual);
    }
    
    /**
     * @depends testNumberInCycle
     */
    public function testNumberPrev()
    {
        for($i = 1; $i <= 14; $i++){
            $numbersExpected[] = Math::numberPrev($i);
        }
        $numbersActual = [
            12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 1
        ];
        $this->assertEquals($numbersExpected, $numbersActual);
    }
    
    public function testSign()
    {
        $value = -32.2;
        $this->assertEquals(Math::sign($value), -1);
        
        $value = .0;
        $this->assertEquals(Math::sign($value), 0);
        
        $value = 722;
        $this->assertEquals(Math::sign($value), 1);
    }
    
    public function testArraySum()
    {
        $array1 = [
            'first' => -2,
            'second' => 23.6,
        ];
        $array2 = [
            8.9,
            'second' => 4,
            'first' => 3.3,
        ];
        $this->assertEquals(Math::arraySum($array1, $array2), [8.9, 'first' => 1.3, 'second' => 27.6]);
    }
    
    public function testArrayInArray()
    {
        $array1 = [3, 7];
        $array2 = Bhava::$bhavaTrishadaya;
        $this->assertTrue(Math::arrayInArray($array1, $array2));
        $this->assertNotTrue(Math::arrayInArray($array1, $array2, true));
        
        $array1 = [1, 3, 5];
        $array2 = Bhava::$bhavaDusthana;
        $this->assertNotTrue(Math::arrayInArray($array1, $array2));
        $this->assertNotTrue(Math::arrayInArray($array1, $array2, true));
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
    
    public function testOppositeValue()
    {
        $value = 11;
        $this->assertEquals(Math::oppositeValue($value), 5);
        
        $value = 340.23;
        $this->assertEquals(Math::oppositeValue($value, 360), 160.23);
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
