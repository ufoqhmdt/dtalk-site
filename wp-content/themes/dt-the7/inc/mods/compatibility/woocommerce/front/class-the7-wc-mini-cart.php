<?php

class The7_WC_Mini_Cart {

	/**
	 * Init mini cart.
	 */
	public static function init() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'get_cart_fragments' ), 10, 1 );
		add_action( 'presscore_render_header_element-cart', array( __CLASS__, 'render_cart_micro_widget' ) );
	}

	/**
	 * Add mini cart fragments.
	 *
	 * @param array $fragments
	 *
	 * @return array
	 */
	public static function get_cart_fragments( $fragments ) {
		ob_start();
		dt_woocommerce_configure_mini_cart();
		self::render_cart_inner();
		$fragments['.shopping-cart'] = ob_get_clean();

		return $fragments;
	}

	/**
	 * Render mini cart.
	 */
	public static function render_cart_inner() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/cart/mod-wc-mini-cart' );
	}

	public static function render_cart_micro_widget() {
		printf( '<div class="%s">', presscore_esc_implode( ' ', presscore_get_mini_widget_class( 'header-elements-woocommerce_cart' ) ) );
		self::render_cart_inner();
		echo '</div>';
	}
}
