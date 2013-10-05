<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

use Jyotish\Service\Utils;

/**
 * Class for rendering chakra as image.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Image extends AbstractRender implements \Jyotish\Draw\Renderer\ImageInterface {

	public function __construct($adapter) {
		parent::__construct($adapter);
	}

	protected function drawRashiLabel($leftOffset, $topOffset) {
		$chakraClass = 'Jyotish\Draw\Plot\Chakra\\' . $this->chakraStyle;
		$chakraObject = new $chakraClass();

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
		$chakraClass = 'Jyotish\Draw\Plot\Chakra\\' . $this->chakraStyle;
		$chakraObject = new $chakraClass();

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
			
			//$labelBox = imagettfbbox($labelGraha['fontSize'], 0, $labelGraha['fontName'], $label);
			//$labelWidth = $labelBox[2] - $labelBox[0];
			
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