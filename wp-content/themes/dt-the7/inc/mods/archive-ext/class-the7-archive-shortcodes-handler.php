<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class The7_Archive_Shortcodes_Handler
 */
class The7_Archive_Shortcodes_Handler extends The7_Orphaned_Shortcodes_Handler {

	protected $cache_option_id = 'the7_archive_inline_css';

	public function get_unique_id( DT_Shortcode_With_Inline_Css $shortcode_obj ) {
		$str = 'archive-';

		return $str . md5( $shortcode_obj->get_tag() . json_encode( $shortcode_obj->get_atts() ) );
	}

	public function use_global_wp_query( $_ ) {
		global $wp_query;

		return $wp_query;
	}

	public function add_hooks() {
		parent::add_hooks();

		add_filter( 'the7_shortcode_query', array( $this, 'use_global_wp_query' ) );
	}

	public function remove_hooks() {
		parent::remove_hooks();

		remove_filter( 'the7_shortcode_query', array( $this, 'use_global_wp_query' ) );
	}

	public function add_cache_invalidation_hooks() {
		add_action( 'optionsframework_after_validate', array( $this, 'clear_cache' ) );
		add_action( 'optionsframework_after_options_reset', array( $this, 'clear_cache' ) );
	}
}