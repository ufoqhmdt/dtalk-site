<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once dirname( __FILE__ ) . '/the7-update-utility-functions.php';

function the7_update_550_fancy_titles_parallax() {
	global $wpdb;

	$parallax_speed_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_parallax_speed'" );
	$fixed_bg_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_bg_fixed'", OBJECT_K );
	foreach ( $parallax_speed_meta as $_meta ) {
		if ( ! empty( $_meta->meta_value ) ) {
			// Setup parallax.
			add_post_meta( $_meta->post_id, '_dt_fancy_header_scroll_effect', 'parallax', true );
			add_post_meta( $_meta->post_id, '_dt_fancy_header_bg_parallax', $_meta->meta_value, true );
		} elseif ( array_key_exists( $_meta->post_id, $fixed_bg_meta ) && ! empty( $fixed_bg_meta[ $_meta->post_id ]->meta_value ) ) {
			// Setup fixed bg.
			add_post_meta( $_meta->post_id, '_dt_fancy_header_scroll_effect', 'fixed', true );
		}
		delete_post_meta( $_meta->post_id, '_dt_fancy_header_parallax_speed' );
		delete_post_meta( $_meta->post_id, '_dt_fancy_header_bg_fixed' );
	}
}

function the7_update_550_fancy_titles_font_size() {
	global $wpdb;

	$title_font_size_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_title_size'" );

	foreach ( $title_font_size_meta as $font_size_meta ) {
		$old_font_size = $font_size_meta->meta_value;
		if ( in_array( $old_font_size, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_font_size";
			$line_height_option = "fonts-{$old_font_size}_line_height";
		} elseif ( in_array( $old_font_size, array( 'big', 'normal', 'small' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_size";
			$line_height_option = "fonts-{$old_font_size}_size_line_height";
		} else {
			continue;
		}

		$post_id = $font_size_meta->post_id;
		$font_size = of_get_option( $font_size_option );
		if ( $font_size ) {
			add_post_meta( $post_id, '_dt_fancy_header_title_font_size', $font_size, true );
		}

		$line_height = of_get_option( $line_height_option );
		if ( $line_height ) {
			add_post_meta( $post_id, '_dt_fancy_header_title_line_height', $line_height, true );
		}

		delete_post_meta( $post_id, '_dt_fancy_header_title_size' );
	}
}

function the7_update_550_fancy_subtitles_font_size() {
	global $wpdb;

	$subtitle_font_size_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_subtitle_size'" );

	foreach ( $subtitle_font_size_meta as $font_size_meta ) {
		$old_font_size = $font_size_meta->meta_value;
		if ( in_array( $old_font_size, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_font_size";
			$line_height_option = "fonts-{$old_font_size}_line_height";
		} elseif ( in_array( $old_font_size, array( 'big', 'normal', 'small' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_size";
			$line_height_option = "fonts-{$old_font_size}_size_line_height";
		} else {
			continue;
		}

		$post_id = $font_size_meta->post_id;
		$font_size = of_get_option( $font_size_option );
		if ( $font_size ) {
			add_post_meta( $post_id, '_dt_fancy_header_subtitle_font_size', $font_size, true );
		}

		$line_height = of_get_option( $line_height_option );
		if ( $line_height ) {
			add_post_meta( $post_id, '_dt_fancy_header_subtitle_line_height', $line_height, true );
		}

		delete_post_meta( $post_id, '_dt_fancy_header_subtitle_size' );
	}
}

function the7_update_550_db_version() {
	The7_Install::update_db_version( '5.5.0' );
}

function the7_update_600_db_version() {
	The7_Install::update_db_version( '6.0.0' );
}

function the7_update_610_db_version() {
	The7_Install::update_db_version( '6.1.0' );
}

function the7_update_611_page_transparent_top_bar_migration() {
	global $wpdb;

	$posts_with_fancy_header = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_dt_header_title' AND meta_value IN ('fancy', 'slideshow')" );
	if ( ! $posts_with_fancy_header ) {
		return false;
	}

	$fancy_title_posts = implode( ',', wp_list_pluck( $posts_with_fancy_header, 'post_id' ) );
	$posts_with_transparent_header = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_dt_header_background' AND meta_value = 'transparent' AND post_id IN ($fancy_title_posts)" );
	if ( ! $posts_with_transparent_header ) {
		return false;
	}

	$color_obj = new Presscore_Lib_LessVars_Color( of_get_option( 'top_bar-bg-color' ) );
	$top_bar_with_bg = $color_obj->get_opacity() > 0;
	$top_bar_with_decoration = in_array( of_get_option( 'top_bar-bg-style' ), array( 'fullwidth_line', 'content_line' ), true );
	$top_bar_opacity = '0';
	if ( ! $top_bar_with_decoration && $top_bar_with_bg ) {
		$top_bar_opacity = '25';
	}
	$post_ids = wp_list_pluck( $posts_with_transparent_header, 'post_id' );
	foreach ( $post_ids as $post_id ) {
		if ( get_post_meta( $post_id, '_dt_header_transparent_top_bar_bg_color', true ) ) {
			continue;
		}
		update_post_meta( $post_id, '_dt_header_transparent_top_bar_bg_color', '#ffffff' );
		update_post_meta( $post_id, '_dt_header_transparent_top_bar_bg_opacity', $top_bar_opacity );
	}
}

function the7_update_611_db_version() {
	The7_Install::update_db_version( '6.1.1' );
}

function the7_update_620_db_version() {
	The7_Install::update_db_version( '6.2.0' );
}

function the7_update_630_microsite_content_visibility_settings_migration() {
	global $wpdb;

	$microsite_posts = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_page_template' AND meta_value = 'template-microsite.php'" );
	if ( ! $microsite_posts ) {
		return false;
	}

	$posts = wp_list_pluck( $microsite_posts, 'post_id' );
	foreach ( $posts as $post_id ) {
		$hidden_page_parts = get_post_meta( $post_id, '_dt_microsite_hidden_parts' );
		if ( ! in_array( 'content', $hidden_page_parts, true ) ) {
			continue;
		}

		// Hide bottom bar and footer.
		if ( ! in_array( 'bottom_bar', $hidden_page_parts, true ) ) {
			add_post_meta( $post_id, '_dt_microsite_hidden_parts', 'bottom_bar' );
		}
		update_post_meta( $post_id, '_dt_footer_show', '0' );
	}
}

function the7_update_630_db_version() {
	The7_Install::update_db_version( '6.3.0' );
}

function the7_update_640_db_version() {
	The7_Install::update_db_version( '6.4.0' );
}

function the7_update_641_carousel_backward_compatibility() {
	global $wpdb;

	$cache_key = 'the7_update_641_carousel_backward_compatibility_processed_posts';

	$processed_posts = get_option( $cache_key );
	if ( ! $processed_posts || ! is_array( $processed_posts )) {
		$processed_posts = array( '0' );
	}

	$processed_posts_str = implode( ',', $processed_posts );
	$posts_with_inline_css = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'the7_shortcodes_inline_css' AND post_id NOT IN ($processed_posts_str)" );

	if ( ! $posts_with_inline_css ) {
		delete_option( $cache_key );
		return false;
	}

	$post_ids = wp_list_pluck( $posts_with_inline_css, 'post_id' );
	$post_ids_str = implode( ',', $post_ids );
	$posts_content = $wpdb->get_results( "SELECT ID, post_content FROM $wpdb->posts WHERE ID IN ({$post_ids_str})" );
	$posts_content_array = wp_list_pluck( $posts_content, 'post_content', 'ID' );

	if ( ! class_exists( 'The7_Shortcode_Id_Crutch', false ) ) {
		include( PRESSCORE_SHORTCODES_INCLUDES_DIR . '/class-the7-shortcode-id-crutch.php' );
	}

	/**
	 * Little crutch to overcome short codes inner id issue.
	 *
	 * On each output short code increments inner id, which lead to fatal issues when trying to process many posts at once.
	 * First post processed normally but short codes id's in the next one will start not from 1, and inline css wil be generated with invalid selectors.
	 * This class can fix the issue. It can reset short code inner id on each iteration which emulates normal post save process.
	 */
	$id_crutch_obj = new The7_Shortcode_Id_Crutch();

	/**
	 * Hook to reset short code inner id.
	 */
	add_action( 'the7_after_shortcode_init', array( $id_crutch_obj, 'reset_id' ) );

	$tags = array(
		'dt_blog_carousel'         => 3,
		'dt_products_carousel'     => 3,
		'dt_carousel'              => 3,
		'dt_portfolio_carousel'    => 3,
		'dt_team_carousel'         => 4,
		'dt_testimonials_carousel' => 3,
	);
	foreach ( $post_ids as $post_id ) {
		if ( empty( $posts_content_array[ $post_id ] ) || wp_is_post_revision( $post_id ) ) {
			continue;
		}

		/**
		 * Reset processed tags on each iteration.
		 */
		$id_crutch_obj->reset_processed_tags();

		$save_post = false;
		$content = $posts_content_array[ $post_id ];

		if ( ! $content ) {
			continue;
		}

		preg_match_all( '/' . get_shortcode_regex( array_keys( $tags ) ) . '/', $content, $shortcodes );
		foreach ( $shortcodes[2] as $index => $tag ) {
			$atts = shortcode_parse_atts( trim( $shortcodes[3][ $index ] ) );
			if ( isset( $atts['slides_on_wide_desk'] ) ) {
				continue;
			}

			$columns = $tags[ $tag ];
			if ( isset( $atts['slides_on_desk'] ) ) {
				$columns = (int) $atts['slides_on_desk'];
			}

			$replace = '[' . $tag . $shortcodes[3][ $index ];
			$replace_to = $replace . ' slides_on_wide_desk="' . $columns  . '"';
			$content = str_replace( $replace, $replace_to, $content );

			$save_post = true;
		}

		if ( $save_post ) {
			wp_update_post( array(
				'ID' => $post_id,
				'post_content' => $content,
			) );
		}

		$processed_posts[] = $post_id;
		update_option( $cache_key, $processed_posts, false );
	}

	delete_option( $cache_key );
}

function the7_update_641_db_version() {
	The7_Install::update_db_version( '6.4.1' );
}

function the7_update_643_db_version() {
	The7_Install::update_db_version( '6.4.3' );
}

function the7_update_650_disable_options_autoload() {
	global $wpdb;

	$wpdb->query( "UPDATE $wpdb->options SET autoload = 'no' WHERE option_name = 'ultimate_google_fonts'" );
}

function the7_update_650_db_version() {
	The7_Install::update_db_version( '6.5.0' );
}

function the7_update_660_db_version() {
	The7_Install::update_db_version( '6.6.0' );
}

function the7_update_661_db_version() {
	The7_Install::update_db_version( '6.6.1' );
}

function the7_update_670_db_version() {
	The7_Install::update_db_version( '6.7.0' );
}

function the7_update_680_db_version() {
	The7_Install::update_db_version( '6.8.0' );
}

function the7_update_681_db_version() {
	The7_Install::update_db_version( '6.8.1' );
}

function the7_update_693_migrate_custom_menu_widgets() {
	$sidebars_widgets = get_option( 'sidebars_widgets' );

	foreach ( $sidebars_widgets as $sidebar => &$widgets ) {
		if ( ! is_array( $widgets ) ) {
			continue;
		}

		$widgets = preg_replace( array(
			'/presscore-custom-menu-1(.*)/',
			'/presscore-custom-menu-2(.*)/',
		), array( 'presscore-custom-menu-one$1', 'presscore-custom-menu-two$1' ), $widgets );
	}
	unset( $widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	$widget_settings = array(
		'widget_presscore-custom-menu-1' => 'widget_presscore-custom-menu-one',
		'widget_presscore-custom-menu-2' => 'widget_presscore-custom-menu-two',
	);
	foreach( $widget_settings as $old_id => $new_id) {
		update_option( $new_id, get_option( $old_id ) );
	}
}

function the7_update_693_db_version() {
	The7_Install::update_db_version( '6.9.3' );
}

/**
 * Migrate shortcodes gradients.
 *
 * @param array $atts
 *
 * @return array
 */
function the7_update_700_migrate_shortcodes_gradients( $atts ) {
	$new_atts = (array) $atts;
	if ( ! isset( $atts['image_hover_bg_color'] ) && ! empty( $atts['custom_rollover_bg_color'] ) ) {
		$new_atts['image_hover_bg_color'] = 'solid_rollover_bg';
	} elseif( isset( $atts['image_hover_bg_color'] ) && $atts['image_hover_bg_color'] === 'solid_rollover_bg' && empty( $atts['custom_rollover_bg_color'] ) ) {
		unset( $new_atts['image_hover_bg_color'] );
	} elseif ( isset( $atts['image_hover_bg_color'] ) && $atts['image_hover_bg_color'] === 'gradient_rollover_bg' && empty( $atts['custom_rollover_bg_color_1'] ) ) {
		unset( $new_atts['image_hover_bg_color'] );
	} elseif(
		isset( $atts['image_hover_bg_color'] ) && $atts['image_hover_bg_color'] === 'gradient_rollover_bg'
		&& ! empty( $atts['custom_rollover_bg_color_1'] )
		&& ! empty( $atts['custom_rollover_bg_color_2'] )
	) {
		$color_1 = $atts['custom_rollover_bg_color_1'];
		$color_2 = $atts['custom_rollover_bg_color_2'];
		$angle = isset( $atts['custom_rollover_gradient_deg'] ) ? $atts['custom_rollover_gradient_deg'] : '135deg';

		$new_atts['custom_rollover_bg_gradient'] = "$angle|$color_1 30%|$color_2 100%";
		unset(
			$new_atts['custom_rollover_bg_color_1'],
			$new_atts['custom_rollover_bg_color_2'],
			$new_atts['custom_rollover_gradient_deg']
		);
	}

	return $new_atts;
}

function the7_update_700_shortcodes_gradient_backward_compatibility() {
	$tags = array(
		'dt_media_gallery_carousel',
		'dt_gallery_masonry',
	);

	the7_migrate_shortcodes_in_all_posts( 'the7_update_700_migrate_shortcodes_gradients', $tags, __FUNCTION__ );
}

function the7_update_700_db_version() {
	The7_Install::update_db_version( '7.0.0' );
}

function the7_update_710_db_version() {
	The7_Install::update_db_version( '7.1.0' );
}