<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita;

use Jyotish\Ganita\Matrix\MatrixBase;

/**
 * Matrix class. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Matrix
{
    const TYPE_DEFAULT     = 'default';
    const TYPE_ROTATION    = 'rotation';
    const TYPE_TRANSLATION = 'translation';
    const TYPE_REFLECTION  = 'reflection';
    const TYPE_SCALING     = 'scaling';
    
    /**
     * List of matrix.
     * 
     * @var array
     */
    public static $type = [
        self::TYPE_DEFAULT,
        self::TYPE_ROTATION,
        self::TYPE_TRANSLATION,
        self::TYPE_REFLECTION,
        self::TYPE_SCALING,
    ];
    
    /**
     * Returns the requested instance of matrix class.
     * 
     * @params string $type The type of matrix
     * @params mixed $params List of arguments
     */
    public static function getInstance($type, ...$params)
    {
        $typeLower = strtolower($type);
        
        if (!in_array($typeLower, self::$type)) {
            throw new Exception\InvalidArgumentException("Matix '$typeLower' is not defined.");
        }
        
        if ($type == Matrix::TYPE_DEFAULT) {
            $matrixObject = new MatrixBase(...$params);
        } else {
            $matrixClass = 'Jyotish\Ganita\Matrix\\' . ucfirst($typeLower);
            $matrixObject = new $matrixClass(...$params);
        }

        return $matrixObject;
    }
}