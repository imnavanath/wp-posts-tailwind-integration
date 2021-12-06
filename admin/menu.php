<?php
/**
 * Tailwind Integration - Admin menu file.
 *
 * @since             x.x.x
 * @package           Tailwind_Integration
 * @author            Navanath Bhosale <navanath.bhosale95@gmail.com>
 * @link              #
 */

namespace Tailwind_Integration\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Menu.
 */
class Menu {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
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
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Instance
	 *
	 * @access private
	 * @var string Class object.
	 * @since x.x.x
	 */
	private $menu_slug = TAILWIND_INTEGRATION_PLUGIN_PREFIX;

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {
		$this->initialize_hooks();
	}

	/**
	 * Init Hooks.
	 *
	 * @since x.x.x
	 * @return void
	 */
	public function initialize_hooks() {
		add_action( 'admin_menu', array( $this, 'setup_menu' ) );
		add_action( 'admin_init', array( $this, 'settings_admin_scripts' ) );
	}

	/**
	 *  Initialize after Cartflows pro get loaded.
	 */
	public function settings_admin_scripts() {
		// Enqueue admin scripts.
		if ( ! empty( $_GET['page'] ) && ( $this->menu_slug === $_GET['page'] || false !== strpos( $_GET['page'], $this->menu_slug . '_' ) ) ) { //phpcs:ignore
			add_action( 'admin_enqueue_scripts', array( $this, 'styles_scripts' ) );
		}
	}

	/**
	 * Add submenu to admin menu.
	 *
	 * @since x.x.x
	 */
	public function setup_menu() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$menu_slug  = $this->menu_slug;
		$capability = 'manage_options';

		add_menu_page(
			'Tailwind App',
			'Tailwind App',
			$capability,
			$menu_slug,
			array( $this, 'render_tailwind_integration_ui' ),
			'dashicons-awards',
			25
		);
	}

	/**
	 * Renders the admin settings.
	 *
	 * @since x.x.x
	 * @return void
	 */
	public function render_tailwind_integration_ui() {
		echo '<div id="tailwind-integration-wp-app" class="tailwind-integration-wp-app">';
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since x.x.x
	 */
	public function styles_scripts() {

		$localize = array(
			'rest_posts_url'      => site_url() . '/wp-json/wp/v2/posts?&_embed',
			'admin_url'			  => admin_url(),
			'site_url'			  => site_url(),
		);

		$this->settings_app_scripts( $localize );
	}

	/**
	 * Settings app scripts
	 *
	 * @param array $localize Variable names.
	 */
	public function settings_app_scripts( $localize ) {
		$handle            = 'tailwind-integration-admin';
		$build_path        = TAILWIND_INTEGRATION_PLUGIN_DIR . 'build/';
		$build_url         = TAILWIND_INTEGRATION_PLUGIN_URL . 'build/';
		$script_asset_path = $build_path . 'app.asset.php';
		$script_info       = file_exists( $script_asset_path )
			? include $script_asset_path
			: array(
				'dependencies' => array(),
				'version'      => TAILWIND_INTEGRATION_PLUGIN_VER,
			);

		$script_dep = array_merge( $script_info['dependencies'], array( 'updates' ) );

		wp_register_script(
			$handle,
			$build_url . 'app.js',
			$script_dep,
			$script_info['version'],
			true
		);

		wp_register_style(
			$handle,
			$build_url . 'app.css',
			array(),
			TAILWIND_INTEGRATION_PLUGIN_VER
		);

		// Stylesheet loader.
		wp_enqueue_style( $handle );
		wp_style_add_data( $handle, 'rtl', 'replace' );

		// Script loader.
		wp_enqueue_script( $handle );
		wp_localize_script( $handle, 'tailwind_integration_ui', $localize );
	}
}

/**
 * Kicking this off by calling 'instance()' method
 */
Menu::instance();
