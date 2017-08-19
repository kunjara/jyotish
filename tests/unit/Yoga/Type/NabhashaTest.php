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
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasRajju());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasMusala
     */
    public function testHasMusala()
    {
        $Source = new ArraySource($this->dataSource->Musala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasMusala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasNala
     */
    public function testHasNala()
    {
        $Source = new ArraySource($this->dataSource->Nala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasNala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAshraya
     */
    public function testHasAshraya()
    {
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_ASHRAYA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $this->assertNotFalse($this->Nabhasha->hasAshraya($yoga));
        }
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasMala
     */
    public function testHasMala()
    {
        $Source = new ArraySource($this->dataSource->Mala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasMala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSarpa
     */
    public function testHasSarpa()
    {
        $Source = new ArraySource($this->dataSource->Sarpa);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasSarpa());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDala
     */
    public function testHasDala()
    {
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_DALA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $this->assertNotFalse($this->Nabhasha->hasDala($yoga));
        }
        
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasDala(Nabhasha::NAME_MALA));
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasGada
     */
    public function testHasGada()
    {
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasGada());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSanaha
     */
    public function testHasSanaha()
    {
        $Source = new ArraySource($this->dataSource->Sanaha);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasSanaha());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVibhuka
     */
    public function testHasVibhuka()
    {
        $Source = new ArraySource($this->dataSource->Vibhuka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasVibhuka());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDhuriya
     */
    public function testHasDhuriya()
    {
        $Source = new ArraySource($this->dataSource->Dhuriya);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasDhuriya());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSakata
     */
    public function testHasSakata()
    {
        $Source = new ArraySource($this->dataSource->Sakata);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasSakata());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVihaga
     */
    public function testHasVihaga()
    {
        $Source = new ArraySource($this->dataSource->Vihaga);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasVihaga());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasShringataka
     */
    public function testHasShringataka()
    {
        $Source = new ArraySource($this->dataSource->Shringataka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasShringataka());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasHala
     */
    public function testHasHala()
    {
        $Source = new ArraySource($this->dataSource->Hala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasHala());
        
        $Source = new ArraySource($this->dataSource->Shringataka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasHala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVajra
     */
    public function testHasVajra()
    {
        $Source = new ArraySource($this->dataSource->Vajra);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasVajra());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasYava
     */
    public function testHasYava()
    {
        $Source = new ArraySource($this->dataSource->Yava);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasYava());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAkriti
     */
    public function testHasAkriti()
    {
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_AKRITI) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $this->assertNotFalse($this->Nabhasha->hasAkriti($yoga));
        }
        
        $Source = new ArraySource($this->dataSource->Mala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasAkriti(Nabhasha::NAME_GADA));
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
            [Nabhasha::GROUP_ASHRAYA, [
                Nabhasha::NAME_RAJJU,
                Nabhasha::NAME_MUSALA,
                Nabhasha::NAME_NALA
            ]],
            [Nabhasha::GROUP_DALA, [
                Nabhasha::NAME_MALA,
                Nabhasha::NAME_SARPA
            ]],
            [Nabhasha::GROUP_AKRITI, [
                Nabhasha::NAME_GADA,
                Nabhasha::NAME_SANAHA,
                Nabhasha::NAME_VIBHUKA,
                Nabhasha::NAME_DHURIYA,
                Nabhasha::NAME_SAKATA,
                Nabhasha::NAME_VIHAGA,
                Nabhasha::NAME_SHRINGATAKA,
                Nabhasha::NAME_HALA,
                Nabhasha::NAME_VAJRA,
                Nabhasha::NAME_YAVA,
            ]],
            [null, Nabhasha::$yoga]
        ];
    }
}
