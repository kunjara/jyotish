<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga\Type;

use Jyotish\Yoga\Type\Mahapurusha;
use Jyotish\Base\Data;
use Jyotish\Base\Import\ArraySource;

/**
 * @group yoga
 */
class MahapurushaTest extends \PHPUnit_Framework_TestCase
{
    private $dataSource;
    
    public function setUp()
    {
        parent::setUp();
        
        require 'data/array-source.php';
        $this->dataSource = $dataSource;
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasMahapurusha
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasRuchaka
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasHamsa
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasMalavya
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasBhadra
     * @covers Jyotish\Yoga\Type\Mahapurusha::hasShasha
     * @expectedException InvalidArgumentException
     */
    public function testHasMahapurusha()
    {
        $Mahapurusha = new Mahapurusha();
        
        $Source = new ArraySource($this->dataSource->NativMahapurusha1);
        $Data = Data::createFromImport($Source);
        $Mahapurusha->setData($Data);
        
        $this->assertFalse($Mahapurusha->hasMahapurusha('Ma'));
        $this->assertTrue($Mahapurusha->hasMahapurusha('Gu'));
        $this->assertTrue($Mahapurusha->hasMahapurusha('Sk'));
        $this->assertTrue($Mahapurusha->hasMahapurusha('Bu'));
        $this->assertFalse($Mahapurusha->hasMahapurusha('Sa'));
        
        $this->assertFalse($Mahapurusha->hasRuchaka());
        $this->assertTrue($Mahapurusha->hasHamsa());
        $this->assertTrue($Mahapurusha->hasMalavya());
        $this->assertTrue($Mahapurusha->hasBhadra());
        $this->assertFalse($Mahapurusha->hasShasha());
        
        $Source = new ArraySource($this->dataSource->NativMahapurusha2);
        $Data = Data::createFromImport($Source);
        $Mahapurusha->setData($Data);
        
        $this->assertTrue($Mahapurusha->hasMahapurusha('Ma'));
        $this->assertFalse($Mahapurusha->hasMahapurusha('Gu'));
        $this->assertFalse($Mahapurusha->hasMahapurusha('Sk'));
        $this->assertFalse($Mahapurusha->hasMahapurusha('Bu'));
        $this->assertTrue($Mahapurusha->hasMahapurusha('Sa'));
        
        $this->assertTrue($Mahapurusha->hasRuchaka());
        $this->assertFalse($Mahapurusha->hasHamsa());
        $this->assertFalse($Mahapurusha->hasMalavya());
        $this->assertFalse($Mahapurusha->hasBhadra());
        $this->assertTrue($Mahapurusha->hasShasha());
        
        // testing exception
        $this->assertTrue($Mahapurusha->hasMahapurusha('Sy'));
    }
}
