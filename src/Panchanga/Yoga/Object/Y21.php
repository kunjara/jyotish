<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Yoga\Object;

use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Class of yoga 21.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Y21 extends YogaObject
{
    /**
     * Yoga key
     * 
     * @var int
     */
    protected $yogaKey = 21;

    /**
     * Deva of yoga.
     * 
     * @var string
     */
    protected $yogaDeva = Deva::DEVA_HIRANYAGARBHA;
}