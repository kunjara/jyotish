<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Panchanga\Nakshatra;

use Jyotish\Panchanga\Nakshatra\Nakshatra;

/**
 * @group panchanga
 */
class NakshatraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Panchanga\Nakshatra\Nakshatra::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testNakshatraGetInstance()
    {
        $Nakshatra = Nakshatra::getInstance(3);
        $this->assertInstanceOf('\Jyotish\Panchanga\Nakshatra\Object\N3', $Nakshatra);
        
        $Nakshatra = Nakshatra::getInstance('11');
        $this->assertInstanceOf('\Jyotish\Panchanga\Nakshatra\Object\N11', $Nakshatra);
        
        // testing exception
        $Nakshatra = Nakshatra::getInstance(34);
    }
    
    /**
     * @covers Jyotish\Panchanga\Nakshatra\Nakshatra::listNakshatra
     */
    public function testListNakshatra()
    {
        $nakshatra = [
            1 => 'Ashwini',
            2 => 'Bharani',
            3 => 'Krittika',
            4 => 'Rohini',
            5 => 'Mrigashirsha',
            6 => 'Ardra',
            7 => 'Punarvasu',
            8 => 'Pushya',
            9 => 'Ashlesha',
            10 => 'Magha',
            11 => 'Poorva Phalguni',
            12 => 'Uttara Phalguni',
            13 => 'Hasta',
            14 => 'Chitra',
            15 => 'Swati',
            16 => 'Vishakha',
            17 => 'Anuradha',
            18 => 'Jyeshtha',
            19 => 'Moola',
            20 => 'Purva Ashadha',
            21 => 'Uttara Ashadha',
            28 => 'Abhijit',
            22 => 'Shravana',
            23 => 'Dhanishta',
            24 => 'Shatabhisha',
            25 => 'Purva Bhadrapada',
            26 => 'Uttara Bhadrapada',
            27 => 'Revati',
        ];
        
        $this->assertEquals($nakshatra, Nakshatra::listNakshatra(true));
    }
}
