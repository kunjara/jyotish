<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base\Import;

use Jyotish\Base\Import\JagannathaHora;
use ReflectionMethod;

/**
 * @group import
 */
class JagannathaHoraTest extends \PHPUnit_Framework_TestCase
{
    private $jhFilesPath;
    private $JagannathaHora;

    public function setUp()
    {
        parent::setUp();
        
        $ds = DIRECTORY_SEPARATOR;
        
        $this->jhFilesPath = __DIR__ . $ds . 'data' . $ds . 'jh' . $ds;
        $this->JagannathaHora = new JagannathaHora($this->jhFilesPath . 'JobsSteve.jhd');
    }
    
    /**
     * @covers Jyotish\Base\Import\JagannathaHora::convertValue
     * @dataProvider providerConvertValue
     */
    public function testConvertValue($valueOriginal, $valueConverted)
    {
        $reflectionMethod = new ReflectionMethod($this->JagannathaHora, 'convertValue');
        $reflectionMethod->setAccessible(true);
        
        $valueActual = $reflectionMethod->invokeArgs($this->JagannathaHora, [$valueOriginal]);
        $this->assertEquals($valueConverted, $valueActual);
    }
    
    public function providerConvertValue()
    {
        return [
            ['-8.0000', ['d' => -8, 'm' => 0, 's' => 0]],
            ['-97.1250', ['d' => -97, 'm' => 12, 's' => 30.0]],
            ['8.3275', ['d' => 8, 'm' => 32, 's' => 45]],
        ];
    }
    
    /**
     * @covers Jyotish\Base\Import\JagannathaHora::getTime
     * @depends testConvertValue
     * @dataProvider providerGetTime
     */
    public function testGetTime($value, $isTimezone, $valueExpected)
    {
        $reflectionMethod = new ReflectionMethod($this->JagannathaHora, 'getTime');
        $reflectionMethod->setAccessible(true);
        
        $valueActual = $reflectionMethod->invokeArgs($this->JagannathaHora, [$value, $isTimezone]);
        $this->assertEquals($valueExpected, $valueActual);
    }
    
    public function providerGetTime()
    {
        return [
            ['8.0000', false, '08:00:00'],
            ['-8.0000', false, '08:00:00'],
            ['8.0000', true, '-08:00'],
            ['-8.0000', true, '+08:00'],
            ['8.3275', false, '08:32:45'],
            ['-5.3000', true, '+05:30'],
        ];
    }
    
    /**
     * @covers Jyotish\Base\Import\JagannathaHora::getAngle
     * @depends testConvertValue
     * @dataProvider providerGetAngle
     */
    public function testGetAngle($value, $isLongitude, $valueExpected)
    {
        $reflectionMethod = new ReflectionMethod($this->JagannathaHora, 'getAngle');
        $reflectionMethod->setAccessible(true);
        
        $valueActual = $reflectionMethod->invokeArgs($this->JagannathaHora, [$value, $isLongitude]);
        $this->assertEquals($valueExpected, $valueActual, '', .0001);
    }
    
    public function providerGetAngle()
    {
        return [
            ['122.2510', true, -122.4183],
            ['-97.125000', true, 97.2083],
            ['56.100000', false, 56.1667],
        ];
    }
    
    /**
     * @covers Jyotish\Base\Import\JagannathaHora::__construct
     * @depends testGetTime
     * @depends testGetAngle
     */
    public function testConstruct() {
        $Source = new JagannathaHora($this->jhFilesPath . 'JobsSteve.jhd');
        $dataActual = $Source->getImportData();
        $this->assertEquals([
            'user' => [
                'datetime' => '1955-02-24 06:00:00',
                'timezone' => '-08:00',
                'longitude' => -122.418,
                'latitude' => 37.775,
                'altitude' => 63.0,
            ]
        ], $dataActual, '', .01);
        
        $Source = new JagannathaHora($this->jhFilesPath . 'BrandoMarlon.jhd');
        $dataActual = $Source->getImportData();
        $this->assertEquals([
            'user' => [
                'datetime' => '1924-04-03 23:00:00',
                'timezone' => '-06:00',
                'longitude' => -95.933,
                'latitude' => 41.250,
                'altitude' => 0.0,
            ]
        ], $dataActual, '', .01);
    }
}
