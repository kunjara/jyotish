<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw;

/**
 * Class for drawing.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Draw {

	protected $adapter = null;
	protected $adapterNamespace = 'Jyotish\Draw\Renderer\\';
	protected $adapterObject;

	public function __construct($width, $height, $adapter = 'image') {
		if (!in_array(strtolower($adapter), array('image', 'svg'))) {
			throw new Exception\UnexpectedValueException(
					"Invalid renderer provided must be 'image' or 'svg'."
			);
		}

		$this->adapter = ucwords(strtolower($adapter));
		$adapterName = $this->adapterNamespace . $this->adapter;
		$this->adapterObject = new $adapterName($width, $height);
	}

	public function setOptions($options) {
		$this->adapterObject->setOptions($options);
	}
	
	public function drawText($text, $x, $y, $options = array()) {
		$this->adapterObject->drawText($text, $x, $y, $options);
	}

	public function drawChakra(\Jyotish\Draw\Data $drawData, $topOffset = 0, $leftOffset = 0, $options = array()) {
		$chakraAdapterName = 'Jyotish\Draw\Plot\Chakra\Render\\' . $this->adapter;
		$chakraAdapterObject = new $chakraAdapterName($this->adapterObject);

		$chakraAdapterObject->setOptions($options);
		$chakraAdapterObject->drawChakra($drawData, $topOffset, $leftOffset, $options);
	}

	public function render() {
		$this->adapterObject->render();
	}

}