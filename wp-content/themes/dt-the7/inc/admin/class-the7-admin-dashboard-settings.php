<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'The7_Admin_Dashboard_Settings', false ) ) {

	class The7_Admin_Dashboard_Settings {

		const SETTINGS_ID = 'the7_dashboard_settings';

		static $settings = array(
			'db-auto-update' => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'fontawesome-4-compatibility' => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'options-in-sidebar'  => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'rows'                => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'overlapping-headers' => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'portfolio-layout'    => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'icons-bar'           => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'portfolio'           => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'portfolio-slug'      => array(
				'type' => 'text',
				'std'  => 'project',
			),
			'testimonials'        => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'team'                => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'team-slug'           => array(
				'type' => 'text',
				'std'  => 'dt_team',
			),
			'logos'               => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'benefits'            => array(
				'type' => 'checkbox',
				'std'  => false,
			),
			'albums'              => array(
				'type' => 'checkbox',
				'std'  => true,
			),
			'albums-slug'         => array(
				'type' => 'text',
				'std'  => 'dt_gallery',
			),
			'slideshow'           => array(
				'type' => 'checkbox',
				'std'  => true,
			),
		);

		/**
		 * Setup settings, add hooks.
		 */
		public static function setup() {
			add_action( 'wp_ajax_the7_save_dashboard_settings', array( __CLASS__, '_save_via_ajax' ) );

			self::setup_rewrite_filters();
		}

		/**
		 * Setup rewrite rules override and refresh is necessary.
		 */
		protected static function setup_rewrite_filters() {
			$post_types = array(
				array(
					'setting' => 'portfolio-slug',
				    'name' => 'dt_portfolio'
				),
				array(
					'setting' => 'albums-slug',
					'name' => 'dt_gallery'
				),
				array(
					'setting' => 'team-slug',
					'name' => 'dt_team'
				)
			);

			foreach ( $post_types as $post_type ) {
				$rewrite_data_provider = new Presscore_Post_Type_Rewrite_Rules_Option_DashboardSettings( $post_type['setting'] );
				$rewrite_filter = new Presscore_Post_Type_Rewrite_Rules_Filter( $rewrite_data_provider );

				add_filter( "presscore_post_type_{$post_type['name']}_args", array( $rewrite_filter, 'filter_post_type_rewrite' ), 99 );
				add_action( 'the7_dashboard_before_settings_save', array( $rewrite_filter, 'flush_rules_after_slug_change' ) );
			}
		}

		/**
		 * Return setting.
		 *
		 * @param string $name
		 * @param null $default
		 *
		 * @return mixed
		 */
		public static function get( $name, $default = null ) {
			if ( ! array_key_exists( $name, self::$settings ) ) {
				return $default;
			}

			$settings = get_option( self::SETTINGS_ID, array() );

			if ( array_key_exists( $name, $settings ) ) {
				return $settings[ $name ];
			}

			if ( is_null( $default ) ) {
				return self::$settings[ $name ]['std'];
			}

			return $default;
		}

		/**
		 * Set setting.
		 *
		 * @param string $name
		 * @param mixed $value
		 *
		 * @return bool
		 */
		public static function set( $name, $value ) {
			$settings = get_option( self::SETTINGS_ID, array() );

			if ( ! is_array( $settings ) ) {
				$settings = array();
			}

			$settings[ $name ] = $value;

			return update_option( self::SETTINGS_ID, $settings );
		}

		/**
		 * Check existence of settings in db.
		 *
		 * @return bool
		 */
		public static function exists() {
			return ( false !== get_option( self::SETTINGS_ID ) );
		}

		/**
		 * Ajax callback.
		 */
		public static function _save_via_ajax() {
			check_ajax_referer( self::SETTINGS_ID . '-save' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_send_json_error( __( 'Current user cannot modify legacy settings', 'the7mk2' ) );
			}

			$new_settings = array();
			if ( isset( $_POST[ self::SETTINGS_ID ] ) && is_array( $_POST[ self::SETTINGS_ID ] )) {
				$new_settings = $_POST[ self::SETTINGS_ID ];
			}

			$settings = array();
			foreach ( self::$settings as $id => $_data ) {
				$new_setting_exists = array_key_exists( $id, $new_settings );

				if ( 'checkbox' == $_data['type'] ) {
					$settings[ $id ] = $new_setting_exists;
					continue;
				}

				if ( $new_setting_exists ) {
					$settings[ $id ] = $new_settings[ $id ];
				}
			}

			do_action( 'the7_dashboard_before_settings_save', $settings );

			update_option( self::SETTINGS_ID, $settings );

			wp_send_json_success( $new_settings );
		}
	}

}