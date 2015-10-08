<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Alphabet;

use ReflectionMethod;

/**
 * @group alphabet
 */
class LanguageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Alphabet\Language::trToHtml
     * @dataProvider providerTrToHtml
     */
    public function testTrToHtml($language, $translit, $html)
    {
        $class = 'Jyotish\Alphabet\\'.$language;
        $reflectionMethod = new ReflectionMethod($class, 'trToHtml');
        $reflectionMethod->setAccessible(true);
        
        $htmlActual = $reflectionMethod->invokeArgs(null, [$translit]);
        $this->assertEquals($html, $htmlActual);
    }
    
    public function providerTrToHtml()
    {
        return [
            ['Greek', 'alpha', '&#x03B1;'],
            ['Greek', ' ', ' '],
            ['Greek', '-', '-'],
            ['Greek', '', ''],
            ['Devanagari', 'ra', '&#x0930;'],
        ];
    }
    
    /**
     * @covers Jyotish\Alphabet\Language::trToHtml
     * @expectedException InvalidArgumentException
     */
    public function testTrToHtmlException()
    {
        $classGreek = 'Jyotish\Alphabet\Greek';
        $reflectionMethod = new ReflectionMethod($classGreek, 'trToHtml');
        $reflectionMethod->setAccessible(true);
        
        $htmlActual = $reflectionMethod->invokeArgs(null, ['alph']);
        $this->assertEquals('&#x03B1;', $htmlActual);
    }
    
    /**
     * @covers Jyotish\Alphabet\Language::translitToHtml
     * @depends testTrToHtml
     * @dataProvider providerTranslitToHtml
     */
    public function testTranslitToHtml($language, $translit, $html)
    {
        $class = 'Jyotish\Alphabet\\'.$language;
        
        $htmlActual = $class::translitToHtml($translit);
        $this->assertEquals($html, $htmlActual);
    }
    
    public function providerTranslitToHtml()
    {
        return [
            ['Greek', 'alpha', '&#x03B1;'],
            ['Greek', ['alpha', '', 'beta'], '&#x03B1;&#x03B2;'],
            ['Greek', ['alpha', ' ', 'beta'], '&#x03B1; &#x03B2;'],
            ['Devanagari', ['ra','aa','sha','i'], '&#x0930;&#x093E;&#x0936;&#x093F;'],
        ];
    }
}
