<?php
/**
 * Tailwind Integration
 *
 * @since             1.0.0
 * @package           Tailwind_Integration
 * @author            Navanath Bhosale <navanath.bhosale95@gmail.com>
 * @link              #
 *
 * @wordpress-plugin
 * Plugin Name:       Tailwind Integration
 * Description:       Plugin to showcase all WordPress posts on a admin page which integrated with Tailwind CSS.
 * Version:           1.0.0
 * Author:            Navanath Bhosale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tailwind-integration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently active plugin file.
 */
define( 'TAILWIND_INTEGRATION_PLUGIN_FILE', __FILE__ );
define( 'TAILWIND_INTEGRATION_PLUGIN_VER', '1.0.0' );
define( 'TAILWIND_INTEGRATION_PLUGIN_PREFIX', 'tailwind_init' );
define( 'TAILWIND_INTEGRATION_PLUGIN_BASE', plugin_basename( TAILWIND_INTEGRATION_PLUGIN_FILE ) );
define( 'TAILWIND_INTEGRATION_PLUGIN_DIR', plugin_dir_path( TAILWIND_INTEGRATION_PLUGIN_FILE ) );
define( 'TAILWIND_INTEGRATION_PLUGIN_URL', plugins_url( '/', TAILWIND_INTEGRATION_PLUGIN_FILE ) );

/**
 * The core plugin class that is used to define admin-specific hooks, and public-facing site hooks.
 */
require_once TAILWIND_INTEGRATION_PLUGIN_DIR . 'classes/class-tailwind-integration-loader.php';
