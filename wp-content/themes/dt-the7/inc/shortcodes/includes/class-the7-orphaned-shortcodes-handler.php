<?php
class The7_Orphaned_Shortcodes_Handler {
	protected $id = 1;

	protected $cache_option_id = 'the7_orphaned_shortcodes_inline_css';

	public function set_unique_shortcode_id( DT_Shortcode_With_Inline_Css $shortcode_obj ) {
		$shortcode_obj->allow_to_print_inline_css();
		$shortcode_obj->set_unique_class( $this->get_unique_id( $shortcode_obj ) );
	}

	public function get_unique_id( DT_Shortcode_With_Inline_Css $shortcode_obj ) {
		$str = 'orphaned-shortcode-';

		return $str . md5( $shortcode_obj->get_tag() . json_encode( $shortcode_obj->get_atts() ) );
	}

	public function get_inline_css( $_, $shortcode_obj = null ) {
		if ( ! is_a( $shortcode_obj, 'DT_Shortcode_With_Inline_Css' ) ) {
			return '';
		}

		$css_list = (array) get_option( $this->cache_option_id, array() );
		$unique_id = $this->get_unique_id( $shortcode_obj );

		if ( array_key_exists( $unique_id,  $css_list ) ) {
			return $css_list[ $unique_id ];
		}

		$css = $css_list[ $unique_id ] = $this->generate_inline_css( $shortcode_obj );
		update_option( $this->cache_option_id, $css_list );

		return $css;
	}

	public function generate_inline_css( DT_Shortcode_With_Inline_Css $shortcode_obj ) {
		if ( ! class_exists( 'the7_lessc', false ) ) {
			include PRESSCORE_DIR . '/vendor/lessphp/the7_lessc.inc.php';
		}

		return $shortcode_obj->generate_inline_css( '', $shortcode_obj->get_atts() );
	}

	public function increment_inner_id() {
		++$this->id;
	}

	public function clear_cache() {
		delete_option( $this->cache_option_id );
	}

	public function add_cache_invalidation_hooks() {
		add_action( 'optionsframework_after_validate', array( $this, 'clear_cache' ) );
		add_action( 'optionsframework_after_options_reset', array( $this, 'clear_cache' ) );
	}

	public function add_hooks() {
		add_action( 'the7_after_shortcode_init', array( $this, 'set_unique_shortcode_id' ) );
		add_action( 'the7_after_shortcode_output', array( $this, 'increment_inner_id' ) );
		add_filter( 'the7_shortcodes_get_inline_css', array( $this, 'get_inline_css' ), 10, 2 );
	}

	public function remove_hooks() {
		remove_action( 'the7_after_shortcode_init', array( $this, 'set_unique_shortcode_id' ) );
		remove_action( 'the7_after_shortcode_output', array( $this, 'increment_inner_id' ) );
		remove_filter( 'the7_shortcodes_get_inline_css', array( $this, 'get_inline_css' ) );
	}
}
