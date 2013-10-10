<?php

namespace Jyotish\Muhurta\Samskara;

use Jyotish\Panchanga\Nakshatra\Nakshatra;

class NamaKarana {
	
	static public $namaPada = array(
		1 => array(
			'chu'	=> array('ca','u'),
			'che'	=> array('ca','e'),
			'cho'	=> array('ca','o'),
			'la'	=> array('la','aa'),
		),
		2 => array(
			'li'	=> array('la','ii'),
			'lu'	=> array('la','u'),
			'le'	=> array('la','e'),
			'lo'	=> array('la','o'),
		),
		3 => array(
			'a'		=> array('_a'),
			'i'		=> array('_i'),
			'u'		=> array('_u'),
			'e'		=> array('_e'),
		),
		4 => array(
			'o'		=> array('_o'),
			'va'	=> array('va','aa'),
			'vi'	=> array('va','ii'),
			'vu'	=> array('va','u'),
		),
		5 => array(
			've'	=> array('va','e'),
			'vo'	=> array('va', 'o'),
			'ka'	=> array('ka', 'aa'),
			'ki'	=> array('ka', 'ii'),
		),
		6 => array(
			'ku'	=> array('ka','u'),
			'gha'	=> array('gha'),
			'nga'	=> array('nga'),
			'chha'	=> array('cha'),
		),
		7 => array(
			'ke'	=> array('ka','e'),
			'ko'	=> array('ka','o'),
			'ha'	=> array('ha','aa'),
			'hi'	=> array('ha','ii'),
		),
		8 => array(
			'hu'	=> array('ha','u'),
			'he'	=> array('ha','e'),
			'ho'	=> array('ha','o'),
			'da'	=> array('dda','aa'),
		),
		9 => array(
			'di'	=> array('dda','ii'),
			'du'	=> array('dda','u'),
			'de'	=> array('dda','e'),
			'do'	=> array('dda','o'),
		),
		10 => array(
			'ma'	=> array('ma','aa'),
			'mi'	=> array('ma','ii'),
			'mu'	=> array('ma','u'),
			'me'	=> array('ma','e'),
		),
		11 => array(
			'mo'	=> array('ma','o'),
			'ta'	=> array('tta','aa'),
			'ti'	=> array('tta','ii'),
			'tu'	=> array('tta','u'),
		),
		12 => array(
			'te'	=> array('tta','e'),
			'to'	=> array('tta','o'),
			'pa'	=> array('pa','aa'),
			'pi'	=> array('pa','ii'),
		),
		13 => array(
			'pu'	=> array('pa','u'),
			'sha'	=> array('ssa'),
			'na'	=> array('nna'),
			'tha'	=> array('ttha'),
		),
		14 => array(
			'pe'	=> array('pa','e'),
			'po'	=> array('pa','o'),
			'ra'	=> array('ra','aa'),
			'ri'	=> array('ra','ii'),
		),
		15 => array(
			'ru'	=> array('ra','u'),
			're'	=> array('ra','e'),
			'ro'	=> array('ra','o'),
			'ta'	=> array('ta','aa'),
		),
		16 => array(
			'ti'	=> array('ta','ii'),
			'tu'	=> array('ta','u'),
			'te'	=> array('ta','e'),
			'to'	=> array('ta','o'),
		),
		17 => array(
			'na'	=> array('na','aa'),
			'ni'	=> array('na','ii'),
			'nu'	=> array('na','u'),
			'ne'	=> array('na','e'),
		),
		18 => array(
			'no'	=> array('na','o'),
			'ya'	=> array('ya','aa'),
			'yi'	=> array('ya','ii'),
			'yu'	=> array('ya','u'),
		),
		19 => array(
			'ye'	=> array('ya','e'),
			'yo'	=> array('ya','o'),
			'bha'	=> array('bha','aa'),
			'bhi'	=> array('bha','ii'),
		),
		20 => array(
			'bhu'	=> array('bha','u'),
			'dha'	=> array('dha','aa'),
			'pha'	=> array('pha','aa'),
			'ddha'	=> array('ddha','aa'),
		),
		21 => array(
			'bhe'	=> array('bha','e'),
			'bho'	=> array('bha','o'),
			'ja'	=> array('ja','aa'),
			'ji'	=> array('ja','ii'),
		),
		22 => array(
			'ju'	=> array('ja','u'),
			'je'	=> array('ja','e'),
			'jo'	=> array('ja','o'),
			'gha'	=> array('ghha','aa'),
		),
		23 => array(
			'ga'	=> array('ga','aa'),
			'gi'	=> array('ga','ii'),
			'gu'	=> array('ga','u'),
			'ge'	=> array('ga','e'),
		),
		24 => array(
			'go'	=> array('ga','o'),
			'sa'	=> array('sa','aa'),
			'si'	=> array('sa','ii'),
			'su'	=> array('sa','u'),
		),
		25 => array(
			'se'	=> array('sa','e'),
			'so'	=> array('sa','o'),
			'da'	=> array('da','aa'),
			'di'	=> array('da','ii'),
		),
		26 => array(
			'du'	=> array('da','u'),
			'tha'	=> array('tha'),
			'jha'	=> array('jha'),
			'tra'	=> array('nya'),
		),
		27 => array(
			'de'	=> array('da','e'),
			'do'	=> array('da','o'),
			'cha'	=> array('ca','aa'),
			'chi'	=> array('ca','ii'),
		),
	);
}