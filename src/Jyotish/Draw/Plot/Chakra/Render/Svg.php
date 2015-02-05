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
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . $this->options['chakraStyle'];
        $chakraObject = new $chakraStyle();

        $rashiLabelPoints = $chakraObject->getRashiLabelPoints($this->data, $this->options);

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
        $chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . $this->options['chakraStyle'];
        $chakraObject = new $chakraStyle();

        $grahaLabelPoints = $chakraObject->getGrahaLabelPoints($this->data, $this->options);

        foreach ($grahaLabelPoints as $graha => $point) {
            $grahaLabel = $this->adapter->getGrahaLabel($graha, $this->data, [
                'labelGrahaType' => $this->options['labelGrahaType'], 
                'labelGrahaCallback' => $this->options['labelGrahaCallback']
            ]);

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