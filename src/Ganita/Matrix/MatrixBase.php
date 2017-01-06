<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Ganita\Matrix;

/**
 * Functions for Matrix transformations. 
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class MatrixBase
{
    /**
     * Matrix data
     * 
     * @var array
     */
    protected $matrix = [[]];

    public function __construct(array $source)
    {
        if (is_null($source) || $source == [[]]) {
            $this->reset();
        } else {
            $this->store($source);
        }
    }
    
     /**
     * Get the matrix as an Array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->matrix;
    }
    
    /**
     * Get dimension of matrix.
     * 
     * @param bool $toString
     * @param string $delimiter
     * @return array|string
     */
    public function getDimensions($toString = true, $delimiter = 'x')
    {
        $numRows = count($this->matrix);
        $numCols = count($this->matrix[0]);
        
        if (empty($this->matrix[0])) {
            $numRows = 0;
        }
        
        if ($toString) {
            return $numRows . $delimiter . $numCols;
        } else {
            return [
                'rows' => $numRows,
                'cols' => $numCols,
            ];
        }
    }
    
    /**
     * Add to the current matrix of another.
     * 
     * @param Matrix $matrix
     * @return Matrix
     * @throws Exception\RuntimeException
     */
    public function addMatrix(MatrixBase $matrix)
    {
        $dimensionsThis = $this->getDimensions();
        $dimensionsMatrix = $matrix->getDimensions();
        
        $result = [[]];
        if ($dimensionsThis != $dimensionsMatrix) {
            throw new \Jyotish\Ganita\Exception\RuntimeException("Dimensions of matrix is not equal.");
        } else {
            foreach ($this->matrix as $rowKey => $rowData) {
                foreach ($rowData as $colKey => $colValue) {
                    $result[$rowKey][$colKey] = $colValue + $matrix->toArray()[$rowKey][$colKey];
                }
            }
        }
        $this->store($result);
        
        return $this;
    }
    
    /**
     * Matrix-Numeric multiplication.
     * 
     * @param int|float $numeric
     * @return Matrix
     */
    public function multiNumeric($numeric)
    {
        $result = [[]];
        foreach ($this->matrix as $rowKey => $rowData) {
            foreach ($rowData as $colKey => $colValue) {
                $result[$rowKey][$colKey] = $colValue * $numeric;
            }
        }
        $this->store($result);
        
        return $this;
    }
    
    /**
     * Matrix-Matrix multiplication.
     * 
     * @param Matrix $matrix
     * @return Matrix
     */
    public function multiMatrix(MatrixBase $matrix)
    {
        $dimensionsThis = $this->getDimensions(false);
        $dimensionsMatrix = $matrix->getDimensions(false);
        
        $matrixArray = $matrix->toArray();
        
        if ($dimensionsThis['cols'] != $dimensionsMatrix['rows']) {
            throw new \Jyotish\Ganita\Exception\RuntimeException("Number of columns in first matrix is not equal to number of rows in second matrix.");
        } else {
            $result = [[]];
            foreach ($this->matrix as $rowKey => $rowData) {
                foreach ($rowData as $colKey => $colValue) {
                    $value = 0;
                    for ($i = 0; $i < $dimensionsThis['cols']; $i++) {
                        $value += $rowData[$i] * $matrixArray[$i][$colKey];
                    }
                    $result[$rowKey][$colKey] = $value;
                }
            }
        }
        $this->store($result);
        
        return $this;
    }

    /**
     * Reset the matrix data.
     * 
     * @return Matrix
     */
    protected function reset()
    {
        $this->matrix = [[]];
        
        return $this;
    }
    
    /**
     * Store the data.
     *
     * @param array $data
     * @return Matrix
     */
    protected function store(array $data)
    {
        $this->matrix = $data;
        
        return $this;
    }
    
    /**
     * Fill the matrix.
     * 
     * @param int $rows Number of rows
     * @param int $cols Number of columns
     * @param mixed $value Value to use for filling
     */
    protected function fill($rows, $cols, $value = 0)
    {
        $this->reset();
        
        $rowsArray = array_fill(0, $cols, $value);
        $resultArray = array_fill(0, $rows, $rowsArray);
        
        $this->store($resultArray);
    }
}