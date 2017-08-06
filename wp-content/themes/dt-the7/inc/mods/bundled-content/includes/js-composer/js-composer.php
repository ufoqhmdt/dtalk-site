<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class The7_jsComposer extends BundledContent {

	protected static $field_prefix = 'wpb_js_';

	public function activatePlugin() {
		if ( $this->isActivatedPlugin() ) {
			return;
		}

		if ( ! defined( 'JS_COMPOSER_THE7' ) ) {
			$this->deactivatePlugin();
			return;
		}

		$this->disableComposerNotification();

		if ( $this->isActivatedByTheme() ) {
			add_filter( 'vc_page-welcome-slugs-list', array( &$this, 'the7_vc_page_welcome_slugs_list' ), 30 );
			return;
		}
		update_site_option( self::$field_prefix . 'the7_js_composer_purchase_code', presscore_get_purchase_code() );
	}

	public function deactivatePlugin() {
		$this->disableComposerNotification();

		if ( $this->isActivatedByTheme() ) {
			update_site_option( self::$field_prefix . 'the7_js_composer_purchase_code', '' );
		}
	}

	public function isActivatedPlugin() {
		$code = get_site_option( self::$field_prefix . 'js_composer_purchase_code', '' );

		return (bool) $code;
	}

	public function getBundledPluginCode() {
		return get_site_option( self::$field_prefix . 'the7_js_composer_purchase_code', '' );
	}

	public static function vc_set_as_theme() {
		if ( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme();
		}
	}

	private function disableComposerNotification() {
		if ( function_exists( 'vc_manager' ) ) {
			$isActivated = $this->isActivatedPlugin();
			$isActivateByTheme = $this->isActivatedByTheme();
			if ( dt_is_plugins_silenced() ) {
				if ( ! $isActivated && ! $isActivateByTheme ) {
					// Hide activation message.
					add_action( 'vc_before_init', array( __CLASS__, 'vc_set_as_theme' ) );

					// Show design tabs.
					add_filter( 'vc_settings_page_show_design_tabs', '__return_true' );

					// Disable updater.
					vc_manager()->disableUpdater();
				}
			}
			if ( ! $isActivated && $isActivateByTheme ) {
					// Disable updater.
					vc_manager()->disableUpdater();
			}
		}
	}

	public static function the7_vc_page_welcome_slugs_list( $dashboard_array ) {
		$excludeFromDashboard = array( 'vc-resources' );
		foreach ( $excludeFromDashboard as $dashboard_element ) {
			if ( isset( $dashboard_array[ $dashboard_element ] ) ) {
				unset( $dashboard_array[ $dashboard_element ] );
			}
		}

		return $dashboard_array;
	}

}