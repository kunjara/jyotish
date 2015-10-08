<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Varga\Object;

/**
 * Class of varga D1.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class D1 extends AbstractVarga
{
    /**
     * Key of the varga.
     * 
     * @var string
     */
    protected $vargaKey = 'D1';

    /**
     * Names of the varga.
     * 
     * @var array
     */
    protected $vargaNames = [
        'Rashi',
    ];

    /**
     * The number of parts.
     * 
     * @var int
     */
    protected $vargaAmsha = 1;

    /**
     * Get varga rashi.
     * 
     * @param array $ganitaRashi
     * @return array
     */
    protected function getVargaRashi(array $ganitaRashi)
    {
        return $ganitaRashi;
    }
}