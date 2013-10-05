<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Draw;

use Jyotish\Graha\Graha;
use Jyotish\Service\Utils;

/**
 * Class of data for drawing.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Data {

	private $_sweData;
	private $_rashiInBhava = null;
	private $_grahaInBhava = null;
	private $_grahaInRashi = null;

	public function __construct(array $sweParams) {
		$this->_sweData = $sweParams;

		return $this;
	}

	public function getRashiInBhava() {
		if ($this->_rashiInBhava == null) {
			foreach ($this->_sweData['bhava'] as $bhava => $params) {
				$rashi = $params['rashi'];
				$this->_rashiInBhava[$rashi] = $bhava;
			}
		}
		return $this->_rashiInBhava;
	}

	public function getGrahaInBhava() {
		if ($this->_grahaInBhava == null) {
			foreach ($this->_sweData['graha'] as $graha => $params) {
				$rashi = $params['rashi'];

				if ($this->_rashiInBhava == null)
					$this->getRashiInBhava();

				$bhava = $this->_rashiInBhava[$rashi];
				$direction = $params['speed'] > 0 ? 1 : -1;

				$this->_grahaInBhava[$graha] = array(
					'bhava' => $bhava,
					'direction' => $direction,
				);
			}
		}
		return $this->_grahaInBhava;
	}

	public function getGrahaInRashi() {
		if ($this->_grahaInRashi == null) {
			foreach ($this->_sweData['graha'] as $graha => $params) {
				$rashi = $params['rashi'];
				$direction = $params['speed'] > 0 ? 1 : -1;

				$this->_grahaInRashi[$graha] = array(
					'rashi' => $rashi,
					'direction' => $direction,
				);
			}
			$this->_grahaInRashi[Graha::LAGNA]['rashi'] = $this->_sweData['extra']['Asc']['rashi'];
			$this->_grahaInRashi[Graha::LAGNA]['direction'] = 1;
		}
		return $this->_grahaInRashi;
	}

	public function getGrahaLabel($graha, $labelType = 0, $userFunction = null) {
		if (!is_null($this->_grahaInBhava))
			$grahas = $this->_grahaInBhava;
		else
			$grahas = $this->_grahaInRashi;

		switch ($labelType) {
			case 0:
				$label = $graha;
				break;
			case 1:
				if ($graha != Graha::LAGNA) {
					$grahaClass = 'Jyotish\Graha\Object\\' . $graha;
					$label = Utils::unicodeToHtml($grahaClass::$grahaUnicode);
				} else {
					$label = $graha;
				}
				break;
			case 2:
				$label = call_user_func($userFunction, $graha);
				break;
			default:
				$label = $graha;
				break;
		}

		if ($grahas[$graha]['direction'] == 1) {
			$grahaLabel = $label;
		} else {
			if ($graha == Graha::GRAHA_RA or $graha == Graha::GRAHA_KE) {
				$grahaLabel = $label;
			} else {
				$grahaLabel = '(' . $label . ')';
			}
		}
		return $grahaLabel;
	}

}