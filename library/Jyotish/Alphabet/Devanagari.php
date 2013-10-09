<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Alphabet;

use Jyotish\Service\Utils;

/**
 * Devanagari class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Devanagari {
	/**
	 * Transliteration of consonants
	 */
	const KA	= 'ka';
	const KHA	= 'kha';
	const GA	= 'ga';
	const GHA	= 'gha';
	const NGA	= 'nga';
	const CA	= 'ca';
	const CHA	= 'cha';
	const JA	= 'ja';
	const JHA	= 'jha';
	const NYA	= 'nya';
	const TTA	= 'tta';
	const TTHA	= 'ttha';
	const DDA	= 'dda';
	const DDHA	= 'ddha';
	const NNA	= 'nna';
	const TA	= 'ta';
	const THA	= 'tha';
	const DA	= 'da';
	const DHA	= 'dha';
	const NA	= 'na';
	const PA	= 'pa';
	const PHA	= 'pha';
	const BA	= 'ba';
	const BHA	= 'bha';
	const MA	= 'ma';
	const YA	= 'ya';
	const RA	= 'ra';
	const LA	= 'la';
	const VA	= 'va';
	const SHA	= 'sha';
	const SSA	= 'ssa';
	const SA	= 'sa';
	const HA	= 'ha';
	
	/**
	 * Transliteration of vowels
	 */
	const AA	= 'aa';
	const I		= 'i';
	const II	= 'ii';
	const U		= 'u';
	const UU	= 'uu';
	const R		= 'r';
	const RR	= 'rr';
	const E		= 'e';
	const AI	= 'ai';
	const O		= 'o';
	const AU	= 'au';
	const L		= 'l';
	const LL	= 'll';
	
	/**
	 * Transliteration of other symbols
	 */
	const ANUNASIKA	= 'anunasika';
	const ANUSVARA	= 'anusvara';
	const VISARGA	= 'visarga';
	const VIRAMA	= 'virama';
	
	static public $unicode = array(
		self::KA	=> '0915',
		self::KHA	=> '0916',
		self::GA	=> '0917',
		self::GHA	=> '0918',
		self::NGA	=> '0919',
		self::CA	=> '091A',
		self::CHA	=> '091B',
		self::JA	=> '091C',
		self::JHA	=> '091D',
		self::NYA	=> '091E',
		self::TTA	=> '091F',
		self::TTHA	=> '0920',
		self::DDA	=> '0921',
		self::DDHA	=> '0922',
		self::NNA	=> '0923',
		self::TA	=> '0924',
		self::THA	=> '0925',
		self::DA	=> '0926',
		self::DHA	=> '0927',
		self::NA	=> '0928',
		self::PA	=> '092A',
		self::PHA	=> '092B',
		self::BA	=> '092C',
		self::BHA	=> '092D',
		self::MA	=> '092E',
		self::YA	=> '092F',
		self::RA	=> '0930',
		self::LA	=> '0932',
		self::VA	=> '0935',
		self::SHA	=> '0936',
		self::SSA	=> '0937',
		self::SA	=> '0938',
		self::HA	=> '0939',
		
		self::AA	=> '093E',
		self::I		=> '093F',
		self::II	=> '0940',
		self::U		=> '0941',
		self::UU	=> '0942',
		self::R		=> '0943',
		self::RR	=> '0944',
		self::E		=> '0947',
		self::AI	=> '0948',
		self::O		=> '094B',
		self::AU	=> '094C',
		self::L		=> '0962',
		self::LL	=> '0963',
		
		'0'			=> '0966',
		'1'			=> '0967',
		'2'			=> '0968',
		'3'			=> '0969',
		'4'			=> '096A',
		'5'			=> '096B',
		'6'			=> '096C',
		'7'			=> '096D',
		'8'			=> '096E',
		'9'			=> '096F',
		
		self::ANUNASIKA => '0901',
		self::ANUSVARA	=> '0902',
		self::VISARGA	=> '0903',
		self::VIRAMA	=> '094D',
	);
	
	/**
	 * Convert translit to html code.
	 * 
	 * @param array|string $translit
	 * @return string
	 */
	static public function translitToHtml($translit)
	{
		if(is_array($translit)){
			foreach ($translit as $tr){
				$html .= self::_trToHtml($tr);
			}
		}else{
			$html = self::_trToHtml($tr);
		}
		
		return $html;
	}
	
	static private function _trToHtml($tr)
	{
		if(array_key_exists($tr, self::$unicode)){
			return Utils::unicodeToHtml(self::$unicode[$tr]);
		}else{
			throw new Exception\InvalidArgumentException("Transliteration '$tr' is not defined in Devanagari.");
		}
	}
}