<?php

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __FILE__ ) . '/the7pt-update-utility-functions.php';

function the7pt_set_db_version_1_11_0() {
	The7PT_Install::update_db_version( '1.11.0' );
}

function the7pt_set_db_version_1_13_0() {
	The7PT_Install::update_db_version( '1.13.0' );
}


/**
 * Migrate shortcodes gradients.
 *
 * @param array $atts
 *
 * @return array
 */
function the7pt_update_1_14_0_migrate_shortcodes_gradients( $atts ) {
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

function the7pt_update_1_14_0_shortcodes_gradient_backward_compatibility() {
	$tags = array(
		'dt_portfolio_carousel',
		'dt_portfolio_masonry',
		'dt_gallery_photos_masonry',
		'dt_photos_carousel',
	);

	the7_migrate_shortcodes_in_all_posts( 'the7pt_update_1_14_0_migrate_shortcodes_gradients', $tags, __FUNCTION__ );
}

function the7pt_set_db_version_1_14_0() {
	The7PT_Install::update_db_version( '1.14.0' );
}

function the7pt_set_db_version_1_15_0() {
	The7PT_Install::update_db_version( '1.15.0' );
}