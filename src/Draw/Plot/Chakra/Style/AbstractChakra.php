<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Style;

use Jyotish\Base\Analysis;

/**
 * Class for generate Chakra.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractChakra
{
    use \Jyotish\Base\Traits\DataTrait;
    
    /**
     * North Indian style
     */
    const STYLE_NORTH = 'north';
    /**
     * South Indian style
     */
    const STYLE_SOUTH = 'south';
    /**
     * Eastern Indian Style
     */
    const STYLE_EAST = 'east';

    /**
     * List of styles.
     * 
     * @var array
     */
    public static $style = [
        self::STYLE_NORTH,
        self::STYLE_SOUTH,
        self::STYLE_EAST,
    ];
    
    /**
     * Analysis object.
     * 
     * @var \Jyotish\Base\Analysis
     */
    protected $Analysis = null;
    
    /**
     * Chakra graha.
     * 
     * @var string
     */
    protected $chakraGraha;
    
    /**
     * Chakra divider.
     * 
     * @var int
     */
    protected $chakraDivider;
    
    /**
     * Coordinates of chakra bhavas.
     * 
     * @var array
     */
    protected $bhavaPoints = [];
    
    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     */
    public function __construct(\Jyotish\Base\Data $Data)
    {
        $this->setData($Data);
        
        $this->Analysis = new Analysis($Data);
    }

    /**
     * Get bhava points.
     * 
     * @param int $size Size of chakra
     * @param int $leftOffset Left offset
     * @param int $topOffset Top offset
     * @return array
     */
    public function getBhavaPoints($size, $leftOffset = 0, $topOffset = 0)
    {
        $myPoints = [];
        foreach ($this->bhavaPoints as $bhavaKey => $bhavaPoints) {
            foreach ($bhavaPoints as $point => $value) {
                if ($value != 0) {
                    if ($point % 2) {
                        $myPoints[$bhavaKey][] = $value * round($size / $this->chakraDivider) + $topOffset;
                    } else {
                        $myPoints[$bhavaKey][] = $value * round($size / $this->chakraDivider) + $leftOffset;
                    }
                } else {
                    $myPoints[$bhavaKey][] = $point % 2 ? $topOffset : $leftOffset;
                }
            }
        }

        return $myPoints;
    }

    /**
     * Get rashi label points.
     */
    abstract public function getRashiLabelPoints(array $options);

    /**
     * Get body label points.
     */
    abstract public function getBodyLabelPoints(array $options);
}