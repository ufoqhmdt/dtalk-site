<?php
/**
 * Admint functions for WC module.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'dt_woocommerce_add_theme_options_page' ) ) :

	/**
	 * Add WooCommerce theme options page.
	 * 
	 * @param  array  $menu_items
	 * @return array
	 */
	function dt_woocommerce_add_theme_options_page( $menu_items = array() ) {
		$menu_slug = 'of-woocommerce-menu';
		if ( ! array_key_exists( $menu_slug, $menu_items ) ) {
			$menu_items[ $menu_slug ] = array(
				'menu_title'       => _x( 'WooCommerce', 'backend', 'the7mk2' ),
			);
		}
		return $menu_items;
	}

	add_filter( 'presscore_options_menu_config', 'dt_woocommerce_add_theme_options_page', 20 );

endif;

if ( ! function_exists( 'dt_woocommerce_add_theme_options' ) ) {

	function dt_woocommerce_add_theme_options( $files_list ) {
		$menu_slug = 'of-woocommerce-menu';
		if ( ! array_key_exists( $menu_slug, $files_list ) ) {
			$files_list[ $menu_slug ] = plugin_dir_path( __FILE__ ) . 'mod-wc-options.php';
		}
		return $files_list;
	}
	add_filter( 'presscore_options_files_list', 'dt_woocommerce_add_theme_options' );

}

if ( ! function_exists( 'dt_woocommerce_inject_theme_options' ) ) :

	function dt_woocommerce_inject_theme_options( $options ) {
		if ( array_key_exists( 'of-header-menu', $options ) ) {
			$options['of-woocommerce-mod-injected-header-options'] = plugin_dir_path( __FILE__ ) . 'options-inject-in-header.php';
		} elseif ( array_key_exists( 'of-likebuttons-menu', $options ) ) {
			$options[] = plugin_dir_path( __FILE__ ) . 'options-inject-in-likebuttons.php';
		}
		return $options;
	}
	add_filter( 'presscore_options_files_to_load', 'dt_woocommerce_inject_theme_options' );

endif;

if ( ! function_exists( 'dt_woocommerce_setup_less_vars' ) ) :

	function dt_woocommerce_setup_less_vars( $less_vars ) {
		$less_vars->add_hex_color(
			'product-counter-color',
			of_get_option( 'header-elements-woocommerce_cart-counter-color', '#ffffff' )
		);

		switch ( of_get_option( 'header-elements-woocommerce_cart-counter-bg' ) ) {
			case 'color':
				$colors = array( of_get_option( 'header-elements-woocommerce_cart-counter-bg-color', '#000000' ), null );
				break;
			case 'gradient':
				$colors = of_get_option( 'header-elements-woocommerce_cart-counter-bg-gradient', array( '#ffffff', '#000000' ) );
				break;
			case 'accent':
			default:
				$colors = presscore_less_get_accent_colors( $less_vars );
		}
		
		$less_vars->add_number(
			'product-img-width',
			of_get_option( 'woocommerce_product_img_width' )
 		);
 		$less_vars->add_pixel_number(
     		'switch-product-to-mobile',
     		of_get_option( 'woocommerce_product_switch', '700' )
     	);
		$less_vars->add_hex_color(
			array( 'product-counter-bg', 'product-counter-bg-2' ),
			$colors
		);
		$less_vars->add_number(
			'cart-total-width',
			of_get_option( 'woocommerce_cart_total_width' )
 		);
 		$less_vars->add_pixel_number(
     		'switch-cart-list-to-mobile',
     		of_get_option( 'woocommerce_cart_switch', '700' )
     	);
     
		$less_vars->add_rgba_color(
			'wc-steps-bg',
			of_get_option( 'woocommerce_steps_bg_color', '#f8f8f9' ),
			of_get_option( 'woocommerce_steps-bg_opacity', '100' )
		);
		$less_vars->add_hex_color(
			'wc-steps-color',
			of_get_option( 'woocommerce_steps_color', '#3b3f4a' )
		);
		$less_vars->add_pixel_number(
     		'wc-step-padding-top',
     		of_get_option( 'woocommerce_cart_top_padding', '30' )
     	);
     	$less_vars->add_pixel_number(
     		'wc-step-padding-bottom',
     		of_get_option( 'woocommerce_cart_bottom_padding', '30' )
     	);

     	//List layout img width
     	$less_vars->add_number(
			'wc-list-img-width',
			of_get_option( 'woocommerce_shop_template_img_width' )
 		);
 		//List layout switch to mobile
     	$less_vars->add_pixel_number(
			'wc-list-switch-to-mobile',
			of_get_option( 'woocommerce_list_switch' )
 		);
     	
     	
	}
	add_action( 'presscore_setup_less_vars', 'dt_woocommerce_setup_less_vars', 20 );

endif;

if ( ! function_exists( 'dt_woocommerce_add_product_metaboxes' ) ) :

	/**
	 * Add common meta boxes to product post type.
	 */
	function dt_woocommerce_add_product_metaboxes( $pages ) {
		$pages[] = 'product';
		return $pages;
	}

	add_filter( 'presscore_pages_with_basic_meta_boxes', 'dt_woocommerce_add_product_metaboxes' );

endif;

/**
 * Add sidebar columns to products on manage_edit page.
 */
add_filter( 'manage_edit-product_columns', 'presscore_admin_add_sidebars_columns' );

/**
 * Add shortcodes.
 */
add_action( 'init', array( 'DT_WC_Shortcodes', 'init' ) );