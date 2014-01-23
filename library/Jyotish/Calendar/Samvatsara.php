<?php
/*
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar;

/**
 * Samvatsara class
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Samvatsara {
	/**
	 * Duration of the year in days
	 */
	const DUR_GREGORIAN	= 365.2425;
	const DUR_JULIAN	= 365.25;
	/**
	 * Samvatsara's vimshatika
	 */
	const VIMSHATIKA_BRAHMA	= 'Brahma-Vimshatika';
	const VIMSHATIKA_VISHNU	= 'Vishnu-Vimshatika';
	const VIMSHATIKA_RUDRA	= 'Rudra-Vimshatika';
	
	/**
	 * Name of Samvatsara
	 * 
	 * @var array
	 */
	static public $SAMVATSARA = array(
		1 => 'Prabhava',
		2 => 'Vibhava',
		3 => 'Shukla',
		4 => 'Prоmoda',
		5 => 'Prajаpati',
		6 => 'Angirasa',
		7 => 'Srimukha',
		8 => 'Bhava',
		9 => 'Yuva',
		10 => 'Dhata',
		11 => 'Ishvara',
		12 => 'Bahudhanya',
		13 => 'Pramathi',
		14 => 'Vikrama',
		15 => 'Vishu',
		16 => 'Chitrabhanu',
		17 => 'Subhanu',
		18 => 'Tharana',
		19 => 'Parthiva',
		20 => 'Vyaya',
		21 => 'Sarvajit',
		22 => 'Sarvadhari',
		23 => 'Virodhi',
		24 => 'Vikruti',
		25 => 'Khara',
		26 => 'Nandhana',
		27 => 'Vijaya',
		28 => 'Jaya',
		29 => 'Manmatha',
		30 => 'Durmukhi',
		31 => 'Hemalambi',
		32 => 'Vilambi',
		33 => 'Vikari',
		34 => 'Sharvari',
		35 => 'Plava',
		36 => 'Shubhakrita',
		37 => 'Shobhakrita',
		38 => 'Krodhi',
		39 => 'Vishvavasu',
		40 => 'Parabhava',
		41 => 'Plavanga',
		42 => 'Keelaka',
		43 => 'Saumya',
		44 => 'Sadharana',
		45 => 'Virodhаkritа',
		46 => 'Pareedhavi',
		47 => 'Pramadi',
		48 => 'Ananda',
		49 => 'Rakshasa',
		50 => 'Nala',
		51 => 'Pingala',
		52 => 'Kalayukti',
		53 => 'Siddhartha',
		54 => 'Raudhri',
		55 => 'Durmati',
		56 => 'Dundubhi',
		57 => 'Rudhirodgari',
		58 => 'Raktakshi',
		59 => 'Krodhana',
		60 => 'Akshaya',
	);
}