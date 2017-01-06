<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Matrix;

/**
 * Rotation matrix. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Rotation extends \Jyotish\Ganita\Matrix\MatrixBase
{
    /**
     * Constructor
     * 
     * @param float $angle Angle of rotation
     */
    public function __construct($angle = 0)
    {
        $this->fill(3, 3, 0);
        
        $this->matrix[0][0] = cos($angle);
        $this->matrix[0][1] = sin($angle);
        $this->matrix[1][0] = -sin($angle);
        $this->matrix[1][1] = cos($angle);
        $this->matrix[2][2] = 1;
    }
}
