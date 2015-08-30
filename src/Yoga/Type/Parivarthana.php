<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Yoga;
use Jyotish\Graha\Graha;

/**
 * Parivarthana yoga class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Parivarthana extends YogaBase
{
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_PARIVARTHANA;
    
    /**
     * Constructor
     * 
     * @param null|array $options Options to set (optional)
     */
    public function __construct(array $options = null) {
        parent::__construct($options);
    }
    
    /**
     * Generate list of Parivarthana yogas.
     * 
     * @return \Iterator
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 32.
     */
    public function generateYoga()
    {
        $saptaGraha = Graha::listGraha(Graha::LIST_SAPTA);
        
        foreach ($saptaGraha as $key1 => $name1) {
            $grahaChecked[] = $key1;
            
            foreach ($saptaGraha as $key2 => $name2) {
                if (in_array($key2, $grahaChecked)) {
                    continue;
                }
                
                if ($subtype = $this->hasParivarthana($key1, $key2)) {
                    $result = [
                        'graha1' => $key1,
                        'graha2' => $key2,
                    ];
                    
                    if ($this->options['outputAmple']) {
                        $result = array_merge($result, ['subtype' => $subtype,]);
                    }
                    
                    yield $result;
                }
            }
        }
    }
}
