<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base\Import;

use Jyotish\Base\Import\ArraySource;

/**
 * @group import
 */
class ArraySourceTest extends \PHPUnit_Framework_TestCase
{
    private $dataSource;
    private $dataExpected;

    public function setUp()
    {
        parent::setUp();
        
        $this->dataSource = require_once 'data/array/array-source.php';
        $this->dataExpected = require_once 'data/array/data-expected.php';
    }
    
    /**
     * @covers Jyotish\Base\Import\ArraySource::__construct
     * @covers Jyotish\Base\Import\ArraySource::getImportData
     */
    public function testGetImportData() {
        foreach ($this->dataSource as $name => $data) {
            $Source = new ArraySource($this->dataSource[$name]);
            $dataActual = $Source->getImportData();
            $this->assertEquals($this->dataExpected[$name], $dataActual);
        }
        
        $Source = new ArraySource($this->dataSource['Nativ1'], 'Sy');
        $dataActual = $Source->getImportData();
        $this->assertEquals($this->dataExpected['Nativ1-Sy'], $dataActual);
        
        $Source = new ArraySource($this->dataSource['Nativ1'], 'Ch');
        $dataActual = $Source->getImportData();
        $this->assertEquals($this->dataExpected['Nativ1-Ch'], $dataActual);
    }
}
