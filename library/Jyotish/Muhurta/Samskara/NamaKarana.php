<?php

namespace Jyotish\Muhurta\Samskara;

use Jyotish\Panchanga\Nakshatra\Nakshatra;

class NamaKarana {
	
	static public $namaPada = array(
		Nakshatra::NAKSHATRA_1 => array(
			Nakshatra::PADA_1 => 'Chu',
			Nakshatra::PADA_2 => 'Che',
			Nakshatra::PADA_3 => 'Cho',
			Nakshatra::PADA_4 => 'La',
		),
		Nakshatra::NAKSHATRA_2 => array(
			Nakshatra::PADA_1 => 'Li',
			Nakshatra::PADA_2 => 'Lu',
			Nakshatra::PADA_3 => 'Le',
			Nakshatra::PADA_4 => 'Lo',
		),
		Nakshatra::NAKSHATRA_3 => array(
			Nakshatra::PADA_1 => 'A',
			Nakshatra::PADA_2 => 'I',
			Nakshatra::PADA_3 => 'U',
			Nakshatra::PADA_4 => 'E',
		),
		Nakshatra::NAKSHATRA_4 => array(
			Nakshatra::PADA_1 => 'O',
			Nakshatra::PADA_2 => 'Va',
			Nakshatra::PADA_3 => 'Vi',
			Nakshatra::PADA_4 => 'Vu',
		),
		Nakshatra::NAKSHATRA_5 => array(
			Nakshatra::PADA_1 => 'Ve',
			Nakshatra::PADA_2 => 'Vo',
			Nakshatra::PADA_3 => 'Ka',
			Nakshatra::PADA_4 => 'Ke',
		),
		Nakshatra::NAKSHATRA_6 => array(
			Nakshatra::PADA_1 => 'Ku',
			Nakshatra::PADA_2 => 'Gha',
			Nakshatra::PADA_3 => 'Ing',
			Nakshatra::PADA_4 => 'Chha',
		),
		Nakshatra::NAKSHATRA_7 => array(
			Nakshatra::PADA_1 => 'Ke',
			Nakshatra::PADA_2 => 'Ko',
			Nakshatra::PADA_3 => 'Ha',
			Nakshatra::PADA_4 => 'Hi',
		),
		Nakshatra::NAKSHATRA_8 => array(
			Nakshatra::PADA_1 => 'Hu',
			Nakshatra::PADA_2 => 'He',
			Nakshatra::PADA_3 => 'Ho',
			Nakshatra::PADA_4 => 'Da',
		),
		Nakshatra::NAKSHATRA_9 => array(
			Nakshatra::PADA_1 => 'Di',
			Nakshatra::PADA_2 => 'Du',
			Nakshatra::PADA_3 => 'De',
			Nakshatra::PADA_4 => 'Do',
		),
		Nakshatra::NAKSHATRA_10 => array(
			Nakshatra::PADA_1 => 'Ma',
			Nakshatra::PADA_2 => 'Mi',
			Nakshatra::PADA_3 => 'Mu',
			Nakshatra::PADA_4 => 'Me',
		),
		Nakshatra::NAKSHATRA_11 => array(
			Nakshatra::PADA_1 => 'Mo',
			Nakshatra::PADA_2 => 'Ta',
			Nakshatra::PADA_3 => 'Ti',
			Nakshatra::PADA_4 => 'Tu',
		),
		Nakshatra::NAKSHATRA_12 => array(
			Nakshatra::PADA_1 => 'Te',
			Nakshatra::PADA_2 => 'To',
			Nakshatra::PADA_3 => 'Pa',
			Nakshatra::PADA_4 => 'Pi',
		),
		Nakshatra::NAKSHATRA_13 => array(
			Nakshatra::PADA_1 => 'Pu',
			Nakshatra::PADA_2 => 'Sha',
			Nakshatra::PADA_3 => 'Na',
			Nakshatra::PADA_4 => 'Tha',
		),
		Nakshatra::NAKSHATRA_14 => array(
			Nakshatra::PADA_1 => 'Pe',
			Nakshatra::PADA_2 => 'Po',
			Nakshatra::PADA_3 => 'Ra',
			Nakshatra::PADA_4 => 'Ri',
		),
		Nakshatra::NAKSHATRA_15 => array(
			Nakshatra::PADA_1 => 'Ru',
			Nakshatra::PADA_2 => 'Re',
			Nakshatra::PADA_3 => 'Ro',
			Nakshatra::PADA_4 => 'Ta',
		),
		Nakshatra::NAKSHATRA_16 => array(
			Nakshatra::PADA_1 => 'Ti',
			Nakshatra::PADA_2 => 'Tu',
			Nakshatra::PADA_3 => 'Te',
			Nakshatra::PADA_4 => 'To',
		),
		Nakshatra::NAKSHATRA_17 => array(
			Nakshatra::PADA_1 => 'Na',
			Nakshatra::PADA_2 => 'Ni',
			Nakshatra::PADA_3 => 'Nu',
			Nakshatra::PADA_4 => 'Ne',
		),
		Nakshatra::NAKSHATRA_18 => array(
			Nakshatra::PADA_1 => 'No',
			Nakshatra::PADA_2 => 'Ya',
			Nakshatra::PADA_3 => 'Yi',
			Nakshatra::PADA_4 => 'Yu',
		),
		Nakshatra::NAKSHATRA_19 => array(
			Nakshatra::PADA_1 => 'Ye',
			Nakshatra::PADA_2 => 'Yo',
			Nakshatra::PADA_3 => 'Bha',
			Nakshatra::PADA_4 => 'Bhi',
		),
		Nakshatra::NAKSHATRA_20 => array(
			Nakshatra::PADA_1 => 'Bhu',
			Nakshatra::PADA_2 => 'Dha',
			Nakshatra::PADA_3 => 'Bha',
			Nakshatra::PADA_4 => 'Dha',
		),
		Nakshatra::NAKSHATRA_21 => array(
			Nakshatra::PADA_1 => 'Bhe',
			Nakshatra::PADA_2 => 'Bho',
			Nakshatra::PADA_3 => 'Ja',
			Nakshatra::PADA_4 => 'Ji',
		),
		Nakshatra::NAKSHATRA_22 => array(
			Nakshatra::PADA_1 => 'Ju',
			Nakshatra::PADA_2 => 'Je',
			Nakshatra::PADA_3 => 'Jo',
			Nakshatra::PADA_4 => 'Gha',
		),
		Nakshatra::NAKSHATRA_23 => array(
			Nakshatra::PADA_1 => 'Ga',
			Nakshatra::PADA_2 => 'Gi',
			Nakshatra::PADA_3 => 'Gu',
			Nakshatra::PADA_4 => 'Ge',
		),
		Nakshatra::NAKSHATRA_24 => array(
			Nakshatra::PADA_1 => 'Go',
			Nakshatra::PADA_2 => 'Sa',
			Nakshatra::PADA_3 => 'Si',
			Nakshatra::PADA_4 => 'Su',
		),
		Nakshatra::NAKSHATRA_25 => array(
			Nakshatra::PADA_1 => 'Se',
			Nakshatra::PADA_2 => 'So',
			Nakshatra::PADA_3 => 'Da',
			Nakshatra::PADA_4 => 'Di',
		),
		Nakshatra::NAKSHATRA_26 => array(
			Nakshatra::PADA_1 => 'Du',
			Nakshatra::PADA_2 => 'Tha',
			Nakshatra::PADA_3 => 'Jha',
			Nakshatra::PADA_4 => 'Tra',
		),
		Nakshatra::NAKSHATRA_27 => array(
			Nakshatra::PADA_1 => 'De',
			Nakshatra::PADA_2 => 'Do',
			Nakshatra::PADA_3 => 'Cha',
			Nakshatra::PADA_4 => 'Chi',
		),
	);
}