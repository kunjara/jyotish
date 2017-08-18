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
        $this->assertEquals([], $YogaBase->getOptions());
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
        $YogaBase->setDataInstance($Data);
        $this->assertNotFalse($YogaBase->hasParivarthana('Sy', 'Ch'));
        $this->assertNotFalse($YogaBase->hasParivarthana('Gu', 'Ma'));
        $this->assertNotFalse($YogaBase->hasParivarthana('Bu', 'Sk'));
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Sy'));
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Sa'));
        
        // testing exception
        $this->assertFalse($YogaBase->hasParivarthana('Gu', 'Gu'));
    }
}
