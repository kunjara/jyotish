<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga\Type;

use Jyotish\Yoga\Type\YogaBase;
use Jyotish\Graha\Graha;
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
        
        $this->dataSource = require_once 'data/array-source.php';
    }
    
    /**
     * @covers Jyotish\Yoga\Type\YogaBase::hasMahapurusha
     * @expectedException InvalidArgumentException
     */
    public function testHasMahapurusha()
    {
        $YogaBase = new YogaBase();
        
        $Source = new ArraySource($this->dataSource['NativMahapurusha1']);
        $Data = Data::createFromImport($Source);
        $YogaBase->setData($Data);
        $this->assertFalse($YogaBase->hasMahapurusha('Ma'));
        $this->assertTrue($YogaBase->hasMahapurusha('Gu'));
        $this->assertTrue($YogaBase->hasMahapurusha('Sk'));
        $this->assertTrue($YogaBase->hasMahapurusha('Bu'));
        $this->assertFalse($YogaBase->hasMahapurusha('Sa'));
        
        $Source = new ArraySource($this->dataSource['NativMahapurusha2']);
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
