<?php

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Back compatibility for the7 older 6.3.1
if ( ! has_filter( 'the7_shortcodeaware_excerpt', 'the7_shortcodeaware_excerpt_filter' ) && function_exists( 'vc_manager' ) ) {
	add_filter( 'the7_shortcodeaware_excerpt', array( vc_manager()->vc(), 'excerptFilter' ), 20 );
}

/**
 * Return The7 theme version or null if it's not defined as a constant.
 *
 * @return null|string
 */
function the7pt_get_theme_version() {
	return ( defined( 'PRESSCORE_STYLESHEETS_VERSION' ) ? PRESSCORE_STYLESHEETS_VERSION : null );
}

/**
 * @param $ver
 *
 * @return bool
 */
function the7pt_is_theme_version_greater_or_equal_to( $ver ) {
	return version_compare( the7pt_get_theme_version(), $ver, '>=' );
}

/**
 * @param $ver
 *
 * @return bool
 */
function the7pt_is_theme_version_smaller_or_equal_to( $ver ) {
	return version_compare( the7pt_get_theme_version(), $ver, '<=' );
}