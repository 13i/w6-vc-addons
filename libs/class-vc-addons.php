<?php
/**
 * Main Visual Composer Addons class
 *
 * This class handles the plugin's initialisation
 *
 * @package   W6\Vc_Addons
 * @author    WEB6 <contact@web6.fr>
 * @copyright 2018 WEB6
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt  GNU GPLv3
 * @link      https://github.com/web6-fr/w6-vc-addons
 */

namespace W6\Vc_Addons;

/**
 * This class handles the plugin's initialisation
 *
 * @package   W6\Vc_Addons\Vc_Addons
 */
class Vc_Addons {

	/**
	 * Plugin initiation
	 *
	 * @return void
	 */
	public static function init() {

		// Add VC Elements dynamicaly.
		add_action( 'vc_before_init', '\W6\Vc_Addons\Vc_Addons::init_elements' );

		// Disable front end editor.
		add_action( 'vc_after_init', 'vc_disable_frontend' );

	}


	/**
	 * Add VC Elements dynamicaly
	 *
	 * @return void
	 */
	public static function init_elements() {
		foreach ( glob( ELEMENTS . '/*' ) as $element ) {
			$element_name = pathinfo( $element, PATHINFO_BASENAME );
			$class_name   = '\W6\Vc_Addons\Elements\\' . $element_name;
			new $class_name();
		}
	}
}
