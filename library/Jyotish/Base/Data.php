<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Graha\Graha;
use Jyotish\Service\Utils;

/**
 * Data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Data {
	/**
	 * Ganita data.
	 * 
	 * @var array
	 */
	protected $ganitaData;
	
	/**
	 * Array with values ​​of the rashis in the bhavas.
	 * 
	 * @var array
	 */
	protected $rashiInBhava = null;
	
	/**
	 * Array with values ​​of the grahas in the bhavas.
	 * 
	 * @var array
	 */
	protected $grahaInBhava = null;
	
	/**
	 * Array with values ​​of the grahas in the rashis.
	 * 
	 * @var array
	 */
	protected $grahaInRashi = null;

	public function __construct(array $ganitaData) {
		$this->ganitaData = $ganitaData;

		return $this;
	}

	/**
	 * Get rashi in bhava.
	 * 
	 * @return array
	 */
	public function getRashiInBhava() {
		if ($this->rashiInBhava == null) {
			foreach ($this->ganitaData['bhava'] as $bhava => $params) {
				$rashi = $params['rashi'];
				$this->rashiInBhava[$rashi] = $bhava;
			}
		}
		return $this->rashiInBhava;
	}

	/**
	 * Get graha in bhava.
	 * 
	 * @return array
	 */
	public function getGrahaInBhava() {
		if ($this->grahaInBhava == null) {
			foreach ($this->ganitaData['graha'] as $graha => $params) {
				$rashi = $params['rashi'];

				if ($this->rashiInBhava == null)
					$this->getRashiInBhava();

				$bhava = $this->rashiInBhava[$rashi];
				$direction = $params['speed'] > 0 ? 1 : -1;

				$this->grahaInBhava[$graha] = array(
					'bhava' => $bhava,
					'direction' => $direction,
				);
			}
		}
		return $this->grahaInBhava;
	}

	/**
	 * Get graha in rashi.
	 * 
	 * @return array
	 */
	public function getGrahaInRashi() {
		if ($this->grahaInRashi == null) {
			foreach ($this->ganitaData['graha'] as $graha => $params) {
				$rashi = $params['rashi'];
				$direction = $params['speed'] > 0 ? 1 : -1;

				$this->grahaInRashi[$graha] = array(
					'rashi' => $rashi,
					'direction' => $direction,
				);
			}
			$this->grahaInRashi[Graha::LAGNA]['rashi'] = $this->ganitaData['extra']['Lg']['rashi'];
			$this->grahaInRashi[Graha::LAGNA]['direction'] = 1;
		}
		return $this->grahaInRashi;
	}

	/**
	 * Return graha label.
	 * 
	 * @param string $graha
	 * @param int $labelType
	 * @param string $userFunction
	 * @return string
	 */
	public function getGrahaLabel($graha, $labelType = 0, $userFunction = null) {
		if (!is_null($this->grahaInBhava))
			$grahas = $this->grahaInBhava;
		else
			$grahas = $this->grahaInRashi;

		switch ($labelType) {
			case 0:
				$label = $graha;
				break;
			case 1:
				if ($graha != Graha::LAGNA) {
					$grahaClass = 'Jyotish\Graha\Object\\' . $graha;
					$grahaObject = new $grahaClass();
					$label = Utils::unicodeToHtml($grahaObject->getGrahaUnicode());
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