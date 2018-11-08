<?php
/**
 * Legacy module.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Presscore_Modules_Legacy' ) ) :

	class Presscore_Modules_Legacy {

		const STATE_OPTION_ID = 'the7_legacy_state';

		/**
		 * Legacy settings ids.
		 *
		 * @var array
		 */
		static $settings = array();

		/**
		 * Execute module.
		 */
		public static function execute() {
			self::$settings = array(
				'rows',
				'icons-bar',
			    'overlapping-headers',
			);

			if ( dt_the7_core_is_enabled() ) {
				self::$settings = array_merge( self::$settings, array(
					'benefits',
					'logos',
					'portfolio-layout',
				) ) ;
			}

			if ( ! defined( 'DOING_AJAX' ) ) {
				add_action( 'admin_init', array( __CLASS__, 'regenerate_css_on_legacy_activation' ) );
			}

			self::handle_legacy_code();
		}

		/**
		 * Regenerate css on legacy state change.
		 */
		public static function regenerate_css_on_legacy_activation() {
			$current_state = self::is_legacy_mode_active();
			$previous_state = self::get_previous_state();

			if ( $previous_state === $current_state ) {
				return;
			}

			if ( false === $previous_state && $current_state ) {
				presscore_set_force_regenerate_css( true );
			}

			self::set_state( $current_state );
		}

		/**
		 * Handle legacy code hideout.
		 */
		public static function handle_legacy_code() {
			$base_dir = dirname( __FILE__ );

			foreach ( self::$settings as $id ) {
				if ( The7_Admin_Dashboard_Settings::get( $id ) ) {
					continue;
				}

				$file_name = "{$base_dir}/legacy-{$id}.php";
				if ( file_exists( $file_name ) ) {
					include $file_name;
				}

				$class_name = self::get_class_name( $id );

				if ( class_exists( $class_name ) && is_callable( array( $class_name, 'launch' ) ) ) {
					call_user_func( array( $class_name, 'launch' ) );
				}
			}
		}

		/**
		 * Prepare legacy handler class name.
		 *
		 * @param string $id
		 *
		 * @return string
		 */
		protected static function get_class_name( $id ) {
			$class_name = 'Presscore_Modules_Legacy_';
			$class_name .= implode( '_', array_map( array( __CLASS__, 'sanitize_handler_class_name' ), explode( '-', $id ) ) );

			return $class_name;
		}

		/**
		 * Sanitize class name part.
		 *
		 * @param string $name
		 *
		 * @return string
		 */
		public static function sanitize_handler_class_name( $name ) {
			return ucfirst( strtolower( $name ) );
		}

		/**
		 * Returns true if legacy mode is active.
		 *
		 * @return bool
		 */
		public static function is_legacy_mode_active() {
			// Do not count icons-bar.
			$settings = array_diff( self::$settings, array( 'icons-bar' ) );

			foreach ( $settings as $id ) {
				if ( The7_Admin_Dashboard_Settings::get( $id ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Get previous legacy state.
		 *
		 * @return bool|null
		 */
		public static function get_previous_state() {
			$state = get_option( self::STATE_OPTION_ID );
			if ( false === $state ) {
				return null;
			}

			return (bool) $state;
		}

		/**
		 * Set state.
		 *
		 * @param $value
		 *
		 * @return bool
		 */
		public static function set_state( $value ) {
			return update_option( self::STATE_OPTION_ID, absint( $value ) );
		}
	}

	Presscore_Modules_Legacy::execute();

endif;