<?php
/**
 * Functions
 *
 * @package   w6\vc_addons
 * @since     1.0.0
 * @author    WEB6 <contact@web6.fr>
 * @copyright 2018 WEB6
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt  GNU GPLv3
 * @link      https://github.com/web6-fr/w6-vc-addons
 */

namespace W6\Vc_Addons;

/**
 * Autoload
 *
 * @param string $class_name Class name.
 */
function autoload( $class_name ) {

	if ( false === strpos( $class_name, 'W6\Vc_Addons' ) ) {
		return;
	}

	$parts = explode( '\\', $class_name );
	$parts = array_filter( $parts );

	// Special rule for elements.
	if ( 'Elements' === $parts[2] && 4 === count( $parts ) ) {
		$folder_name = array_pop( $parts );
		$basename    = str_replace( '_', '-', $folder_name );
		$basename    = strtolower( $basename );

		$path = ELEMENTS . '/' . $folder_name . '/class-' . $basename . '.php';
		if ( file_exists( $path ) ) {
			require_once $path;
		}
		return;
	}

	$basename = array_pop( $parts );
	$basename = str_replace( '_', '-', $basename );
	$basename = strtolower( $basename );

	$path = implode( '/', $parts );
	$path = str_replace( 'W6/Vc_Addons', 'libs', $path );
	$path = ROOT . '/' . $path;

	$types = array(
		'class',
		'trait',
		'interface',
	);

	foreach ( $types as $type ) {
		$_path = $path . '/' . $type . '-' . $basename . '.php';
		if ( file_exists( $_path ) ) {
			require_once $_path;
			break;
		}
	}
}
