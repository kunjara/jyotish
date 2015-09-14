<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Tattva;

use Jyotish\Tattva\Karaka;

/**
 * @group tattva
 */
class KarakaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Tattva\Karaka::listKaraka
     */
    public function testListKaraka()
    {
        $list = Karaka::listKaraka('jaimini');
        $this->assertEquals([
            Karaka::KEY_ATMA => Karaka::NAME_ATMA,
            Karaka::KEY_AMATYA => Karaka::NAME_AMATYA,
            Karaka::KEY_BHRATRU => Karaka::NAME_BHRATRU,
            Karaka::KEY_MATRU => Karaka::NAME_MATRU,
            Karaka::KEY_PUTRA => Karaka::NAME_PUTRA,
            Karaka::KEY_GNATI => Karaka::NAME_GNATI,
            Karaka::KEY_DARA => Karaka::NAME_DARA,
        ], $list);
    }
}
