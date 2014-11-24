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
    
    public function testNumberInCycle()
    {
        for ($i = -13; $i <= 13; $i++){
            if($i == 0) continue;
            $numbersExpected[] = Math::numberInCycle(1, $i);
        }
        $numbersActual = [
            12, 
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 
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
}
