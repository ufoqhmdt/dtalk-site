<?php
/**
 * Dynamic stylesheets functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_dynamic_stylesheets_list' ) ) :

	function presscore_get_dynamic_stylesheets_list() {

		static $dynamic_stylesheets = null;

		if ( null === $dynamic_stylesheets ) {
			$dynamic_stylesheets = array();

			$dynamic_stylesheets['dt-custom'] = array(
				'src' => 'custom.less',
			);

			if ( dt_is_woocommerce_enabled() ) {
				$dynamic_stylesheets['wc-dt-custom'] = array(
					'src' => 'compatibility/wc-dt-custom.less',
				);
			}

			if ( presscore_responsive() ) {
				$dynamic_stylesheets['dt-media'] = array(
					'src' => 'media.less',
				);
			}

			if ( dt_is_legacy_mode() ) {
				$dynamic_stylesheets['dt-legacy'] = array(
					'src' => 'legacy.less',
				);
			}
		}

		$dynamic_stylesheets = apply_filters( 'presscore_get_dynamic_stylesheets_list', $dynamic_stylesheets );

		// Backward compatibility.
		foreach ( $dynamic_stylesheets as &$stylesheet ) {
			$stylesheet['src'] = str_replace( PRESSCORE_THEME_URI . '/css/', '', $stylesheet['src'] );
		}

		return $dynamic_stylesheets;
	}

endif;

if ( ! function_exists( 'presscore_enqueue_dynamic_stylesheets' ) ) :

	/**
	 * Enqueue *.less files
	 */
	function presscore_enqueue_dynamic_stylesheets() {
		include_once PRESSCORE_CLASSES_DIR . '/less/The7_Dynamic_Stylesheet.php';

		$dynamic_stylesheets = presscore_get_dynamic_stylesheets_list();
		$css_cache = presscore_get_dynamic_css_cache();
		$css_version = presscore_get_dynamic_css_version();

		foreach ( $dynamic_stylesheets as $handle => $stylesheet ) {
			$stylesheet_obj = new The7_Dynamic_Stylesheet( $handle, $stylesheet['src'] );
			$stylesheet_obj->setup_with_array( $stylesheet );
			$stylesheet_obj->set_version( $css_version );

			if ( is_array( $css_cache ) && array_key_exists( $handle, $css_cache ) ) {
				$stylesheet_obj->set_css_body( $css_cache[ $handle ] );
			}

			$stylesheet_obj->enqueue();
		}

		do_action( 'presscore_enqueue_dynamic_stylesheets' );
	}

endif;

if ( ! function_exists( 'presscore_regenerate_dynamic_css' ) ) :

	function presscore_regenerate_dynamic_css( $dynamic_css ) {
		include_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/less-functions.php';
		include_once PRESSCORE_DIR . '/less-vars.php';
		include_once PRESSCORE_CLASSES_DIR . '/less/The7_Less_Compiler.php';
		include_once PRESSCORE_CLASSES_DIR . '/less/The7_Dynamic_Stylesheet.php';

		$wp_upload = wp_get_upload_dir();
		$less_vars = presscore_compile_less_vars();
		$lessc = new The7_Less_Compiler( $less_vars );

		// Compile beautiful loading css.
		$beautiful_loading_css = $lessc->compile_file( The7_Dynamic_Stylesheet::get_theme_css_dir() . '/beautiful-loading.less' );
		presscore_cache_loader_inline_css( $beautiful_loading_css );
		unset( $beautiful_loading_css );

		if ( $lessc->is_writable( $wp_upload['basedir'] ) ) {
			update_option( 'presscore_less_css_is_writable', 1 );
			presscore_set_dynamic_css_cache( array() );

			// Save version.
			$stylesheet_version = substr( md5( PRESSCORE_STYLESHEETS_VERSION . '-' . time() ), 20 );
			presscore_set_dynamic_css_version( $stylesheet_version );

			// Compile less.
			foreach ( $dynamic_css as $handle => $stylesheet ) {
				$stylesheet_obj = new The7_Dynamic_Stylesheet( $handle, $stylesheet['src'] );

				if ( ! empty( $stylesheet['path'] ) ) {
					$stylesheet_obj->set_less_file( $stylesheet['path'] );
				}

				$lessc->compile_to_file( $stylesheet_obj->get_less_file(), $stylesheet_obj->get_css_file() );
			}
		} else {
			update_option( 'presscore_less_css_is_writable', 0 );

			// Save css body in db.
			$dynamic_css_cache = array();
			foreach ( $dynamic_css as $handle => $stylesheet ) {
				$stylesheet_obj = new The7_Dynamic_Stylesheet( $handle, $stylesheet['src'] );

				if ( ! empty( $stylesheet['path'] ) ) {
					$stylesheet_obj->set_less_file( $stylesheet['path'] );
				}

				$dynamic_css_cache[ $handle ] = $lessc->compile_file( $stylesheet_obj->get_less_file() );
			}
			presscore_set_dynamic_css_cache( $dynamic_css_cache );
		}
	}

