<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Tattva;

use Jyotish\Tattva\Maha;

/**
 * @group tattva
 */
class MahaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jyotish\Tattva\Maha::listDisha
     */
    public function testListDisha()
    {
        $list = Maha::listDisha(2);
        $this->assertEquals([
            Maha::DISHA_URDHWA, 
            Maha::DISHA_ADHARA,
        ], $list);
        
        $list = Maha::listDisha(8);
        $this->assertEquals([
            Maha::DISHA_UTTARA,
            Maha::DISHA_ISHANYA,
            Maha::DISHA_PURVA,
            Maha::DISHA_AGNEYA,
            Maha::DISHA_DAKSHINA,
            Maha::DISHA_NAIRUTYA,
            Maha::DISHA_PASCHIMA,
            Maha::DISHA_VAYAVYA,
        ], $list);
    }
}
