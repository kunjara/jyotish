<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Ganita;

use Jyotish\Ganita\Matrix;
use Jyotish\Ganita\Matrix\Rotation;
use Jyotish\Ganita\Matrix\Translation;
use Jyotish\Ganita\Matrix\Reflection;

/**
 * @group ganita
 */
class MatrixTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Ganita\Matrix::getInstance
     * @expectedException InvalidArgumentException
     */
    public function testGetInstance()
    {
        $Matrix = Matrix::getInstance('rotation', M_PI_2);
        $Rotation = new Rotation(M_PI_2);
        $this->assertInstanceOf('\Jyotish\Ganita\Matrix\Rotation', $Matrix);
        $this->assertEquals($Rotation, $Matrix);
        
        $Matrix = Matrix::getInstance('Translation', 12, 12);
        $Translation = new Translation(12, 12);
        $this->assertInstanceOf('\Jyotish\Ganita\Matrix\Translation', $Matrix);
        $this->assertEquals($Translation, $Matrix);
        
        $Matrix = Matrix::getInstance(Matrix::TYPE_REFLECTION, true, false);
        $Reflection = new Reflection(true, false);
        $this->assertInstanceOf('\Jyotish\Ganita\Matrix\Reflection', $Matrix);
        $this->assertEquals($Reflection, $Matrix);
        
        $Matrix = Matrix::getInstance(Matrix::TYPE_ROTATION);
        $Rotation = new Rotation();
        $this->assertInstanceOf('\Jyotish\Ganita\Matrix\Rotation', $Matrix);
        $this->assertEquals($Rotation, $Matrix);
        
         // testing exception
        $Matrix = Matrix::getInstance('propulsion');
    }
}
