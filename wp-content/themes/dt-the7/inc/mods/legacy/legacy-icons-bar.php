<?php

class Presscore_Modules_Legacy_Icons_Bar {

	public static function launch() {
		add_action( 'after_setup_theme', array( __CLASS__, 'turn_off_icons_bar' ), 9 );
	}

	public static function turn_off_icons_bar() {
		$supported_modules = get_theme_support( 'presscore-modules' );

		if ( empty( $supported_modules[0] ) ) {
			return;
		}

		$modules = array_diff( $supported_modules[0], array( 'admin-icons-bar' ) );

		add_theme_support( 'presscore-modules', $modules );
	}
}