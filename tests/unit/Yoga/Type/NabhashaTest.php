<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga\Type;

use Jyotish\Base\Data;
use Jyotish\Base\Import\ArraySource;
use Jyotish\Yoga\Type\Nabhasha;

/**
 * @group yoga
 */
class NabhashaTest extends \PHPUnit_Framework_TestCase
{
    private $dataSource;
    
    public function setUp()
    {
        parent::setUp();
        
        require 'data/array-nabhasha.php';
        $this->dataSource = $dataSource;
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasRajju
     */
    public function testHasRajju()
    {
        $Nabhasha = new Nabhasha();
        
        $Source = new ArraySource($this->dataSource->Rajju);
        $Data = Data::createFromImport($Source);
        $Nabhasha->setData($Data);
        $this->assertNotFalse($Nabhasha->hasRajju()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasMusala
     */
    public function testHasMusala()
    {
        $Nabhasha = new Nabhasha();
        
        $Source = new ArraySource($this->dataSource->Musala);
        $Data = Data::createFromImport($Source);
        $Nabhasha->setData($Data);
        $this->assertNotFalse($Nabhasha->hasMusala()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasNala
     */
    public function testHasNala()
    {
        $Nabhasha = new Nabhasha();
        
        $Source = new ArraySource($this->dataSource->Nala);
        $Data = Data::createFromImport($Source);
        $Nabhasha->setData($Data);
        $this->assertNotFalse($Nabhasha->hasNala()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAshraya
     */
    public function testHasAshraya()
    {
        $Nabhasha = new Nabhasha();
        
        foreach ($Nabhasha->listYoga(Nabhasha::SUBTYPE_ASHRAYA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $Nabhasha->setData($Data);
            $this->assertNotFalse($Nabhasha->hasAshraya($yoga)[0]);
        }
    }
}
