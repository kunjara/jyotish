<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga\Type;

use Jyotish\Yoga\Type\YogaBase;
use Jyotish\Base\Data;
use Jyotish\Base\Import\ArraySource;

/**
 * @group yoga
 */
class YogaBaseTest extends \PHPUnit_Framework_TestCase
{
    private $dataSource;
    
    public function setUp()
    {
        parent::setUp();
        
        require 'data/array-source.php';
        $this->dataSource = $dataSource;
    }
    
    /**
     * @covers Jyotish\Yoga\Type\YogaBase::__construct
     */
    public function testConstructor()
    {
        $YogaBase = new YogaBase([
            'outputAmple' => true,
            'optionOutputAmple' => false,
            'someOption' => 'someValue',
        ]);
        $this->assertEquals(['outputAmple' => true], $YogaBase->getOptions());
    }

    /**
     * @covers Jyotish\Yoga\Type\YogaBase::hasParivarthana
     * @expectedException InvalidArgumentException
     */
    public function testHasParivarthana()
    {
        $Source = new ArraySource($this->dataSource->NativParivarthana1);
        $Data = Data::createFromImport($Source);
        
        $YogaBase = new YogaBase();
        $YogaBase->setData($Data);
        $this->assertTrue($YogaBase->hasParivarthana('Sy', 'Ch'));
        $this->assertTrue($YogaBase->hasParivarthana('Gu', 'Ma'));
        $this->assertTrue($YogaBase->hasParivarthana('Bu', 'Sk'));
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Sy'));
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Sa'));
        
        $YogaBase = new YogaBase([
            'outputAmple' => true,
        ]);
        $YogaBase->setData($Data);
        $this->assertEquals('maha', $YogaBase->hasParivarthana('Sy', 'Ch'));
        $this->assertEquals('dainya', $YogaBase->hasParivarthana('Gu', 'Ma'));
        $this->assertEquals('khala', $YogaBase->hasParivarthana('Bu', 'Sk'));
        $this->assertFalse($YogaBase->hasParivarthana('Sy', 'Ma'));
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Bu'));
        
        // testing exception
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Gu'));
    }
    
    /**
     * @covers Jyotish\Yoga\Type\YogaBase::hasMahapurusha
     * @expectedException InvalidArgumentException
     */
    public function testHasMahapurusha()
    {
        $YogaBase = new YogaBase();
        
        $Source = new ArraySource($this->dataSource->NativMahapurusha1);
        $Data = Data::createFromImport($Source);
        $YogaBase->setData($Data);
        $this->assertFalse($YogaBase->hasMahapurusha('Ma'));
        $this->assertTrue($YogaBase->hasMahapurusha('Gu'));
        $this->assertTrue($YogaBase->hasMahapurusha('Sk'));
        $this->assertTrue($YogaBase->hasMahapurusha('Bu'));
        $this->assertFalse($YogaBase->hasMahapurusha('Sa'));
        
        $Source = new ArraySource($this->dataSource->NativMahapurusha2);
        $Data = Data::createFromImport($Source);
        $YogaBase->setData($Data);
        $this->assertTrue($YogaBase->hasMahapurusha('Ma'));
        $this->assertFalse($YogaBase->hasMahapurusha('Gu'));
        $this->assertFalse($YogaBase->hasMahapurusha('Sk'));
        $this->assertFalse($YogaBase->hasMahapurusha('Bu'));
        $this->assertTrue($YogaBase->hasMahapurusha('Sa'));
        
        // testing exception
        $this->assertTrue($YogaBase->hasMahapurusha('Sy'));
    }
}
