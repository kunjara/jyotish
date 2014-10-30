<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

/**
 * Class for rendering chakra as svg.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Svg extends AbstractRender implements \Jyotish\Draw\Renderer\SvgInterface {

    public function __construct($adapter) {
        parent::__construct($adapter);
    }

    protected function drawRashiLabel($leftOffset, $topOffset) {
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . $this->chakraStyle;
        $chakraObject = new $chakraStyle();

        $rashiLabelPoints = $chakraObject->getRashiLabelPoints(
                $this->chakraSize, 
                array(
                    'offsetBorder' => $this->offsetBorder,
                ), $this->data
        );

        foreach ($rashiLabelPoints as $rashi => $point) {
            $this->adapter->drawText(
                    $rashi, 
                    $point['x'] + $leftOffset, 
                    $point['y'] + $topOffset, 
                    array(
                        'align' => $point['align'], 
                        'valign' => $point['valign'],
                    )
            );
        }
    }

    protected function drawGrahaLabel($leftOffset, $topOffset) {
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . $this->chakraStyle;
        $chakraObject = new $chakraStyle();

        $grahaLabelPoints = $chakraObject->getGrahaLabelPoints(
                $this->chakraSize, 
                array(
                    'offsetBorder' => $this->offsetBorder,
                    'widthOffsetLabel' => $this->widthOffsetLabel,
                    'heightOffsetLabel' => $this->heightOffsetLabel,
                ), $this->data
        );

        foreach ($grahaLabelPoints as $graha => $point) {
            $grahaLabel = $this->data->getGrahaLabel($graha, $this->labelGrahaType, $this->labelGrahaCallback);

            $this->adapter->drawText(
                    $grahaLabel, 
                    $point['x'] + $leftOffset,
                    $point['y'] + $topOffset, 
                    array(
                        'align' => $point['align'],
                        'valign' => $point['valign'],
                    )
            );
        }
    }
}