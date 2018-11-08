<?php
/**
 * Deprecated function.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @deprecated
 *
 * @param $postID
 * @param $post
 */
function presscore_save_shortcode_inline_css( $postID, $post ) {
	the7_save_shortcode_inline_css( $postID, $post );
}

/**
 * @deprecated
 *
 * @param $content
 *
 * @return string
 */
function presscore_generate_shortcode_css( $content ) {
	return the7_generate_shortcode_css( $content );
}

/**
 * Returns favicon tags html.
 *
 * @deprecated
 * @since 2.2.1
 * @return string
 */
function presscore_get_favicon() {
	return dt_get_favicon( presscore_choose_right_image_based_on_device_pixel_ratio( of_get_option( 'general-favicon', '' ), of_get_option( 'general-favicon_hd', '' ) ) );
}

/**
 * Return favicon html.
 *
 * @deprecated
 *
 * @param $icon string
 *
 * @return string.
 * @since presscore 0.1
 */
function dt_get_favicon( $icon = '' ) {
	$output = '';
	if ( ! empty( $icon ) ) {

		if ( strpos( $icon, '/wp-content' ) === 0 || strpos( $icon, '/files' ) === 0 ) {
			$icon = get_site_url() . $icon;
		}

		$ext = explode( '.', $icon );
		if ( count( $ext ) > 1 ) {
			$ext = end( $ext );
		} else {
			return '';
		}

		switch ( $ext ) {
			case 'png':
				$icon_type = esc_attr( image_type_to_mime_type( IMAGETYPE_PNG ) );
				break;
			case 'gif':
				$icon_type = esc_attr( image_type_to_mime_type( IMAGETYPE_GIF ) );
				break;
			case 'jpg':
			case 'jpeg':
				$icon_type = esc_attr( image_type_to_mime_type( IMAGETYPE_JPEG ) );
				break;
			case 'ico':
				$icon_type = esc_attr( 'image/x-icon' );
				break;
			default:
				return '';
		}

		$output .= '<!-- icon -->' . "\n";
		$output .= '<link rel="icon" href="' . $icon . '" type="' . $icon_type . '" />' . "\n";
		$output .= '<link rel="shortcut icon" href="' . $icon . '" type="' . $icon_type . '" />' . "\n";
	}

	return $output;
}

/**
 * Chooses what src to use, based on device pixel ratio and theme settings
 *
 * @deprecated
 *
 * @param  string $regular_img_src Regular image src
 * @param  string $hd_img_src      Hd image src
 *
 * @return string                  Best suitable src
 */
function presscore_choose_right_image_based_on_device_pixel_ratio( $regular_img_src, $hd_img_src = '' ) {
	$output_src = '';

	if ( ! $regular_img_src && ! $hd_img_src ) {
	} elseif ( ! $regular_img_src ) {
		$output_src = $hd_img_src;
	} elseif ( ! $hd_img_src ) {
		$output_src = $regular_img_src;
	} else {
		$output_src = dt_is_hd_device() ? $hd_img_src : $regular_img_src;
	}

	return $output_src;
}

/**
 * Get image based on devicePixelRatio coocie and theme options.
 *
 * @deprecated
 *
 * @param $logo    array Regular logo.
 * @param $r_logo  array Retina logo.
 * @param $default array Default logo.
 * @param $custom  string Custom img attributes.
 *
 * @return string.
 */
function dt_get_retina_sensible_image( $logo, $r_logo, $default, $custom = '', $class = '' ) {
	if ( empty( $default ) ) {
		return '';
	}

	if ( $logo && ! $r_logo ) {
		$r_logo = $logo;
	} elseif ( $r_logo && ! $logo ) {
		$logo = $r_logo;
	} elseif ( ! $r_logo && ! $logo ) {
		$logo = $r_logo = $default;
	}

	$img_meta = dt_is_hd_device() ? $r_logo : $logo;

	if ( ! isset( $img_meta['size'] ) && isset( $img_meta[1], $img_meta[2] ) ) {
		$img_meta['size'] = image_hwstring( $img_meta[1], $img_meta[2] );
	}
	$output = dt_get_thumb_img( array(
		'wrap'      => '<img %IMG_CLASS% %SRC% %SIZE% %CUSTOM% />',
		'img_class' => $class,
		'img_meta'  => $img_meta,
		'custom'    => $custom,
		'echo'      => false,
		// TODO: add alt if it's possible
		'alt'       => '',
	) );

	return $output;
}

/**
 * Get device pixel ratio cookie value and check if it greater than 1.
 *
 * @deprecated
 * @return boolean
 */
function dt_is_hd_device() {
	return ( isset( $_COOKIE['devicePixelRatio'] ) && $_COOKIE['devicePixelRatio'] > 1.3 );
}

