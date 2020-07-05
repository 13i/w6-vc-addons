<?php
/**
 * Visual Composer Addons
 *
 * Useful addons for Visual Composer :
 * - Before & After with hotspots
 *
 * @package   w6\vc_addons
 * @since     1.0.0
 * @author    WEB6 <contact@web6.fr>
 * @copyright 2018 WEB6
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt  GNU GPLv3
 * @link      https://github.com/web6-fr/w6-vc-addons
 *
 * @wordpress-plugin
 * Plugin Name:   W6 Visual Composer Addons
 * Plugin URI:    https://github.com/web6-fr/w6-vc-addons
 * Description:   Useful addons for Visual Composer
 * Version:       1.0.0
 * Author:        WEB6
 * Author URI:    https://web6.fr
 * License:       GPL-3.0
 * License URI:   https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:   w6-vc-addons
 * Domain Path:   /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin version.
 */
define( 'W6\Vc_Addons\VERSION', '1.0.0' );

/**
 * Plugin root folder.
 */
define( 'W6\Vc_Addons\ROOT', dirname( __FILE__ ) );

/**
 * Plugin root url.
 */
define( 'W6\Vc_Addons\URL', ltrim( plugin_dir_url( __FILE__ ), '/' ) );

/**
 * Elements folder.
 */
define( 'W6\Vc_Addons\ELEMENTS', dirname( __FILE__ ) . '/elements' );

/**
 * Functions
 */
require_once 'libs/functions.php';

/**
 * Autoload
 */
spl_autoload_register( '\W6\Vc_Addons\autoload' );

/**
 * Composer
 */
require_once 'vendor/autoload.php';

/**
 * Init plugin
 */
\W6\Vc_Addons\Vc_Addons::init();
