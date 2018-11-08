<?php
/**
 * WooCommerce compatibility class.
 *
 * @package the7
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Presscore_Compatibility_Woocommerce', false ) ) :

	class Presscore_Compatibility_Woocommerce {

		public static function execute() {
			if ( ! class_exists( 'Woocommerce', false ) ) {
				return;
			}

			$mod_dir = dirname( __FILE__ );

			// admin scripts
			require_once "{$mod_dir}/admin/mod-wc-shortcodes.php";
			require_once "{$mod_dir}/admin/mod-wc-admin-functions.php";

			// frontend scripts
			require_once "{$mod_dir}/front/mod-wc-class-template-config.php";
			require_once "{$mod_dir}/front/mod-wc-template-functions.php";
			require_once "{$mod_dir}/front/mod-wc-template-config.php";
			require_once "{$mod_dir}/front/mod-wc-template-hooks.php";
			require_once "{$mod_dir}/front/class-the7-wc-mini-cart.php";

			// add wooCommerce support
			add_theme_support( 'woocommerce', array(
				'gallery_thumbnail_image_width' => 200,
			) );

			if ( of_get_option( 'woocommerce-product_zoom' ) ) {
				add_theme_support( 'wc-product-gallery-zoom' );
			}

			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			The7_WC_Mini_Cart::init();
		}
	}

	Presscore_Compatibility_Woocommerce::execute();

endif;
