<?php
/**
 * Default button shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'abstract-dt-shortcode-with-inline-css.php';

if ( ! class_exists( 'DT_Shortcode_Default_Button', false ) ) {

	class DT_Shortcode_Default_Button extends DT_Shortcode_With_Inline_Css {
		protected $content = '';

		protected $shortcode_id = 0;

		protected $button_id = '';

		public static $instance = null;
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		//protected function sanitize_attributes( &$atts ) {
		public function __construct() {
			$this->sc_name = 'dt_default_button';
			$this->unique_class_base = 'default-btn';
			$this->default_atts = array(
				'size'                   => 'small',
				'link'                   => '',
				'default_btn_bg_color'               => '',
				'bg_hover_color'         => '',
				'text_color'             => '',
				'text_hover_color'       => '',
				'animation'              => 'none',
				'icon_type'              => 'html',
				'icon'                   => '',
				'icon_align'             => 'left',
				'button_alignment'       => 'btn_inline_left',
				'smooth_scroll'          => 'n',
				'btn_width'         	 => 'btn_auto_width',
				'custom_btn_width'		 => '200px',
				'el_class'               => '',
				'css'         			 => '',
			);
			parent::__construct();
		}

		protected function do_shortcode( $atts, $content = '' ) {
			// setup button id
			$this->shortcode_id++;
			$this->button_id = esc_attr( 'default-btn-' . $this->shortcode_id );

			// store content
			$this->content = trim( preg_replace( '/<\/?p\>/', '', $content ) );

			// return html
			echo $this->get_html();
		}
		protected function get_html() {
			$before_title = $after_title = $btn_width = '';
			$attributes = &$this->atts;

			$attributes['icon_align'] = sanitize_key( $attributes['icon_align'] );
			$attributes['button_alignment'] = sanitize_key( $attributes['button_alignment'] );
			$attributes['link'] = $attributes['link'] ? esc_attr( $attributes['link'] ) : '#';
			$attributes['smooth_scroll'] = apply_filters( 'dt_sanitize_flag', $attributes['smooth_scroll'] );
			$attributes['el_class'] = esc_attr( $attributes['el_class'] );

			if ( $attributes['icon'] ) {

				if ( preg_match( '/^fa\s(fa|icon)-(\w)/', $attributes['icon'] ) ) {
					$attributes['icon'] = '<i class="' . esc_attr( $attributes['icon'] ) . '"></i>';
				} else {
					$attributes['icon'] = wp_kses( rawurldecode( base64_decode( $attributes['icon'] ) ), array( 'i' => array( 'class' => array() ) ) );
				}

			}

			// add icon
			$icon_type = $this->atts['icon_type'];
			$icon = $this->get_icon( $icon_type );
			if ('btn_fixed_width' ==  $this->atts['btn_width'] ) {
				$btn_width .= ' style="width:' . absint( $this->atts['custom_btn_width'] ) . 'px;"' ;
			}
			if ( $icon ) {
				if ( 'right' == $this->atts['icon_align'] ) {
					$after_title = $icon;
				} else {
					$before_title = $icon;
				}
			}

			$link_title = $target = $rel = '';
			$url = esc_attr( $this->atts['link'] );
			if ( ! empty( $this->atts['link'] ) && function_exists( 'vc_build_link' ) ) {
				$href = vc_build_link( $this->atts['link'] );
				if ( ! empty( $href['url'] ) ) {
					$url = esc_attr( $href['url'] );
					$target = ( empty( $href['target'] ) ? '' : sprintf( ' target="%s"', trim( $href['target'] ) ) );
					$link_title = ( empty( $href['title'] ) ? '' : sprintf( ' title="%s"', $href['title'] ) );
					$rel = ( empty( $href['rel'] ) ? '' : sprintf( ' rel="%s"', $href['rel'] ) );
				}
			}

			// get button html
			$button_html = presscore_get_button_html( array(
				'before_title'	=> $before_title,
				'after_title'	=> $after_title,
				'href'			=> $url,
				'title'			=> $this->content,
				'target'		=> $target,
				'class'			=> $this->get_html_class(),
				'atts'			=> ' id="' . $this->get_button_id() . '"'  . $btn_width  . $link_title . $rel ,
			) );

			//alignment

			switch ( $this->atts['button_alignment'] ) {
				case 'btn_left':
					$button_html = '<div class="btn-align-left">' . $button_html . '</div>';
					break;
				case 'btn_center':
					$button_html = '<div class="btn-align-center">' . $button_html . '</div>';
					break;
				case 'btn_right':
					$button_html = '<div class="btn-align-right">' . $button_html . '</div>';
					break;
			};

			return $button_html;
		}

		protected function get_icon( $icon_type ) {
			if ( 'html' == $icon_type ) {
				return $this->atts['icon'];
			}

			$icon_class = $this->atts["icon_{$icon_type}"];
			if ( $icon_class ) {
				return '<i class="' . esc_attr( $icon_class ) . '"></i>';
			}

			return '';
		}

		protected function get_html_class() {
			// static classes
			$classes = array( 'default-btn-shortcode dt-btn' );
			switch ( $this->atts['size'] ) {
				case 'small':
					$classes[] = 'dt-btn-s';
					break;
				case 'medium':
					$classes[] = 'dt-btn-m';
					break;
				case 'big':
					$classes[] = 'dt-btn-l';
					break;
			};
			// animation
			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
				$classes[] = 'animation-builder';
			}

			// icon alignment
			if ( $this->atts['icon'] && 'right' == $this->atts['icon_align'] ) {
				$classes[] = 'ico-right-side';
			}

			// smooth scroll

			if ( $this->atts['smooth_scroll'] ) {
				$classes[] = 'anchor-link';
			}

			// custom class
			if ( $this->atts['el_class'] ) {
				$classes[] = $this->atts['el_class'];
			}
			if ('btn_full_width' ==  $this->atts['btn_width'] ) {
				$classes[] = 'full-width-btn';
			}

			
			switch ( $this->atts['button_alignment'] ) {
				case 'btn_inline_left':
					$classes[] = 'btn-inline-left';
					break;
				case 'btn_inline_right':
					$classes[] = 'btn-inline-right';
					break;
			};
			if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
				$classes[] = vc_shortcode_custom_css_class( $this->atts['css'], ' ' );
			}
			return  esc_attr( implode( ' ', $classes ) );
		}
		/**
		 * Setup theme config for shortcode.
		 */
		protected function setup_config() {
		}

		/**
		 * Return array of prepared less vars to insert to less file.
		 *
		 * @return array
		 */
		protected function get_less_vars() {
			$storage = new Presscore_Lib_SimpleBag();
			$factory = new Presscore_Lib_LessVars_Factory();
			$less_vars = new DT_Blog_LessVars_Manager( $storage, $factory );
			$less_vars->add_keyword( 'unique-shortcode-class-name',  $this->get_unique_class(), '~"%s"' );

			$less_vars->add_keyword( 'default-btn-bg', $this->get_att( 'default_btn_bg_color', '~""') );
			$less_vars->add_keyword( 'default-btn-bg-hover', $this->get_att( 'bg_hover_color', '~""' ) );

			$less_vars->add_keyword( 'default-btn-color', $this->get_att( 'text_color', '~""' ) );
			$less_vars->add_keyword( 'default-btn-color-hover', $this->get_att( 'text_hover_color', '~""' ) );

			return $less_vars->get_vars();
		}
		protected function get_less_file_name() {
			// @TODO: Remove in production.
			$less_file_name = 'default-buttons';

			$less_file_path = trailingslashit( get_template_directory() ) . "css/dynamic-less/shortcodes/{$less_file_name}.less";

			return $less_file_path;
		}
		/**
		 * Return dummy html for VC inline editor.
		 *
		 * @return string
		 */
		protected function get_vc_inline_html() {
			return $this->vc_inline_dummy( array(
				'class' => 'Default button',
				'title' => _x( 'Products Carousel', 'vc inline dummy', 'the7mk2' ),
			) );
		}
		protected function get_button_id() {
			return $this->button_id;
		}
		

		protected function compatibility_filter( &$atts ) {
			if ( ! isset( $atts['icon_type'] ) ) {
				$atts['icon_type'] = 'html';
			}

			return $atts;
		}
	}
	DT_Shortcode_Default_Button::get_instance()->add_shortcode();
}
