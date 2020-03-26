<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Theme Compatibility for Enfold theme
 * @since 1.3.10
 */
class ET_Builder_Theme_Compat_Enfold {
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
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hook methods to WordPress
	 * Note: once this issue is fixed in future version, run version_compare() to limit the scope of the hooked fix
	 * Latest theme version: 3.8
	 * @return void
	 */
	function init_hooks() {
		$theme   = wp_get_theme();
		$version = isset( $theme['Version'] ) ? $theme['Version'] : false;

		// Bail if no theme version found
		if ( ! $version ) {
			return;
		}

		// Up to: latest theme version

		// Fixing styling quirks on visual builder
		if ( function_exists( 'et_fb_is_enabled' ) && et_fb_is_enabled() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'add_fb_styling_fix' ), 12 );
		}

		add_action( 'et_pb_shop_before_print_shop', array( $this, 'reset_shop_onsale_position') );
		add_action( 'et_pb_shop_after_print_shop', array( $this, 'return_shop_onsale_position') );
		add_action( 'et_pb_shop_before_print_shop', array( $this, 'register_shop_thumbnail' ) );
	}

	/**
	 * Add inline styling for fixing visual builder's design quirks on enfold theme
	 * @return void
	 */
	function add_fb_styling_fix() {
		// Avoid module settings modal to be overlapped by header, footer, and sidebar. The z-index has to be higher than #scroll-top-link.avia_pop_class (1030)
		$style = '.et-fb #main .container > main { z-index: 1040; }';

		wp_add_inline_style( 'avia-dynamic', $style );
	}

	function reset_shop_onsale_position() {
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	}

	function return_shop_onsale_position() {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	}

	/**
	 * Remove Enfold's product thumbnail on shop module and add Divi's product thumbnail
	 * @since 1.3.10
	 * @return void
	 */
	function register_shop_thumbnail() {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'avia_woocommerce_thumbnail', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'et_divi_builder_template_loop_product_thumbnail', 10);
	}
}
ET_Builder_Theme_Compat_Enfold::init();