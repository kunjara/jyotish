<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw\Plot\Chakra\Render;

use Jyotish\Draw\Plot\Chakra\Style\AbstractChakra;

/**
 * Abstract class for rendering Chakra.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
abstract class AbstractRender {

	protected $adapter = null;
	protected $chakraSize = 200;
	protected $chakraStyle = AbstractChakra::STYLE_NORTH;
	
	protected $offsetBorder = 4;
	protected $offsetLabel = 4;
	protected $widthOffsetLabel = 20;
	protected $heightOffsetLabel = 14;
	
	protected $labelGrahaType = 0;
	protected $labelGrahaCallback = null;

	public function __construct($adapter) {
		$this->adapter = $adapter;
	}

	public function setOptions($options) {
		foreach ($options as $key => $value) {
			if (is_array($value)) {
				//$this->adapter->setOptions($value);
			} else {
				$method = 'set' . $key;
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
		return $this;
	}

	public function setChakraSize($value) {
		if (!is_numeric($value) || intval($value) < 100) {
			throw new Exception\OutOfRangeException(
					'Chakra size must be greater than 100.'
			);
		}
		$this->chakraSize = intval($value);
		return $this;
	}

	public function setChakraStyle($value) {
		if (!in_array($value, AbstractChakra::$styles)) {
			throw new Exception\UnexpectedValueException(
					"Invalid chakra style provided must be 'north', 'south' or 'east'."
			);
		}
		$this->chakraStyle = $value;
		return $this;
	}

	public function setOffsetBorder($value) {
		if (!is_numeric($value) || intval($value) < 0) {
			throw new Exception\OutOfRangeException(
					'Border offset must be greater than or equals 0.'
			);
		}
		$this->offsetBorder = intval($value);
		return $this;
	}

	public function setOffsetLabel($value) {
		if (!is_numeric($value) || intval($value) < 0) {
			throw new Exception\OutOfRangeException(
					'Label offset must be greater than or equals 0.'
			);
		}
		$this->offsetLabel = intval($value);
		return $this;
	}
	
	public function setLabelGrahaType($value) {
		if (!in_array($value, array(0, 1, 2))) {
			throw new Exception\UnexpectedValueException(
					"Invalid label type provided must be 0, 1 or 2."
			);
		}
		$this->labelGrahaType = $value;
		return $this;
	}
	
	public function setLabelGrahaCallback($value) {
		if (!is_callable($value)) {
			throw new Exception\RuntimeException("Function $value not supported.");
		}
		$this->labelGrahaCallback = $value;
		return $this;
	}

	public function drawChakra($drawData, $leftOffset, $topOffset, $options) {
		$this->data = $drawData;
		
		$chakraStyle = 'Jyotish\Draw\Plot\Chakra\Style\\' . ucfirst(strtolower($this->chakraStyle));
		$bhavaPoints = $chakraStyle::getBhavaPoints($this->chakraSize, $leftOffset, $topOffset);

		foreach ($bhavaPoints as $points) {
			$this->adapter->drawPolygon($points);
		}

		if (isset($options['labelRashiFont']))
			$this->adapter->setOptions($options['labelRashiFont']);
		$this->drawRashiLabel($leftOffset, $topOffset);

		if (isset($options['labelGrahaFont']))
			$this->adapter->setOptions($options['labelGrahaFont']);
		$this->drawGrahaLabel($leftOffset, $topOffset);
	}
}