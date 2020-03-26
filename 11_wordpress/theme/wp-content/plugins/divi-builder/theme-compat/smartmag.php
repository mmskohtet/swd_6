<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Theme Compatibility for SmartMag theme
 * @see http://theme-sphere.com
 * @since 1.3.10
 */
class ET_Builder_Theme_Compat_SmartMag {
	/**
	 * Unique instance of class
	 */
	public static $instance;

	/**
	 * Constructor
	 */
	private function __construct(){
		$this->init_hooks();
	}

	/**
	 * Gets the instance of the class
	 */
	public static function init(){
		if ( null === self::$instance ){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hook methods to WordPress
	 * @return void
	 */
	function init_hooks() {
		$theme   = wp_get_theme();
		$version = isset( $theme['Version'] ) ? $theme['Version'] : false;

		// Bail if no theme version found
		if ( ! $version ) {
			return;
		}

		add_action( 'et_pb_shop_before_print_shop', array( $this, 'register_shop_thumbnail' ) );
	}

	/**
	 * Remove SmartMag's product thumbnail on shop module and add Divi's product thumbnail
	 * @since 1.3.10
	 * @return void
	 */
	function register_shop_thumbnail() {
		global $wp_filter;

		$item_title_hook = isset( $wp_filter['woocommerce_before_shop_loop_item_title'] ) ? $wp_filter['woocommerce_before_shop_loop_item_title'] : false;

		if ( class_exists( 'Bunyad' ) && null !== Bunyad::get('smart_mag') && isset( Bunyad::get('smart_mag')->woocommerce ) ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', array( Bunyad::get('smart_mag')->woocommerce, 'cart_icon' ), 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'et_divi_builder_template_loop_product_thumbnail', 10);
		}
	}
}
ET_Builder_Theme_Compat_SmartMag::init();