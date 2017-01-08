<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Matrix;

/**
 * Reflection matrix. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Reflection extends \Jyotish\Ganita\Matrix\MatrixBase
{
    /**
     * Constructor
     * 
     * @param float $xCoord
     * @param float $yCoord
     */
    public function __construct($xCoord = false, $yCoord = false)
    {
        $this->fill(3, 3, 0);
        
        $this->matrix[1][1] = $xCoord ? -1 : 1;
        $this->matrix[0][0] = $yCoord ? -1 : 1;
        $this->matrix[2][2] = 1;
    }
}
