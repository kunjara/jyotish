<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Yoga\Type;

use Jyotish\Base\Data;
use Jyotish\Base\Import\ArraySource;
use Jyotish\Yoga\Type\Nabhasha;
use ReflectionMethod;

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
        $reflectionMethod = new ReflectionMethod($this->Nabhasha, 'hasAshraya');
        $reflectionMethod->setAccessible(true);
        
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_ASHRAYA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $result = $reflectionMethod->invoke($this->Nabhasha, $yoga);
            $this->assertNotFalse($result);
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
        $reflectionMethod = new ReflectionMethod($this->Nabhasha, 'hasDala');
        $reflectionMethod->setAccessible(true);
        
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_DALA) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $result = $reflectionMethod->invoke($this->Nabhasha, $yoga);
            $this->assertNotFalse($result);
        }
        
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $result = $reflectionMethod->invoke($this->Nabhasha, Nabhasha::NAME_MALA);
        $this->assertFalse($result);
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
     * @covers Jyotish\Yoga\Type\Nabhasha::hasKamala
     */
    public function testHasKamala()
    {
        $Source = new ArraySource($this->dataSource->Kamala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasKamala());
        
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasKamala());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVapi
     */
    public function testHasVapi()
    {
        $Source = new ArraySource($this->dataSource->Vapi);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasVapi());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasYupa
     */
    public function testHasYupa()
    {
        $Source = new ArraySource($this->dataSource->Yupa);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasYupa());
        
        $Source = new ArraySource($this->dataSource->Gada);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasYupa());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasIshu
     */
    public function testHasIshu()
    {
        $Source = new ArraySource($this->dataSource->Ishu);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasIshu());
        
        $Source = new ArraySource($this->dataSource->Sanaha);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasIshu());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasShakti
     */
    public function testHasShakti()
    {
        $Source = new ArraySource($this->dataSource->Shakti);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasShakti());
        
        $Source = new ArraySource($this->dataSource->Vibhuka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasShakti());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDanda
     */
    public function testHasDanda()
    {
        $Source = new ArraySource($this->dataSource->Danda);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasDanda());
        
        $Source = new ArraySource($this->dataSource->Dhuriya);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasDanda());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasNauka
     */
    public function testHasNauka()
    {
        $Source = new ArraySource($this->dataSource->Nauka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasNauka());
        
        $Source = new ArraySource($this->dataSource->Yupa);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasNauka());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasKuta
     */
    public function testHasKuta()
    {
        $Source = new ArraySource($this->dataSource->Kuta);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasKuta());
        
        $Source = new ArraySource($this->dataSource->Ishu);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasKuta());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasChhatra
     */
    public function testHasChhatra()
    {
        $Source = new ArraySource($this->dataSource->Chhatra);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasChhatra());
        
        $Source = new ArraySource($this->dataSource->Shakti);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasChhatra());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasChapa
     */
    public function testHasChapa()
    {
        $Source = new ArraySource($this->dataSource->Chapa);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasChapa());
        
        $Source = new ArraySource($this->dataSource->Danda);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasChapa());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasChakra
     */
    public function testHasChakra()
    {
        $Source = new ArraySource($this->dataSource->Chakra);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasChakra());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasSamudra
     */
    public function testHasSamudra()
    {
        $Source = new ArraySource($this->dataSource->Samudra);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasSamudra());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasAkriti
     */
    public function testHasAkriti()
    {
        $reflectionMethod = new ReflectionMethod($this->Nabhasha, 'hasAkriti');
        $reflectionMethod->setAccessible(true);
        
        foreach (Nabhasha::listYoga(Nabhasha::GROUP_AKRITI) as $yoga) {
            $Source = new ArraySource($this->dataSource->$yoga);
            $Data = Data::createFromImport($Source);
            $this->Nabhasha->setDataInstance($Data);
            $result = $reflectionMethod->invoke($this->Nabhasha, $yoga);
            $this->assertNotFalse($result);
        }
        
        $Source = new ArraySource($this->dataSource->Mala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $result = $reflectionMethod->invoke($this->Nabhasha, Nabhasha::NAME_GADA);
        $this->assertFalse($result);
        
        $Source = new ArraySource($this->dataSource->KamalaNo);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $result = $reflectionMethod->invoke($this->Nabhasha, Nabhasha::NAME_KAMALA);
        $this->assertFalse($result);
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasGola
     */
    public function testHasGola()
    {
        $Source = new ArraySource($this->dataSource->Gola);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasGola());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasYuga
     */
    public function testHasYuga()
    {
        $Source = new ArraySource($this->dataSource->Yuga);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasYuga());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasShoola
     */
    public function testHasShoola()
    {
        $Source = new ArraySource($this->dataSource->Shoola);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasShoola());
        
        $Source = new ArraySource($this->dataSource->Shringataka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasShoola());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasKedara
     */
    public function testHasKedara()
    {
        $Source = new ArraySource($this->dataSource->Kedara);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasKedara());
        
        $Source = new ArraySource($this->dataSource->Kamala);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasKedara());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasPasha
     */
    public function testHasPasha()
    {
        $Source = new ArraySource($this->dataSource->Pasha);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasPasha());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasDama
     */
    public function testHasDama()
    {
        $Source = new ArraySource($this->dataSource->Dama);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasDama());
        
        $Source = new ArraySource($this->dataSource->Chakra);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasDama());
    }
    
    /**
     * @covers Jyotish\Yoga\Type\Nabhasha::hasVeena
     */
    public function testHasVeena()
    {
        $Source = new ArraySource($this->dataSource->Veena);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertNotFalse($this->Nabhasha->hasVeena());
        
        $Source = new ArraySource($this->dataSource->Nauka);
        $Data = Data::createFromImport($Source);
        $this->Nabhasha->setDataInstance($Data);
        $this->assertFalse($this->Nabhasha->hasVeena());
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
                Nabhasha::NAME_KAMALA,
                Nabhasha::NAME_VAPI,
                Nabhasha::NAME_YUPA,
                Nabhasha::NAME_ISHU,
                Nabhasha::NAME_SHAKTI,
                Nabhasha::NAME_DANDA,
                Nabhasha::NAME_NAUKA,
                Nabhasha::NAME_KUTA,
                Nabhasha::NAME_CHHATRA,
                Nabhasha::NAME_CHAPA,
                Nabhasha::NAME_CHAKRA,
                Nabhasha::NAME_SAMUDRA,
            ]],
            [Nabhasha::GROUP_SANKHYA, [
                Nabhasha::NAME_GOLA,
                Nabhasha::NAME_YUGA,
                Nabhasha::NAME_SHOOLA,
                Nabhasha::NAME_KEDARA,
                Nabhasha::NAME_PASHA,
                Nabhasha::NAME_DAMA,
                Nabhasha::NAME_VEENA,
            ]],
            [null, Nabhasha::$yoga]
        ];
    }
}
