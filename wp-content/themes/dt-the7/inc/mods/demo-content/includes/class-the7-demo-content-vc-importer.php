<?php

/**
 * Class The7_Demo_Content_VC_Importer
 */
class The7_Demo_Content_VC_Importer {

	/**
	 * Import VC settings.
	 *
	 * @param array $settings
	 *
	 * @return bool
	 */
	public function import_settings( $settings ) {
		if ( ! class_exists( 'WPBakeryVisualComposerSettings', false ) || ! method_exists( 'WPBakeryVisualComposerSettings', 'set' ) ) {
			return false;
		}

		// Setup settings.
		foreach ( $settings as $key => $value ) {
			WPBakeryVisualComposerSettings::set( $key, $value );
		}

		return true;
	}

	/**
	 * Remove 'less_version' option so vc will show notice that user need to save settings.
	 *
	 * @return bool
	 */
	public function show_notification() {
		if ( ! class_exists( 'WPBakeryVisualComposerSettings', false ) || ! method_exists( 'WPBakeryVisualComposerSettings', 'getFieldPrefix' ) ) {
			return false;
		}

		/**
		 * Display notice about saving VC settings.
		 * @see vc_check_for_custom_css_build()
		 */
		delete_option( WPBakeryVisualComposerSettings::getFieldPrefix() . 'less_version' );

		return true;
	}
}