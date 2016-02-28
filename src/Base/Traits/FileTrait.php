<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Traits;

/**
 * DataTrait provides a file operations.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
trait FileTrait
{
    /**
     * The file pointer.
     * 
     * @var resource
     */
    private $fileHandle = null;
    
    /**
     * Open file.
     * 
     * @param string $filePath
     * @throws \Jyotish\Base\Exception\UnderflowException
     */
    public function fileOpen($filePath)
    {
        $this->fileHandle = fopen($filePath, 'rt');
        if (false === $this->fileHandle) {
            throw new \Jyotish\Base\Exception\UnderflowException("Unable to read file '{$filePath}'.");
        }
    }

    /**
     * Get lines from file.
     */
    public function getLines()
    {  
        if (false !== $this->fileHandle) {
            while ($line = fgets($this->fileHandle)) {          
                yield $line;
            }
            fclose($this->fileHandle);
        }
    }
}
