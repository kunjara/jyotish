<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Matrix;

/**
 * Translation matrix. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Translation extends \Jyotish\Ganita\Matrix\MatrixBase
{
    /**
     * Constructor
     * 
     * @param float $x Offset x axis
     * @param float $y Offset y axis
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->fill(3, 3, 0);
        
        $this->matrix[0][0] = 1;
        $this->matrix[1][1] = 1;
        $this->matrix[2][0] = $x;
        $this->matrix[2][1] = $y;
        $this->matrix[2][2] = 1;
    }
}
