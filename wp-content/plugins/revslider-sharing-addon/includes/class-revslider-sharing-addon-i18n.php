<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.themepunch.com
 * @since      1.0.0
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/includes
 * @author     ThemePunch <info@themepunch.com>
 */
class Revslider_Sharing_Addon_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'revslider-sharing-addon',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