/**
 * Add little javascript that detects devicePixelRatio and if it's more than 1 - reload the page.
 *
 * @deprecated
 */
function dt_core_detect_retina_script() {
	/*

	function createCookie(name, value, days) {
		var expires;
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		}
		else expires = "";
		document.cookie = name + "=" + value + expires + "; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name, "", -1);
	}

	function areCookiesEnabled() {
		var r = false;
		createCookie("testing", "Hello", 1);
		if (readCookie("testing") != null) {
			r = true;
			eraseCookie("testing");
		}
		return r;
	}

	(function(w){
		var targetCookie = readCookie('devicePixelRatio'),
			dpr=((w.devicePixelRatio===undefined)?1:w.devicePixelRatio);

		if( !areCookiesEnabled() || (targetCookie != null) ) return;

		createCookie('devicePixelRatio', dpr, 7);

		if ( dpr != 1 ) {
			w.location.reload(true);
		}

	})(window)


	function createCookie(a,d,b){if(b){var c=new Date;c.setTime(c.getTime()+864E5*b);b="; expires="+c.toGMTString()}else b="";document.cookie=a+"="+d+b+"; path=/"}function readCookie(a){a+="=";for(var d=document.cookie.split(";"),b=0;b<d.length;b++){for(var c=d[b];" "==c.charAt(0);)c=c.substring(1,c.length);if(0==c.indexOf(a))return c.substring(a.length,c.length)}return null}function eraseCookie(a){createCookie(a,"",-1)}
	function areCookiesEnabled(){var a=!1;createCookie("testing","Hello",1);null!=readCookie("testing")&&(a=!0,eraseCookie("testing"));return a}(function(a){var d=readCookie("devicePixelRatio"),b=void 0===a.devicePixelRatio?1:a.devicePixelRatio;areCookiesEnabled()&&null==d&&(a.navigator.standalone?(d=new XMLHttpRequest,d.open("GET","<?php echo get_template_directory_uri();?>/set-cookie.php?devicePixelRatio="+b,!1),d.send()):createCookie("devicePixelRatio",b,7),a.location.reload(!0))})(window);


	*/
	if ( ! isset( $_COOKIE['devicePixelRatio'] ) ) :
		?>
        <script type="text/javascript">
			function createCookie(a, d, b) {
				if (b) {
					var c = new Date;
					c.setTime(c.getTime() + 864E5 * b);
					b = "; expires=" + c.toGMTString()
				} else b = "";
				document.cookie = a + "=" + d + b + "; path=/"
			}

			function readCookie(a) {
				a += "=";
				for (var d = document.cookie.split(";"), b = 0; b < d.length; b++) {
					for (var c = d[b]; " " == c.charAt(0);) c = c.substring(1, c.length);
					if (0 == c.indexOf(a)) return c.substring(a.length, c.length)
				}
				return null
			}

			function eraseCookie(a) {
				createCookie(a, "", -1)
			}

			function areCookiesEnabled() {
				var a = !1;
				createCookie("testing", "Hello", 1);
				null != readCookie("testing") && (a = !0, eraseCookie("testing"));
				return a
			}

			(function (a) {
				var d = readCookie("devicePixelRatio"), b = void 0 === a.devicePixelRatio ? 1 : a.devicePixelRatio;
				areCookiesEnabled() && null == d && (createCookie("devicePixelRatio", b, 7), 1 != b && a.location.reload(!0))
			})(window);
        </script><?php
	endif;
}

/**
 * Remove wp_site_icon hook if favicons set in theme options.
 *
 * @deprecated
 * @since 2.3.1
 */
function presscore_remove_wp_site_icon() {
	if ( presscore_get_device_icons() ) {
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}
}

/**
 * Remove wp_site_icon hook if favicons set in theme options.
 *
 * @deprecated
 * @since 2.3.1
 */
function presscore_admin_remove_wp_site_icon() {
	if ( presscore_get_device_icons() ) {
		remove_action( 'admin_head', 'wp_site_icon' );
	}
}

/**
 * Display site icon.
 *
 * @deprecated
 * @since 2.2.1
 */
function presscore_site_icon() {
	the7_site_icon();
}

if ( ! function_exists( 'presscore_less_get_conditional_colors' ) ) :

	/**
	 * Function returns $color|$gradient|$accent based on $test value.
	 *
	 * @deprecated 6.6.0
	 * @since      3.0.0
	 *
	 * @param  array        $test
	 * @param  array        $color
	 * @param  array        $gradient
	 * @param  array|string $accent
	 *
	 * @return array|string
	 */
	function presscore_less_get_conditional_colors( $test, $color, $gradient, $accent, $opacity = null ) {
		switch ( call_user_func_array( 'of_get_option', (array) $test ) ) {
			case 'outline':
			case 'background':
			case 'color':
				$_color = array(
					call_user_func_array( 'of_get_option', (array) $color ),
					'""',
				);
				break;
			case 'gradient':
				$_color = call_user_func_array( 'of_get_option', (array) $gradient );
				if ( is_string( $_color ) ) {
					$_color = the7_less_prepare_gradient_var( $_color );
				}
				break;
			case 'accent':
			default:
				$_color = $accent;
		}

		return $_color;
	}

