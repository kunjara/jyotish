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
class Parivarthana extends YogaBase {
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = Yoga::TYPE_PARIVARTHANA;
    
    /**
     * Constructor
     */
    public function __construct($data) {
        parent::__construct($data);
    }
    
    /**
     * Generate list of Parivarthana yogas.
     * 
     * @return array
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 32.
     */
    public function generateYoga()
    {
        $saptaGraha = Graha::grahaList(Graha::LIST_SAPTA);
        
        foreach ($saptaGraha as $key1 => $name1){
            $grahaChecked[] = $key1;
            
            foreach ($saptaGraha as $key2 => $name2){
                if(in_array($key2, $grahaChecked)){
                    continue;
                }
                
                if($this->hasParivarthana($key1, $key2)){
                    yield [
                        'graha1' => $key1,
                        'graha2' => $key2,
                    ];
                }
            }
        }
    }
}
