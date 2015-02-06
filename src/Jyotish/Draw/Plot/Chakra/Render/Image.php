<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

/**
 * Class for rendering chakra as image.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Image extends AbstractRender implements \Jyotish\Draw\Renderer\ImageInterface {
    /**
     * Constructor
     * 
     * @param Image $adapterObject
     */
    public function __construct($adapterObject) {
        parent::__construct($adapterObject);
    }

    protected function drawRashiLabel($x, $y) {
        $rashiLabelPoints = $this->chakraObject->getRashiLabelPoints($this->dataObject, $this->options);

        foreach ($rashiLabelPoints as $rashi => $point) {
             $this->adapterObject->drawText(
                    $rashi, 
                    $point['x'] + $x, 
                    $point['y'] + $y, 
                    array(
                        'align' => $point['align'], 
                        'valign' => $point['valign'],
                    )
            );
        }
    }

    protected function drawGrahaLabel($x, $y) {
        $grahaLabelPoints = $this->chakraObject->getGrahaLabelPoints($this->dataObject, $this->options);

        foreach ($grahaLabelPoints as $graha => $point) {
            $grahaLabel =  $this->adapterObject->getGrahaLabel($graha, $this->dataObject, [
                'labelGrahaType' => $this->options['labelGrahaType'], 
                'labelGrahaCallback' => $this->options['labelGrahaCallback']
            ]);

            //$labelBox = imagettfbbox($labelGraha['fontSize'], 0, $labelGraha['fontName'], $label);
            //$labelWidth = $labelBox[2] - $labelBox[0];

             $this->adapterObject->drawText(
                    $grahaLabel, 
                    $point['x'] + $x,
                    $point['y'] + $y, 
                    array(
                        'align' => $point['align'],
                        'valign' => $point['valign'],
                    )
            );
        }
    }
}