endif;

/**
 * @deprecated 6.6.0
 *
 * @param Presscore_Lib_LessVars_Manager $less_vars
 *
 * @return array
 */
function presscore_less_get_accent_colors( Presscore_Lib_LessVars_Manager $less_vars ) {
	return the7_less_get_accent_colors( $less_vars );
}

if ( ! function_exists( 'presscore_top_bar_text2_element' ) ) :

	/**
	 * Render header text2 mini widget.
	 *
	 * @deprecated 6.6.1
	 * @since      3.0.0
	 */
	function presscore_top_bar_text2_element() {
		presscore_top_bar_text_element( 'header-elements-text-2' );
	}

endif;

if ( ! function_exists( 'presscore_top_bar_text3_element' ) ) :

	/**
	 * Render header text3 mini widget.
	 *
	 * @deprecated 6.6.1
	 * @since      3.0.0
	 */
	function presscore_top_bar_text3_element() {
		presscore_top_bar_text_element( 'header-elements-text-3' );
	}

endif;

if ( ! function_exists( 'presscore_options_get_font_sizes' ) ) :

	/**
	 * @deprecated 6.6.1
	 * @return array
	 */
	function presscore_options_get_font_sizes() {
		return array(
			"big"    => _x( 'large', 'theme-options', 'the7mk2' ),
			"normal" => _x( 'medium', 'theme-options', 'the7mk2' ),
			"small"  => _x( 'small', 'theme-options', 'the7mk2' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_options_get_show_hide' ) ) :

	/**
	 * @deprecated 6.6.1
	 * @return array
	 */
	function presscore_options_get_show_hide() {
		return array(
			'show' => _x( 'Show', 'theme-options', 'the7mk2' ),
			'hide' => _x( 'Hide', 'theme-options', 'the7mk2' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_options_get_en_dis' ) ) :

	/**
	 * @deprecated 6.6.1
	 * @return array
	 */
	function presscore_options_get_en_dis() {
		return array(
			'1' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
			'0' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_options_tpl_logo' ) ) :

	/**
	 * @deprecated 6.6.1
	 */
	function presscore_options_tpl_logo( &$options, $prefix = '', $fields = array() ) {
		$_fields = array();

		$_fields['logo_regular'] = array(
			'name' => _x( 'Logo', 'theme-options', 'the7mk2' ),
			'type' => 'upload',
			'mode' => 'full',
			'std'  => array( '', 0 ),
		);

		$_fields['logo_hd'] = array(
			'name' => _x( 'High-DPI (retina) logo', 'theme-options', 'the7mk2' ),
			'type' => 'upload',
			'mode' => 'full',
			'std'  => array( '', 0 ),
		);

		$_fields = array_merge_recursive( $_fields, $fields );

		$prefix = ( $prefix ? $prefix . '-' : '' );
		foreach ( $_fields as $field_id => $field ) {
			$field_id = ( isset( $field['id'] ) ? $field['id'] : $field_id );
			if ( ! is_numeric( $field_id ) ) {
				$field_id = $prefix . $field_id;

				$field['id'] = $field_id;

				$options[ $field_id ] = $field;
			} else {
				$options[] = $field;
			}
		}
	}

endif;

if ( ! function_exists( 'presscore_get_team_links_array' ) ) :

	/**
	 * Return links list for team post meta box.
	 *
	 * @deprecated 6.6.1 Moved to dt-the7-core.
	 * @return array.
	 */
	function presscore_get_team_links_array() {
		$team_links = array(
			'website' => array( 'desc' => _x( 'Personal blog / website', 'team link', 'the7mk2' ) ),
			'mail'    => array( 'desc' => _x( 'E-mail', 'team link', 'the7mk2' ) ),
		);

		$common_links = presscore_get_social_icons_data();
		if ( $common_links ) {

			foreach ( $common_links as $key => $value ) {

				if ( isset( $team_links[ $key ] ) ) {
					continue;
				}

				$team_links[ $key ] = array( 'desc' => $value );
			}
		}

		return $team_links;
	}

endif;

if ( ! function_exists( 'presscore_get_blank_image' ) ) :

	/**
	 * Get blank image.
     *
	 * @deprecated 6.10.0
	 */
	function presscore_get_blank_image() {
		return PRESSCORE_THEME_URI . '/images/1px.gif';
	}

endif;
