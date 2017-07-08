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
        $this->Nabhasha = new Nabhasha();
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasRajju
     */
    public function testHasRajju()
    {
        $Source = new ArraySource($this->dataSource->Rajju);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasRajju()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasMusala
     */
    public function testHasMusala()
    {
        $Source = new ArraySource($this->dataSource->Musala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasMusala()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasNala
     */
    public function testHasNala()
    {
        $Source = new ArraySource($this->dataSource->Nala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasNala()[0]);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAshraya
     */
    public function testHasAshraya()
    {
        foreach (Nabhasha::listYoga(Nabhasha::SUBTYPE_ASHRAYA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setData($Data);
            $this->assertNotFalse($this->Nabhasha->hasAshraya($yoga)[0]);
        }
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasMala
     */
    public function testHasMala()
    {
        $Source = new ArraySource($this->dataSource->Mala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasMala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSarpa
     */
    public function testHasSarpa()
    {
        $Source = new ArraySource($this->dataSource->Sarpa);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasSarpa());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDala
     */
    public function testHasDala()
    {
        foreach (Nabhasha::listYoga(Nabhasha::SUBTYPE_DALA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setData($Data);
            $this->assertNotFalse($this->Nabhasha->hasDala($yoga)[0]);
        }
        $Source = new ArraySource($this->dataSource->NoDala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertFalse($this->Nabhasha->hasDala(Nabhasha::NAME_MALA));
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasGada
     */
    public function testHasGada()
    {
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasGada());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSanaha
     */
    public function testHasSanaha()
    {
        $Source = new ArraySource($this->dataSource->Sanaha);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasSanaha());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVibhuka
     */
    public function testHasVibhuka()
    {
        $Source = new ArraySource($this->dataSource->Vibhuka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasVibhuka());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDhuriya
     */
    public function testHasDhuriya()
    {
        $Source = new ArraySource($this->dataSource->Dhuriya);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setData($Data);
        $this->assertNotFalse($this->Nabhasha->hasDhuriya());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAkriti
     */
    public function testHasAkriti()
    {
        foreach (Nabhasha::listYoga(Nabhasha::SUBTYPE_AKRITI) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setData($Data);
            $this->assertNotFalse($this->Nabhasha->hasAkriti($yoga)[0]);
        }
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::listYoga
     * @dataProvider providerListYoga
     */
    public function testListYoga($option, $listYogaExpected)
    {
        $listYogaActual = Nabhasha::listYoga($option, $listYogaExpected);
        $this->assertEquals($listYogaExpected, $listYogaActual);
    }
    
    public function providerListYoga()
    {
        return [
            [Nabhasha::SUBTYPE_ASHRAYA, [
                Nabhasha::NAME_RAJJU,
                Nabhasha::NAME_MUSALA,
                Nabhasha::NAME_NALA
            ]],
            [Nabhasha::SUBTYPE_DALA, [
                Nabhasha::NAME_MALA,
                Nabhasha::NAME_SARPA
            ]],
            [Nabhasha::SUBTYPE_AKRITI, [
                Nabhasha::NAME_GADA,
                Nabhasha::NAME_SANAHA,
                Nabhasha::NAME_VIBHUKA,
                Nabhasha::NAME_DHURIYA,
            ]],
            [null, Nabhasha::$yoga]
        ];
    }
}
