<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Import;

/**
 * Class for importing the data.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
interface ImportInterface
{
    /**
     * Get import data.
     * 
     * @return array Array block data
     */
    public function getImportData();
}
