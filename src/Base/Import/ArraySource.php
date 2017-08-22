<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base\Import;

use Jyotish\Base\Data;
use Jyotish\Graha\Graha;
use Jyotish\Ganita\Math;

/**
 * The data in the array format for importing.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class ArraySource extends SourceBase
{
    /**
     * Data template.
     * 
     * @var array
     */
    private $dataTemplate = [
        Data::BLOCK_GRAHA => [
            'element' => ['longitude', 'speed']
        ],
        Data::BLOCK_LAGNA => [
            'element' => ['longitude']
        ],
        Data::BLOCK_UPAGRAHA => [
            'element' => ['longitude']
        ],
        Data::BLOCK_USER => [
            'gender'
        ],
    ];

    /**
     * Required data blocks.
     * 
     * @var array
     */
    private $dataRequired = [
        Data::BLOCK_GRAHA, 
        Data::BLOCK_LAGNA
    ];
    
    /**
     * A point taken as the lagna.
     * 
     * @var string
     */
    private $lagna = Graha::KEY_LG;
    
    /**
     * Constructor
     * 
     * @param array $importData
     * @param string $lagna
     * @throws \Jyotish\Base\Exception\InvalidArgumentException
     */
    public function __construct(array $importData, $lagna = Graha::KEY_LG)
    {
        $this->checkData($importData);
        
        foreach ($this->dataRequired as $block) {
            foreach ($this->importData[$block] as $key => $params) {
                if (!isset($params['rashi'])) {
                    $units = Math::partsToUnits($params['longitude']);
                    $this->importData[$block][$key]['rashi'] = $units['units'];
                    $this->importData[$block][$key]['degree'] = $units['parts'];
                }
            }
        }
        
        if (!isset($this->importData[Data::BLOCK_BHAVA]) || $this->lagna != $lagna) {
            if (array_key_exists($lagna, Graha::$graha)) {
                $block = Data::BLOCK_GRAHA;
            } elseif ($lagna == Graha::KEY_LG) {
                $block = Data::BLOCK_LAGNA;
            } elseif (array_key_exists($lagna, Bhava::$bhava)) {
                $block = Data::BLOCK_BHAVA;
            } else {
                throw new \Jyotish\Base\Exception\InvalidArgumentException("The value of lagna should be 'Lg', key of graha or bhava.");
            }
            
            $this->lagna = $lagna;
            
            $longitude = $this->importData[$block][$lagna]['longitude'];
            for ($b = 1; $b <= 12; $b++) {
                $this->importData[Data::BLOCK_BHAVA][$b]['longitude'] = $longitude <= 360 ? $longitude : $longitude - 360;
                $units = Math::partsToUnits($this->importData[Data::BLOCK_BHAVA][$b]['longitude']);
                $this->importData[Data::BLOCK_BHAVA][$b]['rashi'] = $units['units'];
                $this->importData[Data::BLOCK_BHAVA][$b]['degree'] = $units['parts'];
                $longitude += 30;
            }
        }
    }
    
    /**
     * Check importing data.
     * 
     * @param $importData Data set
     * @throws \Jyotish\Base\Exception\InvalidArgumentException
     */
    private function checkData($importData)
    {
        foreach ($this->dataRequired as $block) {
            if (!array_key_exists($block, $importData)) {
                throw new \Jyotish\Base\Exception\InvalidArgumentException("Block '$block' is not found in the data.");
            }
        }

        $checkBlock = function ($block, $importElements) {
            if ($block == Data::BLOCK_GRAHA) $elements = Graha::$graha;
            elseif ($block == Data::BLOCK_LAGNA) $elements = [Graha::KEY_LG => 'Lagna'];
            else $elements = [];

            foreach ($elements as $key => $name) {
                if (!isset($importElements[$key])) {
                    throw new \Jyotish\Base\Exception\InvalidArgumentException("Key '$key' in block '$block' is not found.");
                }

                foreach ($this->dataTemplate[$block]['element'] as $propName) {
                    if (!array_key_exists($propName, $importElements[$key])) {
                        throw new \Jyotish\Base\Exception\InvalidArgumentException("Property '$propName' in element '$key $block' is not found.");
                    }
                }
            }
        };

        foreach ($importData as $block => $importElements) {
            if (defined('Jyotish\Base\Data::BLOCK_' . strtoupper($block))) {
                $checkBlock($block, $importElements);
                $this->importData[$block] = $importElements;
            } else {
                continue;
            }
        }
    }
}
