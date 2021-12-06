<?php
/**
 * Tailwind Integration - Plugin loader file.
 *
 * @since             1.0.0
 * @package           Tailwind_Integration
 * @author            Navanath Bhosale <navanath.bhosale95@gmail.com>
 * @link              #
 */

namespace Tailwind_Integration;
use Tailwind_Integration\Admin\Menu;

/**
 * TI_Plugin_Loader
 *
 * @since x.x.x
 */
class TI_Plugin_Loader {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class Instance.
	 * @since x.x.x
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since x.x.x
	 * @return object initialized object of class.
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Autoload classes.
	 *
	 * @param string $class class name.
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		$filename = strtolower(
			preg_replace(
				[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class_to_load
			)
		);

		$file = TAILWIND_INTEGRATION_PLUGIN_DIR . $filename . '.php';

		// if the file redable, include it.
		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {

		spl_autoload_register( [ $this, 'autoload' ] );

		if ( is_admin() ) {
			Menu::instance();
		}
	}
}

/**
 * Kicking this off by calling 'instance()' method
 */
TI_Plugin_Loader::instance();
