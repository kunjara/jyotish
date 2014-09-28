<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * Autoloader class.
 * 
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Autoloader {

	public function __construct() {
		
	}

	public static function autoload($file) {
		$file = str_replace('\\', '/', $file);
		$filepath = stream_resolve_include_path($file . '.php');

		if (file_exists($filepath)) {
			require_once ($filepath);
		}
	}

}

spl_autoload_register('Jyotish\Base\Autoloader::autoload');
