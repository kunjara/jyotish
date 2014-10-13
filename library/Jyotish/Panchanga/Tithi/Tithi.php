<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Panchanga\Tithi;

use Jyotish\Tattva\Jiva\Nara\Deva;

/**
 * Class with Tithi names and attributes.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Tithi {
	
	const NAME_PRATIPAD = 'Pratipad';
	const NAME_DWITIYA = 'Dwitiya';
	const NAME_TRITIYA = 'Tritiya';
	const NAME_CHATURTHI = 'Chaturthi';
	const NAME_PANCHAMI = 'Panchami';
	const NAME_SHASHTI = 'Shashti';
	const NAME_SAPTAMI = 'Saptami';
	const NAME_ASHTAMI = 'Ashtami';
	const NAME_NAVAMI = 'Navami';
	const NAME_DASHAMI = 'Dashami';
	const NAME_EKADASHI = 'Ekadashi';
	const NAME_DWADASHI = 'Dwadashi';
	const NAME_TRAYODASHI = 'Trayodashi';
	const NAME_CHATURDASHI = 'Chaturdashi';
	const NAME_PURNIMA = 'Purnima';
	const NAME_AMAVASYA = 'Amavasya';
	
	const TYPE_NANDA = 'nanda';
	const TYPE_BHADRA = 'bhadra';
	const TYPE_JAYA = 'jaya';
	const TYPE_RIKTA = 'rikta';
	const TYPE_PURNA = 'purna';
	
	const PAKSHA_SHUKLA = 'shukla';
	const PAKSHA_KRISHNA = 'krishna';

	static public $tithi = array(
		1 => self::NAME_PRATIPAD,
		2 => self::NAME_DWITIYA,
		3 => self::NAME_TRITIYA,
		4 => self::NAME_CHATURTHI,
		5 => self::NAME_PANCHAMI,
		6 => self::NAME_SHASHTI,
		7 => self::NAME_SAPTAMI,
		8 => self::NAME_ASHTAMI,
		9 => self::NAME_NAVAMI,
		10 => self::NAME_DASHAMI,
		11 => self::NAME_EKADASHI,
		12 => self::NAME_DWADASHI,
		13 => self::NAME_TRAYODASHI,
		14 => self::NAME_CHATURDASHI,
		15 => self::NAME_PURNIMA,
		16 => self::NAME_PRATIPAD,
		17 => self::NAME_DWITIYA,
		18 => self::NAME_TRITIYA,
		19 => self::NAME_CHATURTHI,
		20 => self::NAME_PANCHAMI,
		21 => self::NAME_SHASHTI,
		22 => self::NAME_SAPTAMI,
		23 => self::NAME_ASHTAMI,
		24 => self::NAME_NAVAMI,
		25 => self::NAME_DASHAMI,
		26 => self::NAME_EKADASHI,
		27 => self::NAME_DWADASHI,
		28 => self::NAME_TRAYODASHI,
		29 => self::NAME_CHATURDASHI,
		30 => self::NAME_AMAVASYA,
	);

	/**
	 * Returns the requested instance of tithi class.
	 * 
	 * @param int $number The number of tithi
	 * @param null|array $options (Optional) Options to set
	 * @return the requested instance of tithi class
	 * @throws Exception\InvalidArgumentException
	 */
	static public function getInstance($number, $options = null) {
		if (self::$tithi[$number]) {
			$tithiClass = 'Jyotish\\Panchanga\\Tithi\\Object\\T' . $number;
			$tithiObject = new $tithiClass($options);
			
			return $tithiObject;
		} else {
			throw new Exception\InvalidArgumentException("Tithi with the number '$number' does not exist.");
		}
	}
	
	/**
	 * Devas of tithi.
	 * 
	 * @var array
	 * @see Varahamihira. Brihat Samhita. Chapter 99, Verse 1.
	 * @see Bhavishya Purana. Brahma parva, Chapter 102.
	 */
	static public $tithiDeva = [
		'varahamihira' => [
			1 => Deva::DEVA_BRAHMA,
			2 => Deva::DEVA_VIDHATA,
			3 => Deva::DEVA_VISHNU_HARI,
			4 => Deva::DEVA_YAMA,
			5 => Deva::DEVA_CHANDRA,
			6 => Deva::DEVA_KARTTIKEYA_SUBRAMANYA,
			7 => Deva::DEVA_INDRA,
			8 => Deva::DEVA_VASU,
			9 => Deva::DEVA_SARPA,
			10 => Deva::DEVA_YAMA_DHARMA,
			11 => Deva::DEVA_SHIVA,
			12 => Deva::DEVA_SURYA_SAVITRI,
			13 => Deva::DEVA_KAMADEV_MANMATHA,
			14 => Deva::DEVA_PARVATI_KALI,
			15 => Deva::DEVA_VISHVADEVA,
			30 => Deva::DEVA_PITRU
		],
		'bhavishya' => [
			1 => Deva::DEVA_AGNI,
			2 => Deva::DEVA_BRAHMA,
			3 => Deva::DEVA_KUBER,
			4 => Deva::DEVA_GANAPATHI,
			5 => Deva::DEVA_SARPA,
			6 => Deva::DEVA_KARTTIKEYA,
			7 => Deva::DEVA_SURYA,
			8 => Deva::DEVA_SHIVA_RUDRA,
			9 => Deva::DEVA_PARVATI_DUGRA,
			10 => Deva::DEVA_YAMA,
			11 => Deva::DEVA_VISHVADEVA,
			12 => Deva::DEVA_VISHNU,
			13 => Deva::DEVA_KAMADEV,
			14 => Deva::DEVA_SHIVA,
			15 => Deva::DEVA_CHANDRA,
			30 => Deva::DEVA_PITRU
		]
	];
	
	/**
	 * Get tiithi using the Harvey formula.
	 * 
	 * @param	ind $day
	 * @param	int $month
	 * @param	int $year
	 * @return	int
	 */
	static public function getTithiByHarvey($day, $month, $year) {
		if ($month <= 2) {
			$monthH	= $month + 12;
			$yearH = $year - 1;
		} else {
			$monthH = $month;
			$yearH = $year;
		}
		
		$eq			= floor($yearH/100);
		$eq1		= floor($eq/3) + floor($eq/4) + 6 - $eq;
		$eq2		= (round(($yearH/$eq - floor($yearH/$eq)) * 209) + $monthH + $eq1 + $day)/30;
		
		$tithi		= round(($eq2 - floor($eq2))*30 + 1);
		
		return $tithi;
	}

}