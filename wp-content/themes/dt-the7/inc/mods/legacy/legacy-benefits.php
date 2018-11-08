<?php

class Presscore_Modules_Legacy_Benefits {

	public static function launch() {
		add_action( 'after_setup_theme', array( __CLASS__, 'turn_off_benefits' ), 9 );
	}

	public static function turn_off_benefits() {
		$supported_modules = get_theme_support( 'presscore-modules' );

		if ( empty( $supported_modules[0] ) ) {
			return;
		}

		$modules = array_diff( $supported_modules[0], array( 'benefits' ) );

		add_theme_support( 'presscore-modules', $modules );
	}
}