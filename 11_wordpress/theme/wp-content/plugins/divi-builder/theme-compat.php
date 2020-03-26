<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Some themes are conflicting with Divi Builder beyond generalized solution
 * Load theme-based compatibility fix until theme author makes it compatible with Divi Builder
 * @since 1.0
 */
class ET_Builder_Theme_Compat_Loader {
	/**
	 * Unique instance of class
	 */
	public static $instance;

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Gets the instance of the class
	 */
	public static function init() {
		if ( null === self::$instance ){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hooking methods into WordPress actions and filters
	 * @return void
	 */
	private function init_hooks() {
		// load after $post is initiated. Cannot load before `init` hook
		if ( is_admin() ) {
			$priority = defined( 'DOING_AJAX' ) && DOING_AJAX ? 10 : 1000;

			// Adding script for UX enhancement in dashboard needs earlier hook registration
			add_action( 'wp_loaded', array( $this, 'load_theme_compat' ), $priority );
		} else {
			// Add after $post object has been set up so it can only load theme compat on page
			// which uses Divi Builder only
			add_action( 'wp', array( $this, 'load_theme_compat' ) );

			// Load compatibility scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );
		}
	}

	/**
	 * Get theme data
	 * @param string data name
	 * @return string|bool
	 */
	function get_theme( $name ) {
		$theme = wp_get_theme();

		return $theme->get( $name );
	}

	/**
	 * List of themes with available compatibility
	 * @return array
	 */
	function theme_list() {
		return apply_filters( 'et_builder_theme_compat_loader_list', array(
			'Make',
			'Virtue',
			'evolve',
			'raindrops',
			'Weblizar',
			'Zerif Lite',
			'Flatsome',
			'Enfold',
			'Avada',
			'X',
			'SmartMag',
			'Betheme',
			'The7',
			'Salient',
			'Foxy',
		) );
	}

	/**
	 * Check whether current page should load theme compatibility file or not
	 * @return bool
	 */
	function has_theme_compat() {
		$post_id = get_the_ID();

		// in dashboard and preview, always load theme-compat file
		$is_using_pagebuilder = is_admin() || is_et_pb_preview() ? true : isset( $post_id ) && et_pb_is_pagebuilder_used( $post_id );

		// Check whether: 1) current page uses Divi builder or 2) current theme has compatibility file
		if ( $is_using_pagebuilder && in_array( $this->get_theme( 'Name' ), $this->theme_list() ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Load theme compatibility file, if there's any
	 * @return void
	 */
	function load_theme_compat() {
		if ( $this->has_theme_compat() ) {
			// Get theme-compat file at /theme-compat/ directory
			$theme_compat_path = ET_BUILDER_PLUGIN_DIR . 'theme-compat/' . sanitize_title( $this->get_theme( 'Name' ) ) . '.php';
			require_once apply_filters( 'et_builder_theme_compat_loader_list_path', $theme_compat_path, $this->get_theme( 'Name' ) );
		}
	}

	/**
	 * Load compatibility style & scripts
	 * @return void
	 */
	function enqueue_scripts() {
		// Add Elegant Shortcode Support
		$shortcode_file_path = get_template_directory() . '/epanel/shortcodes/shortcodes.php';

		if ( 'Elegant Themes' === $this->get_theme( 'Author' ) && file_exists( $shortcode_file_path ) ) {
			// Dequeue standard Elegant Shortcode styling
			wp_dequeue_style( 'et-shortcodes-css' );

			// Enqueue modified (more-specific) Elegant Shortcode styling
			wp_enqueue_style(
				'et-builder-compat-elegant-shortcodes',
				ET_BUILDER_PLUGIN_URI . '/theme-compat/css/elegant-shortcodes.css',
				array( 'et-builder-modules-style' ),
				ET_BUILDER_PLUGIN_VERSION
			);
		}
	}
}

ET_Builder_Theme_Compat_Loader::init();
