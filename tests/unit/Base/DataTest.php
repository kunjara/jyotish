<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base;

use Jyotish\Base\Data;
use Mockery;
use DateTime;
use DateTimeZone;

/**
 * @group base
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    private $dataArray = [
        'user' => [
            'datetime' => '1955-02-24 06:00:00',
            'timezone' => '-08:00',
            'longitude' => -122.42,
            'latitude' => 37.77,
        ],
        'graha' => [
            'Sy' => ['longitude' => 311.956968, 'speed' => 1.0063896, 'rashi' => 11, 'degree' => 11.956968],
            'Ch' => ['longitude' => 336.7057373, 'speed' => 14.0983489, 'rashi' => 12, 'degree' => 6.7057373],
            'Ma' => ['longitude' => 5.4673084, 'speed' => 0.7021034, 'rashi' => 1, 'degree' => 5.4673084],
            'Bu' => ['longitude' => 291.1617028, 'speed' => -0.0963315, 'rashi' => 10, 'degree' => 21.1617028],
            'Gu' => ['longitude' => 87.3075743, 'speed' => -0.0647127, 'rashi' => 3, 'degree' => 27.3075743],
            'Sk' => ['longitude' => 267.3090162, 'speed' => 1.135481, 'rashi' => 9, 'degree' => 27.3090162],
            'Sa' => ['longitude' => 207.9228468, 'speed' => 0.008052, 'rashi' => 7, 'degree' => 27.9228468],
            'Ra' => ['longitude' => 249.2985488, 'speed' => -0.0529538, 'rashi' => 9, 'degree' => 9.2985488],
            'Ke' => ['longitude' => 69.2985488, 'speed' => -0.0529538, 'rashi' => 3, 'degree' => 9.2985488],
        ],
        'lagna' => [
            'Lg' => ['longitude' => 292.6509462, 'rashi' => 10, 'degree' => 22.6509462],
        ],
        'bhava' => [
            1 => ['longitude' => 292.6509462, 'rashi' => 10, 'degree' => 22.6509462],
            2 => ['longitude' => 322.6509462, 'rashi' => 11, 'degree' => 22.6509462],
            3 => ['longitude' => 352.6509462, 'rashi' => 12, 'degree' => 22.6509462],
            4 => ['longitude' => 22.6509462, 'rashi' => 1, 'degree' => 22.6509462],
            5 => ['longitude' => 52.6509462, 'rashi' => 2, 'degree' => 22.6509462],
            6 => ['longitude' => 82.6509462, 'rashi' => 3, 'degree' => 22.6509462],
            7 => ['longitude' => 112.6509462, 'rashi' => 4, 'degree' => 22.6509462],
            8 => ['longitude' => 142.6509462, 'rashi' => 5, 'degree' => 22.6509462],
            9 => ['longitude' => 172.6509462, 'rashi' => 6, 'degree' => 22.6509462],
            10 => ['longitude' => 202.6509462, 'rashi' => 7, 'degree' => 22.6509462],
            11 => ['longitude' => 232.6509462, 'rashi' => 8, 'degree' => 22.6509462],
            12 => ['longitude' => 262.6509462, 'rashi' => 9, 'degree' => 22.6509462],
        ]
    ];
    
    public function setUp()
    {
        parent::setUp();
        
        $DateTime = new DateTime;
        
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude')->andReturn('Lon 1');
        $Locality->shouldReceive('getLatitude')->andReturn('Lat 1');
        $Locality->shouldReceive('getAltitude')->andReturn('Alt 1');
        
        $Ganita = Mockery::mock('Jyotish\Ganita\Method\AbstractGanita');
        
        $this->Data = new Data($DateTime, $Locality, $Ganita);
    }
    
    public function tearDown()
    {
        $this->Data = null;
        Mockery::close();
    }
    
    /**
     * @covers Jyotish\Base\Data::__construct
     */
    public function testConstructor()
    {
        $DateTime = new DateTime;
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude');
        $Locality->shouldReceive('getLatitude');
        $Locality->shouldReceive('getAltitude');
        
        $Data1 = new Data();
        $this->assertNull($Data1->getDateTime());
        $this->assertNull($Data1->getLocality());
        
        $Data2 = new Data($DateTime, $Locality);
        $this->assertInstanceOf('DateTime', $Data2->getDateTime());
        $this->assertInstanceOf('Jyotish\Base\Locality', $Data2->getLocality());
    }
    
    /**
     * @covers Jyotish\Base\Data::listBlock
     */
    public function testListBlock()
    {
        $blocksExpected = ['bhava', 'graha', 'lagna'];
        $blocksActual = array_values(Data::listBlock('main'));
        $this->assertEquals($blocksExpected, $blocksActual);
        
        $blocksExpected = ['bhava', 'dasha', 'graha', 'kala', 'lagna', 'panchanga', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('worising'));
        $this->assertEquals($blocksExpected, $blocksActual);
        
        $blocksExpected = ['bhava', 'dasha', 'graha', 'kala', 'lagna', 'panchanga', 'rising', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('calc'));
        $this->assertEquals($blocksExpected, $blocksActual);
        
        $blocksExpected = Data::$block;
        $blocksActual = array_values(Data::listBlock('all'));
        $this->assertEquals($blocksExpected, $blocksActual);
    }
    
    /**
     * @covers Jyotish\Base\Data::createFromImport
     */
    public function testCreateFromImport()
    {
        $Source = Mockery::mock('Jyotish\Base\Import\ImportInterface');
        $Source->shouldReceive('getImportData')->andReturn($this->dataArray);
        
        $Data = Data::createFromImport($Source);
        
        $this->assertInstanceOf('DateTime', $Data->getDateTime());
        $DateTime = new DateTime($this->dataArray['user']['datetime'], new DateTimeZone($this->dataArray['user']['timezone']));
        $this->assertEquals($DateTime, $Data->getDateTime());
        
        $this->assertInstanceOf('Jyotish\Base\Locality', $Data->getLocality());
        $this->assertEquals($this->dataArray['user']['longitude'], $Data->getLocality()->getLongitude());
        $this->assertEquals($this->dataArray['user']['latitude'], $Data->getLocality()->getLatitude());
    }
    
    /**
     * @covers Jyotish\Base\Data::__toString
     * @depends testCreateFromImport
     */
    public function testToString()
    {
        $Source = Mockery::mock('Jyotish\Base\Import\ImportInterface');
        $dataArray = $this->dataArray;
        
        unset($dataArray['graha'], $dataArray['bhava'], $dataArray['lagna']);
        $Source->shouldReceive('getImportData')->andReturn($dataArray);
        $Data = Data::createFromImport($Source);
        $stringExpected = 
            '{"user":{'
                . '"datetime":"1955-02-24 06:00:00",'
                . '"timezone":"-08:00",'
                . '"longitude":-122.42,'
                . '"latitude":37.77,'
                . '"altitude":0'
            . '}}';
        $this->assertEquals($stringExpected, sprintf($Data));
    }

    /**
     * @covers Jyotish\Base\Data::getDateTime
     * @covers Jyotish\Base\Data::setDateTime
     */
    public function testDateTime()
    {
        $this->assertInstanceOf('DateTime', $this->Data->getDateTime());
        
        $DateTime1 = new DateTime('2015-01-01 20:00:50');
        $this->Data->setDateTime($DateTime1);
        $this->assertEquals($DateTime1, $this->Data->getDateTime());
        
        $DateTime2 = new DateTime('2015-01-01 21:30:00');
        $this->Data->setDateTime($DateTime2);
        $this->assertGreaterThan($DateTime1, $DateTime2);
    }
    
    /**
     * @covers Jyotish\Base\Data::getLocality
     * @covers Jyotish\Base\Data::setLocality
     */
    public function testLocality()
    {
        $this->assertInstanceOf('Jyotish\Base\Locality', $this->Data->getLocality());
        $this->assertEquals('Lon 1', $this->Data->getLocality()->getLongitude());
        
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude')->andReturn('Lon 2');
        $Locality->shouldReceive('getLatitude')->andReturn('Lat 2');
        $Locality->shouldReceive('getAltitude')->andReturn('Alt 2');
        $this->Data->setLocality($Locality);
        $this->assertInstanceOf('Jyotish\Base\Locality', $this->Data->getLocality());
        $this->assertEquals('Lon 2', $this->Data->getLocality()->getLongitude());
    }

    /**
     * @covers Jyotish\Base\Data::getData
     */
    public function testGetData()
    {
        $this->assertArrayHasKey('user', $this->Data->getData());
        
        foreach (['datetime', 'timezone', 'longitude', 'latitude', 'altitude'] as $value) {
            $this->assertArrayHasKey($value, $this->Data->getData()['user']);
        }
    }
    
    /**
     * @covers Jyotish\Base\Data::clearData
     * @depends testListBlock
     * @depends testGetData
     * @depends testCreateFromImport
     */
    public function testClearData()
    {
        $Source = Mockery::mock('Jyotish\Base\Import\ImportInterface');
        $Source->shouldReceive('getImportData')->andReturn($this->dataArray);
        
        $Data = Data::createFromImport($Source);
        $Data->clearData(['bhava']);
        $this->assertCount(3, $Data->getData());
        $this->assertArrayHasKey('user', $Data->getData());
        $this->assertArrayHasKey('graha', $Data->getData());
        $this->assertArrayHasKey('lagna', $Data->getData());
        
        $Data->clearData();
        $this->assertCount(1, $Data->getData());
        $this->assertArrayHasKey('user', $Data->getData());
    }
}
