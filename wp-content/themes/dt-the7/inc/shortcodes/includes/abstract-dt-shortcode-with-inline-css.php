<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DT_Shortcode_With_Inline_Css
 */
abstract class DT_Shortcode_With_Inline_Css extends DT_Shortcode {

	const INLINE_CSS_META_KEY = 'the7_shortcodes_inline_css';

	/**
	 * Shortcode name.
	 *
	 * @var string
	 */
	protected $sc_name;

	/**
	 * Shortcode attributes.
	 *
	 * @var array
	 */
	protected $atts = array();

	/**
	 * Shortcode default attributes.
	 *
	 * @var array
	 */
	protected $default_atts = array();

	/**
	 * Shortcode unique id.
	 *
	 * @var int
	 */
	protected $sc_id = 1;

	/**
	 * Shortcode unique class base part.
	 *
	 * @var string
	 */
	protected $unique_class_base = '';

	/**
	 * Shortcode unique class. Generated with DT_Shortcode_With_Inline_Css::get_unique_class().
	 *
	 * @var string
	 */
	protected $unique_class = '';

	/**
	 * @var bool
	 */
	protected $doing_shortcode = false;

	/**
	 * @var bool
	 */
	protected static $inline_css_printed = true;

	/**
	 * DT_Shortcode_With_Inline_Css constructor.
	 */
	public function __construct() {
		add_filter( "the7_generate_sc_{$this->sc_name}_css", array( $this, 'generate_inline_css' ), 10, 2 );
	}

	public function get_tag() {
		return $this->sc_name;
	}

	public function reset_id() {
		$this->sc_id = 1;
	}

	/**
	 * Base shortcode callback. Return shortcode HTML.
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public function shortcode( $atts, $content = '' ) {
		if ( $this->doing_shortcode ) {
			return '';
		}

		$this->init_shortcode( $atts );

		do_action( 'the7_after_shortcode_init', $this );

		if ( presscore_vc_is_inline() && $vc_inline_html = $this->get_vc_inline_html() ) {
			return $vc_inline_html;
		}

		$this->backup_post_object();
		$this->backup_theme_config();

		ob_start();
		$this->doing_shortcode = true;

		do_action( 'the7_before_shortcode_output', $this );

		$this->setup_config();
		$this->print_inline_css();
		$this->do_shortcode( $atts, $content );

		do_action( 'the7_after_shortcode_output', $this );

		$this->doing_shortcode = false;
		$output = ob_get_clean();

		$this->restore_theme_config();
		$this->restore_post_object();

		return $output;
	}

	/**
	 * Generate shortcode inline css from provided less file.
	 *
	 * @param string $css
	 * @param array  $atts
	 *
	 * @return string
	 */
	public function generate_inline_css( $css = '', $atts = array() ) {
		if ( ! class_exists( 'the7_lessc', false ) ) {
			return $css;
		}

		$this->init_shortcode( $atts );

		do_action( 'the7_after_shortcode_init', $this );

		$less_file_name = $this->get_less_file_name();

		try {
			$lessc = new the7_lessc();

			// Include custom lessphp functions.
			require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/less-functions.php';
			require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-lessphp-functions.php';

			DT_LessPHP_Functions::register_functions( $lessc );

			$lessc->setImportDir( array( PRESSCORE_THEME_DIR . '/css/dynamic-less/shortcodes' ) );
			$lessc->setVariables( (array) $this->get_less_vars() );
			$css .= $lessc->compileFile( $less_file_name );
		} catch ( Exception $e ) {
			return $css . "/*\n" . $e->getMessage() . "\n*/\n";
		}

		return $css;
	}

	/**
	 * Register shortcode.
	 *
	 * @uses DT_Shortcode_With_Inline_Css::sc_name
	 */
	public function add_shortcode() {
		if ( $this->sc_name ) {
			add_shortcode( $this->sc_name, array( $this, 'shortcode' ) );
		}
	}

	/**
	 * Output shortcode HTML.
	 *
	 * @param array  $atts
	 * @param string $content
	 */
	abstract protected function do_shortcode( $atts, $content = '' );

	/**
	 * Setup theme config for shortcode.
	 */
	abstract protected function setup_config();

	/**
	 * Return array of prepared less vars to insert to less file.
	 *
	 * @return array
	 */
	abstract protected function get_less_vars();

	/**
	 * Return shortcode less file absolute path to output inline.
	 *
	 * @return string
	 */
	abstract protected function get_less_file_name();

	/**
	 * Return dummy html for VC inline editor.
	 *
	 * @return string
	 */
	abstract protected function get_vc_inline_html();

	/**
	 * Initialize shortcode.
	 *
	 * @param array $atts
	 */
	protected function init_shortcode( $atts = array() ) {
		$this->atts = shortcode_atts( $this->default_atts, $atts );
		$this->unique_class = '';
	}

	/**
	 * Return unique shortcode class like {$unique_class_base}-{$sc_id}.
	 *
	 * @return string
	 */
	public function get_unique_class() {
		if ( ! $this->unique_class ) {
			$this->unique_class = $this->unique_class_base . '-' . md5( $this->get_tag() . json_encode( $this->atts ) );
		}

		return $this->unique_class;
	}

	public function set_unique_class( $class ) {
		$this->unique_class = $class;
	}

	public function allow_to_print_inline_css() {
		self::$inline_css_printed = false;
	}

	/**
	 * Return $att_name attribute value or default one if empty.
	 *
	 * @param string $att_name
	 * @param string $default
	 *
	 * @return string
	 */
	protected function get_att( $att_name, $default = null ) {
		if ( array_key_exists( $att_name, $this->atts ) && '' !== $this->atts[ $att_name ] ) {
			return $this->atts[ $att_name ];
		}

		if ( ! is_null( $default ) ) {
			return $default;
		}

		if ( array_key_exists( $att_name, $this->default_atts ) ) {
			return $this->default_atts[ $att_name ];
		}

		return '';
	}

	public function get_atts() {
		return $this->atts;
	}

	/**
	 * Return sanitized boolean value.
	 *
	 * @param string $att_name
	 * @param string $default
	 *
	 * @return bool
	 */
	protected function get_flag( $att_name, $default = null ) {
		return apply_filters( 'dt_sanitize_flag', $this->get_att(  $att_name, $default ) );
	}

	/**
	 * Print inline css. It depends on self::$inline_css_printed and output only if it's false.
	 *
	 * @return bool
	 */
	protected function print_inline_css() {
		if ( self::$inline_css_printed ) {
			return false;
		}

		self::$inline_css_printed = true;

		$inline_css = get_post_meta( get_the_ID(), self::INLINE_CSS_META_KEY, true );

		/**
		 * Allow to change shortcodes inline css before output.
		 *
		 * @since 6.0.0
		 */
		$inline_css = apply_filters( 'the7_shortcodes_get_inline_css', $inline_css, $this );

		if ( $inline_css ) {
			echo '<style type="text/css" data-type="the7_shortcodes-inline-css">';
			echo $inline_css;
			echo '</style>';
		}

		return true;
	}

}