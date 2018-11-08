<?php
/**
 * Admin notices hooks.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'The7_Admin_Notices', false ) ) {
	include_once( PRESSCORE_EXTENSIONS_DIR . '/class-the7-admin-notices.php' );
}

/**
 * Return object that handle admin notices.
 * @return The7_Admin_Notices
 */
function the7_admin_notices() {
	static $admin_notices = null;

	if ( is_null( $admin_notices ) ) {
		$admin_notices = new The7_Admin_Notices();
	}

	return $admin_notices;
}

/**
 * Enqueue admin notices scripts.
 */
function the7_admin_notices_scripts() {
	the7_register_script( 'the7-admin-notices', PRESSCORE_ADMIN_URI . '/assets/js/admin-notices', array( 'jquery' ), false, true );

	wp_enqueue_script( 'the7-admin-notices' );
	wp_localize_script( 'the7-admin-notices', 'the7Notices', array( '_ajax_nonce' => the7_admin_notices()->get_nonce() ) );
}

/**
 * Main function to handle custom admin notices. Adds action handlers.
 */
function the7_admin_notices_bootstrap() {
	$notices = the7_admin_notices();

	add_action( 'admin_enqueue_scripts', 'the7_admin_notices_scripts', 9999 );
	add_action( 'wp_ajax_the7-dismiss-admin-notice', array( $notices, 'dismiss_notices' ) );
	add_action( 'admin_notices', array( $notices, 'print_admin_notices' ), 40 );
}
add_action( 'admin_init', 'the7_admin_notices_bootstrap' );
