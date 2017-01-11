<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Matrix;

/**
 * Scaling matrix. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Scaling extends \Jyotish\Ganita\Matrix\MatrixBase
{
    /**
     * Constructor
     * 
     * @param float $xScale
     * @param float $yScale
     */
    public function __construct($xScale = false, $yScale = false)
    {
        if ($xScale <= 0 || $yScale <= 0) {
            throw new \Jyotish\Ganita\Exception\InvalidArgumentException("Scaling factor must be greater than zero.");
        }
        
        $this->fill(3, 3, 0);
        
        $this->matrix[0][0] = $xScale;
        $this->matrix[1][1] = $yScale;
        $this->matrix[2][2] = 1;
    }
}
