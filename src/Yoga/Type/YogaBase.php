<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Yoga\Type;

use Jyotish\Yoga\Type\Parivarthana;
use Jyotish\Graha\Graha;
use Jyotish\Bhava\Bhava;

/**
 * Base class for yoga combinations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class YogaBase
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Type of yogas.
     * 
     * @var string
     */
    protected $yogaType = null;
    
    /**
     * List of combinations.
     * 
     * @var array
     */
    public static $yoga = [];

    /**
     * Constructor
     * 
     * @param null|array $options Options to set (optional)
     */
    public function __construct(array $options = null)
    {
        $this->setOptions($options);
    }
    
    /**
     * Is there Parivarthana yoga.
     * 
     * @param string $graha1 Key of graha
     * @param string $graha2 Key of graha
     * @return bool|array
     * @throws Exception\InvalidArgumentException
     * @see Mantreswara. Phaladeepika. Chapter 6, Verse 32.
     */
    public function hasParivarthana($graha1, $graha2)
    {
        if ($graha1 == $graha2) {
            throw new \Jyotish\Yoga\Exception\InvalidArgumentException("Graha keys should be different.");
        }
        $Graha1 = Graha::getInstance($graha1);
        $Graha2 = Graha::getInstance($graha2);
        foreach ($Graha1->grahaSwa as $key => $data) {
            $rashi1Swa[] = $data['rashi'];
        }
        foreach ($Graha2->grahaSwa as $key => $data) {
            $rashi2Swa[] = $data['rashi'];
        }
        
        if (
            in_array($this->getData()['graha'][$graha1]['rashi'], $rashi2Swa)
            && in_array($this->getData()['graha'][$graha2]['rashi'], $rashi1Swa)
        ) {
            $Graha1->setEnvironment($this->Data);
            $Graha2->setEnvironment($this->Data);
            $graha1Bhava = $Graha1->getBhava();
            $graha2Bhava = $Graha2->getBhava();

            if (in_array($graha1Bhava, Bhava::$bhavaDusthana) || in_array($graha2Bhava, Bhava::$bhavaDusthana)) {
                $group = Parivarthana::GROUP_DAINYA;
            } elseif ($graha1Bhava == 3 || $graha2Bhava == 3) {
                $group = Parivarthana::GROUP_KHALA;
            } else {
                $group = Parivarthana::GROUP_MAHA;
            }
            $yogaData = $this->assignYoga('', $group, ['graha1' => $graha1, 'graha2' => $graha2]);
            return $yogaData;
        } else {
            return false;
        }
    }
    
    /**
     * Gnerate list of present yogas.
     * 
     * @return \Iterator
     */
    public function generateYoga()
    {
        foreach (static::$yoga as $combination) {
            $hasYoga = 'has' . $combination;
            $yogaData = $this->$hasYoga();
            
            if (is_array($yogaData)) {
                //yield from $yogaData;
                foreach ($yogaData as $yogaDataOne) {
                    yield $yogaDataOne;
                }
            } elseif ($yogaData) {
                $yogaData = $this->assignYoga('', '', ['combination' => $combination]);
                yield $yogaData;
            }
        }
    }
    
    /**
     * Assign yoga data.
     * 
     * @param string $name Yoga name
     * @param string $group Group of yoga
     * @param array $details Details of yoga
     * @return array
     */
    protected function assignYoga($name, $group, array $details = [])
    {
        $yogaData = [
            'name' => $name,
            'group' => $group,
            'details' => $details,
        ];
        return $yogaData;
    }
}