endif;

function presscore_set_dynamic_css_cache( $dynamic_css ) {
	update_option( 'the7_dynamic_css_cache', $dynamic_css );
}

function presscore_get_dynamic_css_cache() {
	return (array) get_option( 'the7_dynamic_css_cache', array() );
}

function presscore_set_dynamic_css_version( $version ) {
	update_option( 'the7_dynamic_css_version', $version );
}

function presscore_get_dynamic_css_version() {
	return get_option( 'the7_dynamic_css_version' );
}

if ( ! function_exists( 'the7_maybe_regenerate_dynamic_css' ) ) :

	/**
	 * Regenerate dynamic css by force if needed.
	 *
	 * This function used mostly for after theme update stylesheets refresh.
	 *
	 * @since 5.5.0
	 */
	function the7_maybe_regenerate_dynamic_css() {
		if ( ! presscore_force_regenerate_css() ) {
			return;
		}

		presscore_set_force_regenerate_css( false );
		$dynamic_stylesheets = presscore_get_dynamic_stylesheets_list();
		try {
			presscore_regenerate_dynamic_css( $dynamic_stylesheets );
		} catch ( Exception $e ) {
			// Do nothing.
		}
	}

endif;

if ( ! function_exists( 'presscore_compile_loader_css' ) ) :

	/**
	 * Compile inline loader css from .less files.
	 *
	 * Compiled css will be cached in db. Lunches after theme options save.
	 *
	 * @since  3.3.2
	 * @return string
	 */
	function presscore_compile_loader_css() {
		include_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/less-functions.php';
		include_once PRESSCORE_DIR . '/less-vars.php';
		include_once PRESSCORE_CLASSES_DIR . '/less/The7_Less_Compiler.php';
		include_once PRESSCORE_CLASSES_DIR . '/less/The7_Dynamic_Stylesheet.php';

		$less_vars = presscore_compile_less_vars();
		$lessc = new The7_Less_Compiler( $less_vars );
		$css = $lessc->compile_file( The7_Dynamic_Stylesheet::get_theme_css_dir() . '/beautiful-loading.less' );

		return $css;
	}

endif;

if ( ! function_exists( 'presscore_cache_loader_inline_css' ) ) :

	/**
	 * Cahce bautiful loader inline css.
	 *
	 * @since 3.3.2
	 * @param  string $css
	 * @return string
	 */
	function presscore_cache_loader_inline_css( $css ) {
		update_option( 'the7_beautiful_loader_inline_css', $css );

		return $css;
	}

endif;

if ( ! function_exists( 'presscore_get_loader_inline_css' ) ) :

	/**
	 * This function returns compiled loader css.
	 *
	 * First of all function attempts to read css from cache, if false then regenerate it manually.
	 * 
	 * @since 3.3.2
	 * @return string
	 */
	function presscore_get_loader_inline_css() {
		$css = apply_filters( 'presscore_pre_get_loader_inline_css', '' );
		if ( $css ) {
			return $css;
		}

		$css = get_option( 'the7_beautiful_loader_inline_css' );

		return apply_filters( 'presscore_get_loader_inline_css', $css );
	}

endif;

if ( ! function_exists( 'presscore_force_regenerate_css' ) ) :

	/**
	 * Get regenerate css from less flag.
	 * 
	 * @return boolean
	 */
	function presscore_force_regenerate_css() {
		return get_option( 'the7_force_regen_css' );
	}

endif;

if ( ! function_exists( 'presscore_set_force_regenerate_css' ) ) :

	/**
	 * Set force regenerate css from less flag.
	 * 
	 * @param  boolean $force
	 * @return boolean
	 */
	function presscore_set_force_regenerate_css( $force = false ) {
		return update_option( 'the7_force_regen_css', $force );
	}

endif;

if ( ! function_exists( 'presscore_refresh_dynamic_css' ) ) :

	/**
	 * Setup theme to regen dynamic stylesheets on next page load.
	 *
	 * @since 3.7.0
	 */
	function presscore_refresh_dynamic_css() {
		presscore_set_force_regenerate_css( true );
		presscore_cache_loader_inline_css( '' );
	}

endif;