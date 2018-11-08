<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class The7_Archive_Shortcodes_Manager
 */
class The7_Archive_Shortcodes_Manager {

	/**
	 * @var The7_Archive_Shortcodes_Handler $handler
	 */
	protected $handler;

	/**
	 * @var The7_Archive_Shortcodes_Map $map
	 */
	protected $map;

	/**
	 * @var array $shortcode_atts
	 */
	protected $shortcode_atts = array();

	/**
	 * @var string $shortcode_tag
	 */
	protected $shortcode_tag = '';

	protected $shortcode_obj;

	/**
	 * The7_Archive_Shortcodes_Manager constructor.
	 *
	 * @param The7_Archive_Shortcodes_Map     $map
	 * @param The7_Archive_Shortcodes_Handler $handler
	 */
	public function __construct( The7_Archive_Shortcodes_Map $map, The7_Archive_Shortcodes_Handler $handler ) {
		$this->map = $map;
		$this->handler = $handler;
	}

	/**
	 * @param string $content
	 *
	 * @return bool
	 */
	public function match_shortcode( $content ) {
		$pattern = get_shortcode_regex( $this->map->get_tags() );
		if ( preg_match_all( '/' . $pattern . '/s', $content, $matches ) && array_key_exists( 2, $matches ) ) {
			$this->shortcode_tag = $matches[2][0];
			$this->shortcode_atts = shortcode_parse_atts( $matches[3][0] );

			$class_name = $this->map->get_class_name( $this->shortcode_tag );
			if ( class_exists( $class_name ) ) {
				$this->shortcode_obj = new $class_name();

				return true;
			}
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function get_shortcode_atts() {
		return $this->shortcode_atts;
	}

	/**
	 * @param array $atts
	 */
	public function set_shortcode_atts( $atts ) {
		$this->shortcode_atts = $atts;
	}

	/**
	 * @return string
	 */
	public function get_shortcode_tag() {
		return $this->shortcode_tag;
	}

	/**
	 * Add cache invalidation hooks.
	 */
	public function add_cache_invalidation_hooks() {
		$this->handler->add_cache_invalidation_hooks();
	}

	/**
	 * Output matched shortcode.
	 */
	public function display_shortcode() {
		if ( is_object( $this->shortcode_obj ) ) {
			$this->handler->add_hooks();
			echo $this->shortcode_obj->shortcode( $this->shortcode_atts, '' );
			$this->handler->remove_hooks();
		}
	}
}

