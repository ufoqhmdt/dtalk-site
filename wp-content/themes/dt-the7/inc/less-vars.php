<?php
/**
 * Description here.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param Presscore_Lib_LessVars_Manager $less_vars
 */
function presscore_action_add_less_vars( $less_vars ) {
	/**
	 * @var string             $first_accent_color
	 * @var The7_Less_Gradient $accent_gradient_obj
	 */
	list( $first_accent_color, $accent_gradient_obj ) = the7_less_get_accent_colors( $less_vars );
	$last_accent_color = $accent_gradient_obj->get_last_color_stop()->get_color();

	$less_vars->add_keyword( 'accent-bg-filter-switch', $accent_gradient_obj->with_opacity( 20 )->get_string() );
	$less_vars->add_keyword( 'accent-bg-scroller-arrow', $accent_gradient_obj->with_opacity( 90 )->get_string() );
	$less_vars->add_keyword( 'accent-text-color-2', $accent_gradient_obj->with_angle( 'left' )->get_string() );
	$less_vars->add_rgba_color( 'accent-bg-2', $last_accent_color );

	// Micro widget button last color stops.
	$button_last_color_stops = array(
		'microwidget-button-color-last'         => array(
			'mode'     => 'header-elements-button-1-icon-color',
			'gradient' => 'header-elements-button-1-icon-color-gradient',
		),
		'microwidget-button-hover-color-last'   => array(
			'mode'     => 'header-elements-button-1-hover-icon-color',
			'gradient' => 'header-elements-button-1-hover-icon-color-gradient',
		),
		'microwidget-button-2-color-last'       => array(
			'mode'     => 'header-elements-button-2-icon-color',
			'gradient' => 'header-elements-button-2-icon-color-gradient',
		),
		'microwidget-button-2-hover-color-last' => array(
			'mode'     => 'header-elements-button-2-hover-icon-color',
			'gradient' => 'header-elements-button-2-hover-icon-color-gradient',
		),
	);
	foreach ( $button_last_color_stops as $v => $opt ) {
		switch( of_get_option( $opt['mode'] ) ) {
			case 'accent':
				$less_vars->add_rgba_color( $v, $last_accent_color );
				break;
			case 'gradient':
				$less_vars->add_rgba_color( $v, the7_less_create_gradient_obj( of_get_option( $opt['gradient'] ) )->get_last_color_stop()->get_color() );
				break;
			default:
				$less_vars->add_rgba_color( $v, false );
		}
	}

	$conditional_color_map = array(
		array(
			'vars'      => array( 'beautiful-loading-bg', 'beautiful-loading-bg-2' ),
			'test_args' => array(
				'general-fullscreen_overlay_color_mode',
				'general-fullscreen_overlay_color',
				'general-fullscreen_overlay_gradient',
			),
			'opacity'   => 'general-fullscreen_overlay_opacity',
		),
		array(
			'vars'      => array( 'top-icons-bg-color', 'top-icons-bg-color-2' ),
			'test_args' => array(
				'header-elements-soc_icons-bg',
				'header-elements-soc_icons-bg-color',
				'header-elements-soc_icons-bg-gradient',
			),
		),
		array(
			'vars'      => array( 'top-icons-border-color' ),
			'test_args' => array(
				'header-elements-soc_icons-border',
				'header-elements-soc_icons-border-color',
				'header-elements-soc_icons-border-gradient',
			),
		),
		array(
			'vars'      => array( 'top-icons-bg-color-hover', 'top-icons-bg-color-hover-2' ),
			'test_args' => array(
				'header-elements-soc_icons-hover-bg',
				'header-elements-soc_icons-hover-bg-color',
				'header-elements-soc_icons-hover-bg-gradient',
			),
		),
		array(
			'vars'      => array( 'top-icons-border-color-hover' ),
			'test_args' => array(
				'header-elements-soc_icons-hover-border',
				'header-elements-soc_icons-hover-border-color',
				'header-elements-soc_icons-border-hover-gradient',
			),
		),
		array(
			'vars'      => array( 'sticky-header-overlay-bg', 'sticky-header-overlay-bg-2' ),
			'test_args' => array(
				'header-slide_out-overlay-bg-color-style',
				'header-slide_out-overlay-bg-color',
				'header-slide_out-overlay-bg-gradient',
			),
			'opacity'   => 'header-slide_out-overlay-bg-opacity',
		),
		array(
			'vars'      => array( 'rollover-bg-color', 'rollover-bg-color-2' ),
			'test_args' => array(
				'image_hover-color_mode',
				'image_hover-color',
				'image_hover-color_gradient',
			),
			'opacity'   => 'image_hover-opacity',
		),
		array(
			'vars'      => array( 'project-rollover-bg-color', 'project-rollover-bg-color-2' ),
			'test_args' => array(
				'image_hover-project_rollover_color_mode',
				'image_hover-project_rollover_color',
				'image_hover-project_rollover_color_gradient',
			),
			'opacity'   => 'image_hover-project_rollover_opacity',
		),
		array(
			'vars'           => array( 'menu-line-decor-color', 'menu-line-decor-color-2' ),
			'test_args'      => array(
				'header-menu-decoration-other-hover-line-color-style',
				'header-menu-decoration-other-hover-line-color',
				'header-menu-decoration-other-hover-line-gradient',
			),
			'opacity'        => 'header-menu-decoration-other-hover-line-opacity',
			'gradient_angle' => 'left',
		),
		array(
			'vars'      => array( 'menu-hover-decor-color', 'menu-hover-decor-color-2' ),
			'test_args' => array(
				'header-menu-decoration-other-hover-line-color-style',
				'header-menu-decoration-other-hover-line-color',
				'header-menu-decoration-other-hover-line-gradient',
			),
			'opacity'   => 'header-menu-decoration-other-hover-line-opacity',
		),
		array(
			'vars'      => array( 'menu-active-decor-color', 'menu-active-decor-color-2' ),
			'test_args' => array(
				'header-menu-decoration-other-active-color-style',
				'header-menu-decoration-other-active-color',
				'header-menu-decoration-other-active-gradient',
			),
			'opacity'   => 'header-menu-decoration-other-active-opacity',
		),
		array(
			'vars'           => array( 'menu-active-line-decor-color', 'menu-active-line-decor-color-2' ),
			'test_args'      => array(
				'header-menu-decoration-other-active-line-color-style',
				'header-menu-decoration-other-active-line-color',
				'header-menu-decoration-other-active-line-gradient',
			),
			'opacity'        => 'header-menu-decoration-other-active-line-opacity',
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'menu-hover-color', 'menu-hover-color-2' ),
			'test_args'      => array(
				'header-menu-hover-font-color-style',
				'header-menu-hover-font-color',
				'header-menu-hover-font-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'menu-active-color', 'menu-active-color-2' ),
			'test_args'      => array(
				'header-menu-active_item-font-color-style',
				'header-menu-active_item-font-color',
				'header-menu-active_item-font-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'      => array( 'menu-click-decor-bg-color', 'menu-click-decor-bg-color-2' ),
			'test_args' => array(
				'header-menu-decoration-other-click_decor-color-style',
				'header-menu-decoration-other-click_decor-color',
				'header-menu-decoration-other-click_decor-gradient',
			),
			'opacity'   => 'header-menu-decoration-other-click_decor-opacity',
		),
		array(
			'vars'           => array( 'submenu-hover-color', 'submenu-hover-color-2' ),
			'test_args'      => array(
				'header-menu-submenu-hover-font-color-style',
				'header-menu-submenu-hover-font-color',
				'header-menu-submenu-hover-font-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'submenu-active-color', 'submenu-active-color-2' ),
			'test_args'      => array(
				'header-menu-submenu-active-font-color-style',
				'header-menu-submenu-active-font-color',
				'header-menu-submenu-active-font-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'mobile-menu-active-color', 'mobile-menu-active-color-2' ),
			'test_args'      => array(
				'header-mobile-menu-font-hover-color-style',
				'header-mobile-menu-font-hover-color',
				'header-mobile-menu-font-hover-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'mobile-menu-hover-color', 'mobile-menu-hover-color-2' ),
			'test_args'      => array(
				'header-mobile-menu-font-hover-color-style',
				'header-mobile-menu-font-hover-color',
				'header-mobile-menu-font-hover-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'      => array( 'dt-btn-bg-color', 'dt-btn-bg-color-2' ),
			'test_args' => array(
				'buttons-color_mode',
				'buttons-color',
				'buttons-color_gradient',
			),
		),
		array(
			'vars'      => array( 'dt-btn-hover-bg-color', 'dt-btn-hover-bg-color-2' ),
			'test_args' => array(
				'buttons-hover_color_mode',
				'buttons-hover_color',
				'buttons-hover_color_gradient',
			),
		),
		array(
			'vars'      => array( 'dt-btn-color' ),
			'test_args' => array(
				'buttons-text_color_mode',
				'buttons-text_color',
				null,
			),
		),
		array(
			'vars'      => array( 'dt-btn-hover-color' ),
			'test_args' => array(
				'buttons-text_hover_color_mode',
				'buttons-text_hover_color',
				null,
			),
		),
		array(
			'vars'      => array( 'page-title-bg-color', 'page-title-bg-color-2' ),
			'test_args' => array(
				'general-title_bg_mode',
				'general-title_bg_color',
				'general-title_bg_gradient',
			),
		),
		array(
			'vars'      => array( 'submenu-hover-bg', 'submenu-hover-bg-2' ),
			'test_args' => array(
				'header-menu-submenu-hover-bg-color-style',
				'header-menu-submenu-hover-bg-color',
				'header-menu-submenu-hover-bg-gradient',
			),
			'opacity'   => 'header-menu-submenu-hover-bg-opacity',
		),
		array(
			'vars'      => array( 'submenu-active-bg', 'submenu-active-bg-2' ),
			'test_args' => array(
				'header-menu-submenu-active-bg-color-style',
				'header-menu-submenu-active-bg-color',
				'header-menu-submenu-active-bg-gradient',
			),
			'opacity'   => 'header-menu-submenu-active-bg-opacity',
		),
		array(
			'vars'           => array( 'microwidget-button-color', 'microwidget-button-color-2' ),
			'test_args'      => array(
				'header-elements-button-1-icon-color',
				'header-elements-button-1-icon-color-mono',
				'header-elements-button-1-icon-color-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'microwidget-button-hover-color', 'microwidget-button-hover-color-2' ),
			'test_args'      => array(
				'header-elements-button-1-hover-icon-color',
				'header-elements-button-1-hover-icon-color-mono',
				'header-elements-button-1-hover-icon-color-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'      => array( 'microwidget-button-border-color', 'microwidget-button-border-color-2' ),
			'test_args' => array(
				'header-elements-button-1-border-color',
				'header-elements-button-1-border-color-mono',
				null,
			),
		),
		array(
			'vars'      => array( 'microwidget-button-hover-border-color', 'microwidget-button-hover-border-color-2' ),
			'test_args' => array(
				'header-elements-button-1-hover-border-color',
				'header-elements-button-1-hover-border-color-mono',
				null,
			),
		),
		array(
			'vars'      => array( 'microwidget-button-bg', 'microwidget-button-bg-2' ),
			'test_args' => array(
				'header-elements-button-1-bg',
				'header-elements-button-1-bg-color',
				'header-elements-button-1-bg-gradient',
			),
		),
		array(
			'vars'      => array( 'microwidget-button-hover-bg', 'microwidget-button-hover-bg-2' ),
			'test_args' => array(
				'header-elements-button-1-hover-bg',
				'header-elements-button-1-hover-bg-color',
				'header-elements-button-1-hover-bg-gradient',
			),
		),

		array(
			'vars'           => array( 'microwidget-button-2-color', 'microwidget-button-2-color-2' ),
			'test_args'      => array(
				'header-elements-button-2-icon-color',
				'header-elements-button-2-icon-color-mono',
				'header-elements-button-2-icon-color-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'           => array( 'microwidget-button-2-hover-color', 'microwidget-button-2-hover-color-2' ),
			'test_args'      => array(
				'header-elements-button-2-hover-icon-color',
				'header-elements-button-2-hover-icon-color-mono',
				'header-elements-button-2-hover-icon-color-gradient',
			),
			'gradient_angle' => 'left',
		),
		array(
			'vars'      => array( 'microwidget-button-2-border-color', 'microwidget-button-2-border-color-2' ),
			'test_args' => array(
				'header-elements-button-2-border-color',
				'header-elements-button-2-border-color-mono',
				null,
			),
		),
		array(
			'vars'      => array( 'microwidget-button-2-hover-border-color', 'microwidget-button-2-hover-border-color-2' ),
			'test_args' => array(
				'header-elements-button-2-hover-border-color',
				'header-elements-button-2-hover-border-color-mono',
				null,
			),
		),
		array(
			'vars'      => array( 'microwidget-button-2-bg', 'microwidget-button-2-bg-2' ),
			'test_args' => array(
				'header-elements-button-2-bg',
				'header-elements-button-2-bg-color',
				'header-elements-button-2-bg-gradient',
			),
		),
		array(
			'vars'      => array( 'microwidget-button-2-hover-bg', 'microwidget-button-2-hover-bg-2' ),
			'test_args' => array(
				'header-elements-button-2-hover-bg',
				'header-elements-button-2-hover-bg-color',
				'header-elements-button-2-hover-bg-gradient',
			),
		),

		array(
			'vars'      => array( 'mw-search-overlay-bg', 'mw-search-overlay-bg-2' ),
			'test_args' => array(
				'microwidgets-search_overlay-bg',
				'microwidgets-search_overlay-bg-color',
				'microwidgets-search_overlay-bg-gradient',
			),
		),
	);

	$decor_vars = array( 'menu-decor-color', 'menu-decor-color-2' );
	$decoration = of_get_option( 'header-menu-decoration-style' );
	if ( 'underline' === $decoration ) {
		$conditional_color_map[] = array(
			'vars'           => $decor_vars,
			'test_args'      => array(
				'header-menu-decoration-underline-color-style',
				'header-menu-decoration-underline-color',
				'header-menu-decoration-underline-gradient',
			),
			'gradient_angle' => 'left',
		);

		$less_vars->add_pixel_number( 'menu-decoration-line-size', of_get_option( 'header-menu-decoration-underline-line_size' ) );
	} else if ( 'other' === $decoration ) {
		$conditional_color_map[] = array(
			'vars'      => $decor_vars,
			'test_args' => array(
				'header-menu-decoration-other-hover-color-style',
				'header-menu-decoration-other-hover-color',
				'header-menu-decoration-other-hover-gradient',
			),
			'opacity'   => 'header-menu-decoration-other-opacity',
		);

		$less_vars->add_pixel_number( 'menu-decoration-line-size', of_get_option( 'header-menu-decoration-other-line_size' ) );
	}
	unset( $decor_vars, $decoration );

	foreach ( $conditional_color_map as $color_map ) {
		list( $test_opt, $color_opt, $gradient_opt ) = $color_map['test_args'];
		$custom_gradient_angle = isset( $color_map['gradient_angle'] ) ? $color_map['gradient_angle'] : null;

		switch ( of_get_option( $test_opt ) ) {
			case 'outline':
			case 'background':
			case 'color':
				$less_vars->add_rgba_color( $color_map['vars'], array( of_get_option( $color_opt ), null ) );
				break;
			case 'gradient':
				$gradient_obj = the7_less_create_gradient_obj( of_get_option( $gradient_opt ) );
				list( $first_color, $gradient ) = the7_less_prepare_gradient_var( $gradient_obj->with_angle( $custom_gradient_angle ) );
				$less_vars->add_rgba_color( $color_map['vars'][0], $first_color );
				if ( isset( $color_map['vars'][1] ) ) {
					$less_vars->add_keyword( $color_map['vars'][1], $gradient );
				}
				break;
			case 'accent':
			default:
				$opacity = isset( $color_map['opacity'] ) ? of_get_option( $color_map['opacity'] ) : null;
				$less_vars->add_rgba_color( $color_map['vars'][0], $first_accent_color, $opacity );
				if ( isset( $color_map['vars'][1] ) ) {
					$less_vars->add_keyword( $color_map['vars'][1], $accent_gradient_obj->with_angle( $custom_gradient_angle )->with_opacity( $opacity )->get_string() );
				}
		}
	}
	unset( $conditional_color_map, $first_color, $gradient, $opacity, $test_opt, $color_opt, $gradient_opt );
	//Microwidget search
	$less_vars->add_font( array(
		'mw-search-font-family',
		'mw-search-font-weight',
		'mw-search-font-style',
	), of_get_option( 'microwidgets-search_font-family' ) );

	$less_vars->add_pixel_number( 'mw-search-font-size', of_get_option( 'microwidgets-search_font-size', '14' ) );
	$less_vars->add_rgba_color( 'mw-search-color', of_get_option( 'microwidgets-search_font-color' ) );
	$less_vars->add_pixel_number( 'mw-search-icon-size', of_get_option( 'microwidgets-search_icon-size', '16' ) );
	$less_vars->add_pixel_number( 'mw-search-custom-icon-size', of_get_option( 'header-elements-search_custom-icon-size', '16' ) );
	$less_vars->add_pixel_number( 'mw-search-bg-height', of_get_option( 'microwidgets-search-height', '34' ) );
	$less_vars->add_pixel_number( 'mw-search-bg-width', of_get_option( 'microwidgets-search-width', '200' ) );
	$less_vars->add_pixel_number( 'mw-search-bg-active-width', of_get_option( 'microwidgets-search-active-width'));
	$less_vars->add_rgba_color( 'mw-search-bg-color', of_get_option( 'microwidgets-search_bg-color' ) );
	$less_vars->add_rgba_color( 'mw-search-popup-bg', of_get_option( 'microwidgets-search_popup-bg-color' ) );
	$less_vars->add_pixel_number( 'mw-search-border-radius', of_get_option( 'microwidgets-search_bg_border_radius', '0' ) );
	$less_vars->add_pixel_number( 'mw-search-border-width', of_get_option( 'microwidgets-search_bg_border_width', '0' ) );
	$less_vars->add_rgba_color( 'mw-search-border-color', of_get_option( 'microwidgets-search_bg-border-color' ) );
	
	$less_vars->add_paddings( array(
		'mw-search-right-padding',
		'mw-search-left-padding',
	), of_get_option( 'microwidgets-search_input-padding' ) );
	
	/**
	 * Header & Top Bar -> Top bar
	 */

	$less_vars->add_pixel_number( 'top-bar-height', of_get_option( 'top-bar-height', '0' ) );
	$less_vars->add_font( array(
		'top-bar-font-family',
		'top-bar-font-weight',
		'top-bar-font-style',
	), of_get_option( 'top_bar-font-family' ) );

	$less_vars->add_pixel_number( 'top-bar-font-size', of_get_option( 'top_bar-font-size', '16' ) );

	$less_vars->add_keyword( 'top-bar-text-transform', ( of_get_option( 'top_bar-font-is_capitalized' ) ? 'uppercase' : 'none' ) );

	$less_vars->add_hex_color( 'top-color', of_get_option( 'top_bar-font-color' ) );

	$less_vars->add_paddings( array(
		'top-bar-padding-top',
		'top-bar-padding-bottom',
		'top-bar-side-paddings',
	), of_get_option( 'top_bar-padding' ) );

	$less_vars->add_rgba_color( 'top-bg-color', of_get_option( 'top_bar-bg-color' ) );
	$less_vars->add_rgba_color( 'top-bar-line-color', of_get_option( 'top_bar-line-color' ) );
	$less_vars->add_pixel_number( 'top-bar-line-size', of_get_option( 'top_bar-line_size' ) );
	$less_vars->add_keyword( 'top-bar-line-style', ( of_get_option( 'top_bar-line_style' ) ) );

	$less_vars->add_image( array(
		'top-bg-image',
		'top-bg-repeat',
		'top-bg-position-x',
		'top-bg-position-y',
	), of_get_option( 'top_bar-bg-image' ) );

	/**
	 * Header & Top Bar -> Header
	 */

	$less_vars->add_rgba_color( 'header-decoration', of_get_option( 'header-decoration-color' ) );

	$less_vars->add_rgba_color( 'header-bg-color', of_get_option( 'header-bg-color' ) );

	$less_vars->add_image( array(
		'header-bg-image',
		'header-bg-repeat',
		'header-bg-position-x',
		'header-bg-position-y',
	), of_get_option( 'header-bg-image' ) );

	$less_vars->add_keyword( 'header-bg-size', ( of_get_option( 'header-bg-is_fullscreen' ) ? 'cover' : 'auto' ) );

	// fix bg repeat
	if ( 'cover' === $less_vars->get_var( 'header-bg-size' ) ) {
		$less_vars->add_keyword( 'header-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword( 'header-bg-attachment', ( of_get_option( 'header-bg-is_fixed' ) ? 'fixed' : '~""' ) );

	$less_vars->add_rgba_color( 'navigation-line-decoration-color', of_get_option( 'header-mixed-decoration-color' ) );

	$less_vars->add_rgba_color( 'navigation-line-bg', of_get_option( 'header-mixed-bg-color' ) );

	$less_vars->add_hex_color( 'toggle-menu-color', of_get_option( "header-menu_icon-color" ) );

	$less_vars->add_rgba_color( 'toggle-menu-bg-color', of_get_option( 'header-menu_icon-bg-color' ) );

	$less_vars->add_hex_color( 'toggle-menu-hover-color', of_get_option( "header-menu_icon-hover-color" ) );

	$less_vars->add_rgba_color( 'toggle-menu-hover-bg-color', of_get_option( 'header-menu_icon-hover-bg-color' ) );

	$less_vars->add_rgba_color( 'navigation-bg-color', of_get_option( 'header-classic-menu-bg-color' ) );


	$less_vars->add_paddings( array(
		'toggle-menu-top-margin',
		'toggle-menu-right-margin',
		'toggle-menu-bottom-margin',
		'toggle-menu-left-margin',
	), of_get_option( 'header-menu_icon-margin' ) );

	$less_vars->add_paddings( array(
		'toggle-menu-close-top-margin',
		'toggle-menu-close-right-margin',
		'toggle-menu-close-bottom-margin',
		'toggle-menu-close-left-margin',
	), of_get_option( 'header-menu_close_icon-margin' ) );

	$less_vars->add_pixel_number( 'toggle-menu-border-radius', of_get_option( 'header-menu_icon-bg-border-radius', '0' ) );

	$less_vars->add_pixel_number( 'hamburger-size', of_get_option( 'header-menu_icon-bg-size' ) );

	/**
	 * Header & Top Bar -> Floating navigation
	 */

	$less_vars->add_pixel_number( 'float-menu-height', of_get_option( 'header-floating_navigation-height', '100' ) );

	$less_vars->add_rgba_color( 'float-menu-bg', of_get_option( 'header-floating_navigation-bg-color' ) );

	$less_vars->add_rgba_color( 'float-menu-line-decoration-color', of_get_option( 'header-floating_navigation-decoration-color' ) );

	/**
	 * Header & Top Bar -> Main menu
	 */

	$less_vars->add_font( array(
		'menu-font-family',
		'menu-font-weight',
		'menu-font-style',
	), of_get_option( 'header-menu-font-family' ) );

	$less_vars->add_pixel_number( 'menu-font-size', of_get_option( 'header-menu-font-size', '16' ) );

	$less_vars->add_pixel_number( 'outside-item-custom-margin', of_get_option( 'header-menu-item-surround_margins-custom-margin' ) );

	$less_vars->add_keyword( 'menu-text-transform', ( of_get_option( 'header-menu-font-is_capitalized' ) ? 'uppercase' : 'none' ) );

	$less_vars->add_font( array(
		'subtitle-font-family',
		'subtitle-font-weight',
		'subtitle-font-style',
	), of_get_option( 'header-menu-subtitle-font-family' ) );

	$less_vars->add_pixel_number( 'subtitle-font-size', of_get_option( 'header-menu-subtitle-font-size', '10' ) );

	$less_vars->add_hex_color( 'menu-color', of_get_option( 'header-menu-font-color', '#ffffff' ) );

	$less_vars->add_pixel_number( 'main-menu-icon-size', of_get_option( 'header-menu-icon-size', '16' ) );

	$less_vars->add_paddings( array(
		'menu-item-padding-top',
		'menu-item-padding-right',
		'menu-item-padding-bottom',
		'menu-item-padding-left',
	), of_get_option( 'header-menu-item-padding' ) );

	$less_vars->add_paddings( array(
		'menu-item-margin-top',
		'menu-item-margin-right',
		'menu-item-margin-bottom',
		'menu-item-margin-left',
	), of_get_option( 'header-menu-item-margin' ) );

	if ( 'custom' === of_get_option( 'header-menu-dividers-height-style' ) ) {

		$less_vars->add_pixel_number( 'menu-tem-divider-height', of_get_option( 'header-menu-dividers-height', '20' ) );

	} else {

		$less_vars->add_percent_number( 'menu-tem-divider-height', '100' );

	}

	$less_vars->add_rgba_color( 'menu-tem-divider-color', of_get_option( 'header-menu-dividers-color' ) );

	$less_vars->add_pixel_number( 'menu-decor-border-radius', of_get_option( 'header-menu-decoration-other-border-radius' ) );

	/**
	 * Header & Top Bar -> Submenu
	 */

	$less_vars->add_font( array(
		'submenu-font-family',
		'submenu-font-weight',
		'submenu-font-style',
	), of_get_option( 'header-menu-submenu-font-family' ) );

	$less_vars->add_pixel_number( 'submenu-font-size', of_get_option( 'header-menu-submenu-font-size' ) );

	$less_vars->add_keyword( 'submenu-text-transform', ( of_get_option( 'header-menu-submenu-font-is_uppercase' ) ? 'uppercase' : 'none' ) );

	$less_vars->add_font( array(
		'sub-subtitle-font-family',
		'sub-subtitle-font-weight',
		'sub-subtitle-font-style',
	), of_get_option( 'header-menu-submenu-subtitle-font-family' ) );

	$less_vars->add_pixel_number( 'sub-subtitle-font-size', of_get_option( 'header-menu-submenu-subtitle-font-size' ) );

	$less_vars->add_hex_color( 'submenu-color', of_get_option( 'header-menu-submenu-font-color' ) );


	$less_vars->add_pixel_number( 'sub-menu-icon-size', of_get_option( 'header-menu-submenu-icon-size' ) );

	$less_vars->add_paddings( array(
		'submenu-item-padding-top',
		'submenu-item-padding-right',
		'submenu-item-padding-bottom',
		'submenu-item-padding-left',
	), of_get_option( 'header-menu-submenu-item-padding' ) );

	$less_vars->add_paddings( array(
		'submenu-item-margin-top',
		'submenu-item-margin-right',
		'submenu-item-margin-bottom',
		'submenu-item-margin-left',
	), of_get_option( 'header-menu-submenu-item-margin' ) );

	$less_vars->add_rgba_color( 'submenu-bg-color', of_get_option( 'header-menu-submenu-bg-color' ) );

	$less_vars->add_pixel_number( 'submenu-width', of_get_option( 'header-menu-submenu-bg-width' ) );

	$less_vars->add_pixel_number( 'soc-icons-bg-size', of_get_option( 'header-elements-soc_icons-bg-size', '26' ) );

	$less_vars->add_pixel_number( 'soc-icons-size', of_get_option( 'header-elements-soc_icons-size', '16' ) );

	$less_vars->add_pixel_number( 'soc-icons-border-width', of_get_option( 'header-elements-soc_icons_border_width', '1' ) );

	$less_vars->add_pixel_number( 'soc-icons-border-radius', of_get_option( 'header-elements-soc_icons_border_radius', '100' ) );
	$less_vars->add_pixel_number( 'soc-icons-gap', of_get_option( 'header-elements-soc_icons_gap', '4px' ) );

	$less_vars->add_rgba_color( 'top-icons-color', of_get_option( 'header-elements-soc_icons-color' ) );

	$less_vars->add_rgba_color( 'soc-ico-hover-color', of_get_option( 'header-elements-soc_icons-hover-color' ) );



	/**
	 * Header & Top Bar -> Layout
	 */

	$header         = 'header-' . of_get_option( 'header-layout', 'inline' ) . '-';
	
	$areas_paddings = array(
		'elements-near_menu_left-padding'  => array(
			'menu-area-left-padding-top',
			'menu-area-left-padding-right',
			'menu-area-left-padding-bottom',
			'menu-area-left-padding-left',
		),
		'elements-near_menu_right-padding' => array(
			'menu-area-right-padding-top',
			'menu-area-right-padding-right',
			'menu-area-right-padding-bottom',
			'menu-area-right-padding-left',
		),
		'elements-top_line-padding'        => array(
			'menu-area-top-line-padding-top',
			'menu-area-top-line-padding-right',
			'menu-area-top-line-padding-bottom',
			'menu-area-top-line-padding-left',
		),
		'elements-top_line_right-padding'  => array(
			'menu-area-top-line-right-padding-top',
			'menu-area-top-line-right-padding-right',
			'menu-area-top-line-right-padding-bottom',
			'menu-area-top-line-right-padding-left',
		),
		'elements-below_menu-padding'      => array(
			'menu-area-below-padding-top',
			'menu-area-below-padding-right',
			'menu-area-below-padding-bottom',
			'menu-area-below-padding-left',
		),
		'elements-near_logo_left-padding'  => array(
			'logo-area-left-padding-top',
			'logo-area-left-padding-right',
			'logo-area-left-padding-bottom',
			'logo-area-left-padding-left',
		),
		'elements-near_logo_right-padding' => array(
			'logo-area-right-padding-top',
			'logo-area-right-padding-right',
			'logo-area-right-padding-bottom',
			'logo-area-right-padding-left',
		),
	);

	foreach ( $areas_paddings as $opt_id => $var ) {
		$less_vars->add_paddings( $var, of_get_option( "{$header}{$opt_id}" ) );
	}
	unset( $areas_paddings, $opt_id );

	$header_layout     = of_get_option( 'header-layout' );
	$header_navigation = "header-{$header_layout}-";
	if ( in_array( $header_layout, array( 'top_line', 'side_line', 'menu_icon' ), true ) ) {
		$header_navigation = 'header-' . of_get_option( 'header_navigation' ) . '-';
	}

	$less_vars->add_paddings( array(
		'top-content-padding',
		'right-content-padding',
		'bottom-content-padding',
		'left-content-padding',
	), of_get_option( "{$header_navigation}content-padding" ) );

	$less_vars->add_paddings( array(
		'classic-menu-top-margin',
		'classic-menu-bottom-margin',
	), of_get_option( "{$header}menu-margin" ) );

	$less_vars->add_paddings( array(
		'top-overlay-content-padding',
		'right-overlay-content-padding',
		'bottom-overlay-content-padding',
		'left-overlay-content-padding',
	), of_get_option( 'header-overlay-content-padding' ) );

	/**
	 * Header & Top Bar -> Additional elements
	 */

	$less_vars->add_font( array(
		'additional-menu-elements-font-family',
		'additional-menu-elements-font-weight',
		'additional-menu-elements-font-style',
	), of_get_option( "{$header}elements-near_menu-font_family" ) );

	$less_vars->add_pixel_number( 'additional-menu-elements-font-size', of_get_option( "{$header}elements-near_menu-font_size" ) );

	$less_vars->add_hex_color( 'additional-menu-elements-color', of_get_option( "{$header}elements-near_menu-font_color" ) );

	$less_vars->add_font( array(
		'additional-logo-elements-font-family',
		'additional-logo-elements-font-weight',
		'additional-logo-elements-font-style',
	), of_get_option( "{$header}elements-near_logo-font_family" ) );

	$less_vars->add_pixel_number( 'additional-logo-elements-font-size', of_get_option( "{$header}elements-near_logo-font_size" ) );

	$less_vars->add_hex_color( 'additional-logo-elements-color', of_get_option( "{$header}elements-near_logo-font_color" ) );

	$less_vars->add_font( array(
		'microwidgets-in-top-line-font_family',
		'microwidgets-in-top-line-font-weight',
		'microwidgets-in-top-line-font-style',
	), of_get_option( "{$header}elements-in_top_line-font_family" ) );

	$less_vars->add_pixel_number( 'microwidgets-in-top-line-font-size', of_get_option( "{$header}elements-in_top_line-font_size" ) );

	$less_vars->add_hex_color( 'microwidgets-in-top-line-color', of_get_option( "{$header}elements-in_top_line-font_color" ) );
	$less_vars->add_pixel_number( 'header-height', of_get_option( "{$header}height", '140' ) );

	$less_vars->add_pixel_number( 'side-header-h-stroke-height', of_get_option( "layout-top_line-height", '130' ) );

	$less_vars->add_pixel_number( 'side-header-v-stroke-width', of_get_option( "header-side_line-width", '60' ) );
	$less_vars->add_number( 'header-side-width', of_get_option( 'header-side-width', '300px' ) );
	$less_vars->add_number( 'header-slide-out-width', of_get_option( 'header-slide_out-width', '300px' ) );
	$less_vars->add_number( 'header-side-content-width', of_get_option( "header-overlay-content-width", '220px' ) );

	$less_vars->add_font( array(
		'microwidget-button-font-family',
		'microwidget-button-font-weight',
		'microwidget-button-font-style',
	), of_get_option( "header-elements-button-1-font-family" ) );

	$less_vars->add_pixel_number( 'microwidget-button-font-size', of_get_option( "header-elements-button-1-font-size" ) );
	$less_vars->add_pixel_number( 'microwidget-button-icon-size', of_get_option( 'header-elements-button-1-icon-size' ) );

	$less_vars->add_pixel_number( 'microwidget-button-border-radius', of_get_option( 'header-elements-button-1-border_radius' ) );

	$less_vars->add_pixel_number( 'microwidget-button-border-width', of_get_option( 'header-elements-button-1-border_width' ) );

	$less_vars->add_paddings( array(
		'microwidget-button-top-padding',
		'microwidget-button-right-padding',
		'microwidget-button-bottom-padding',
		'microwidget-button-left-padding',
	), of_get_option( 'header-elements-button-1-padding' ) );

	$less_vars->add_font( array(
		'microwidget-button-2-font-family',
		'microwidget-button-2-font-weight',
		'microwidget-button-2-font-style',
	), of_get_option( "header-elements-button-2-font-family" ) );

	$less_vars->add_pixel_number( 'microwidget-button-2-font-size', of_get_option( "header-elements-button-2-font-size" ) );
	$less_vars->add_pixel_number( 'microwidget-button-2-icon-size', of_get_option( 'header-elements-button-2-icon-size' ) );

	$less_vars->add_pixel_number( 'microwidget-button-2-border-radius', of_get_option( 'header-elements-button-2-border_radius' ) );

	$less_vars->add_pixel_number( 'microwidget-button-2-border-width', of_get_option( 'header-elements-button-2-border_width' ) );

	$less_vars->add_paddings( array(
		'microwidget-button-2-top-padding',
		'microwidget-button-2-right-padding',
		'microwidget-button-2-bottom-padding',
		'microwidget-button-2-left-padding',
	), of_get_option( 'header-elements-button-2-padding' ) );

	unset( $header );

	/**
	 * Branding.
	 */

	// paddings
	$indention = array(
		'main'               => 'header',
		'transparent'        => 'header-style-transparent',
		'floating'           => 'header-style-floating',
		'mobile'             => 'header-style-mobile',
		'transparent-mobile' => 'header-style-transparent-mobile',
		'bottom'             => 'bottom_bar',
		'mixed'              => 'header-style-mixed',
	);

	foreach ( $indention as $var_prefix => $opt_prefix ) {
		$less_vars->add_paddings( array(
			"{$var_prefix}-logo-top-padding",
			"{$var_prefix}-logo-right-padding",
			"{$var_prefix}-logo-bottom-padding",
			"{$var_prefix}-logo-left-padding",
		), of_get_option( "{$opt_prefix}-logo-padding" ) );
	}
	unset( $indention, $var_prefix );

	/**
	 * Bottom bar.
	 */

	$less_vars->add_hex_color( 'bottom-color', of_get_option( 'bottom_bar-color', '#757575' ) );

	$less_vars->add_rgba_color( 'bottom-bg-color', of_get_option( 'bottom_bar-bg_color' ) );

	$less_vars->add_image( array(
		'bottom-bg-image',
		'bottom-bg-repeat',
		'bottom-bg-position-x',
		'bottom-bg-position-y',
	), of_get_option( 'bottom_bar-bg_image' ) );

	/**
	 * Fonts.
	 */

	$less_vars->add_font( array(
		'base-font-family',
		'base-font-weight',
		'base-font-style',
	), of_get_option( 'fonts-font_family' ) );

	$less_vars->add_pixel_number( 'base-line-height', of_get_option( 'fonts-normal_size_line_height', '20' ) );

	$less_vars->add_pixel_number( 'text-small-line-height', of_get_option( 'fonts-small_size_line_height', '20' ) );

	$less_vars->add_pixel_number( 'text-big-line-height', of_get_option( 'fonts-big_size_line_height', '20' ) );

	$less_vars->add_pixel_number( 'base-font-size', of_get_option( 'fonts-normal_size', '13' ) );

	$less_vars->add_pixel_number( 'text-small', of_get_option( 'fonts-small_size', '11' ) );

	$less_vars->add_pixel_number( 'text-big', of_get_option( 'fonts-big_size', '15' ) );

	/**
	 * Sidebar.
	 */

	$less_vars->add_number( 'sidebar-width', of_get_option( 'sidebar-width', '30%' ) );

	$less_vars->add_pixel_number( 'widget-sidebar-distace', of_get_option( 'sidebar-vertical_distance', '60' ) );
	$less_vars->add_pixel_number( 'sidebar-distace-to-content', of_get_option( 'sidebar-distance_to_content', '50' ) );
	$less_vars->add_pixel_number( 'sidebar-responsiveness', of_get_option( 'sidebar-responsiveness', '970' ) );

	$less_vars->add_rgba_color( 'widget-sidebar-bg-color', of_get_option( 'sidebar-bg_color' ) );

	$less_vars->add_rgba_color( 'sidebar-outline-color', of_get_option( 'sidebar-decoration_outline_color' ) );

	$less_vars->add_image( array(
		'widget-sidebar-bg-image',
		'widget-sidebar-bg-repeat',
		'widget-sidebar-bg-position-x',
		'widget-sidebar-bg-position-y',
	), of_get_option( 'sidebar-bg_image' ) );

	$less_vars->add_hex_color( 'widget-sidebar-color', of_get_option( 'sidebar-primary_text_color', '#686868' ) );

	$less_vars->add_hex_color( 'widget-sidebar-header-color', of_get_option( 'sidebar-headers_color', '#000000' ) );

	/**
	 * Footer.
	 */

	$less_vars->add_rgba_color( 'footer-bg-color', of_get_option( 'footer-bg_color' ) );

	$less_vars->add_rgba_color( 'footer-outline-color', of_get_option( 'footer-decoration_outline_color' ) );

	$less_vars->add_image( array(
		'footer-bg-image',
		'footer-bg-repeat',
		'footer-bg-position-x',
		'footer-bg-position-y',
	), of_get_option( 'footer-bg_image' ) );

	$less_vars->add_hex_color( 'widget-footer-color', of_get_option( 'footer-primary_text_color', '#828282' ) );

	$less_vars->add_hex_color( 'widget-footer-header-color', of_get_option( 'footer-headers_color', '#ffffff' ) );
	$less_vars->add_hex_color( 'widget-footer-accent-color', of_get_option( 'footer-accent_text_color' ) );

	$less_vars->add_paddings( array(
		'footer-top-padding',
		'footer-bottom-padding',
	), of_get_option( 'footer-padding' ) );

	$less_vars->add_pixel_number( 'widget-footer-padding', of_get_option( 'footer-paddings-columns', '44' ) );

	$less_vars->add_pixel_number( 'footer-switch', of_get_option( 'footer-collapse_after', '760' ) );
	$less_vars->add_pixel_number( 'bottom-bar-switch', of_get_option( 'bottom_bar-collapse_after', '990' ) );
	$less_vars->add_pixel_number( 'bottom-bar-height', of_get_option( 'bottom_bar-height', '60' ) );
	$less_vars->add_paddings( array(
		'bottom-bar-top-padding',
		'bottom-bar-bottom-padding',
	), of_get_option( 'bottom_bar-padding' ) );

	/**
	 * Page titles.
	 */

	$less_vars->add_rgba_color( 'header-transparent-bg-color', of_get_option( 'header-transparent_bg_color' ) );
	$less_vars->add_rgba_color( 'top-bar-transparent-bg-color', of_get_option( 'top-bar-transparent_bg_color' ) );

	$less_vars->add_pixel_number( 'page-title-height', of_get_option( 'general-title_height', '170' ) );

	$less_vars->add_paddings( array(
		'page-title-top-padding',
		'page-title-bottom-padding',
	), of_get_option( 'page_title-padding' ), 'px|%' );

	$less_vars->add_keyword( 'page-title-bg-size', ( of_get_option( 'general-title_bg_fullscreen' ) ? '~"cover"' : '~"auto auto"' ) );

	$less_vars->add_pixel_number( 'general-title-responsiveness', of_get_option( 'general-titles-responsiveness-switch', '990' ) );
	$less_vars->add_pixel_number( 'page-responsive-title-height', of_get_option( 'general-responsive_title_height', '150' ) );
	$less_vars->add_pixel_number( 'title-responsive-font-size', of_get_option( 'general-responsive_title_size', '20' ) );
	$less_vars->add_pixel_number( 'page-responsive-title-line-height', of_get_option( 'general-responsive_title_line_height', '30' ) );

	/**
	 * General.
	 */

	$less_vars->add_number( 'content-width', of_get_option( 'general-content_width' ) );

	$less_vars->add_number( 'box-width', of_get_option( 'general-box_width' ) );

	$less_vars->add_pixel_number( 'side-content-paddings', of_get_option( 'general-side_content_paddings' ) );

	$less_vars->add_pixel_number( 'switch-content-paddings', of_get_option( 'general-switch_content_paddings' ) );

	$less_vars->add_pixel_number( 'mobile-side-content-paddings', of_get_option( 'general-mobile_side_content_paddings' ) );

	$less_vars->add_rgba_color( 'page-bg-color', of_get_option( 'general-bg_color' ) );

	$less_vars->add_rgba_color( 'beautiful-spinner-color', of_get_option( 'general-spinner_color' ) );

	$less_vars->add_image( array(
		'page-bg-image',
		'page-bg-repeat',
		'page-bg-position-x',
		'page-bg-position-y',
	), of_get_option( 'general-bg_image' ) );

	$less_vars->add_keyword( 'page-bg-size', ( of_get_option( 'general-bg_fullscreen' ) ? 'cover' : 'auto' ) );

	if ( 'cover' === $less_vars->get_var( 'page-bg-size' ) ) {
		$less_vars->add_keyword( 'page-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword( 'page-bg-attachment', ( of_get_option( 'general-bg_fixed' ) ? 'fixed' : '~""' ) );

	$less_vars->add_hex_color( 'body-bg-color', of_get_option( 'general-boxed_bg_color', '#252525' ) );

	$less_vars->add_image( array(
		'body-bg-image',
		'body-bg-repeat',
		'body-bg-position-x',
		'body-bg-position-y',
	), of_get_option( 'general-boxed_bg_image' ) );

	$less_vars->add_keyword( 'body-bg-size', ( of_get_option( 'general-boxed_bg_fullscreen' ) ? 'cover' : 'auto' ) );

	if ( 'cover' === $less_vars->get_var( 'body-bg-size' ) ) {
		$less_vars->add_keyword( 'body-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword( 'body-bg-attachment', ( of_get_option( 'general-boxed_bg_fixed' ) ? 'fixed' : '~""' ) );

	$less_vars->add_rgba_color( 'content-boxes-bg', of_get_option( 'general-content_boxes_bg_color' ) );

	$less_vars->add_rgba_color( 'divider-bg-color', of_get_option( 'general-content_boxes_decoration_outline_color' ) );

	$less_vars->add_rgba_color( 'divider-color', of_get_option( 'dividers-color' ) );

	$less_vars->add_pixel_number( 'border-radius-size', of_get_option( 'general-border_radius', '8' ) );

	$less_vars->add_pixel_number( 'filter-border-radius', of_get_option( 'general-filter_style-minimal-border_radius', '100' ) );

	$less_vars->add_pixel_number( 'filter-decoration-line-size', of_get_option( 'general-filter_style-material-line_size', '2' ) );

	$less_vars->add_font( array(
		'filter-font-family',
		'filter-font-weight',
		'filter-font-style',
	), of_get_option( 'general-filter-font-family' ) );

	$less_vars->add_pixel_number( 'filter-font-size', of_get_option( 'general-filter-font-size' ) );

	$less_vars->add_keyword( 'filter-text-transform', ( of_get_option( 'general-filter_ucase' ) ? 'uppercase' : 'none' ) );

	$less_vars->add_pixel_number( 'navigation-margin', of_get_option( 'general-navigation_margin' ) );

	$less_vars->add_paddings( array(
		'filter-item-padding-top',
		'filter-item-padding-right',
		'filter-item-padding-bottom',
		'filter-item-padding-left',
	), of_get_option( 'general-filter-padding' ) );

	$less_vars->add_paddings( array(
		'filter-item-margin-top',
		'filter-item-margin-right',
		'filter-item-margin-bottom',
		'filter-item-margin-left',
	), of_get_option( 'general-filter-margin' ) );

	$less_vars->add_paddings( array(
		'page-top-margin',
		'page-bottom-margin',
	), of_get_option( 'general-page_content_margin' ) );

	$less_vars->add_pixel_number( 'lightbox-arrow-size', of_get_option( 'general-lightbox_arrow_size', '62' ) );

	/**
	 * Fonts.
	 */

	$less_vars->add_hex_color( 'base-color', of_get_option( 'content-primary_text_color' ) );
	$less_vars->add_hex_color( 'secondary-text-color', of_get_option( 'content-secondary_text_color' ) );
	$less_vars->add_hex_color( 'links-color', of_get_option( 'content-links_color' ) );

	if ( function_exists( 'presscore_themeoptions_get_headers_defaults' ) ) {

		foreach ( presscore_themeoptions_get_headers_defaults() as $id => $opts ) {

			$less_vars->add_font( array(
				"{$id}-font-family",
				"{$id}-font-weight",
				"{$id}-font-style",
			), of_get_option( "fonts-{$id}_font_family" ) );

			$less_vars->add_pixel_number( "{$id}-font-size", of_get_option( "fonts-{$id}_font_size" ) );

			$less_vars->add_pixel_number( "{$id}-line-height", of_get_option( "fonts-{$id}_line_height" ) );

			$less_vars->add_keyword( "{$id}-text-transform", ( of_get_option( "fonts-{$id}_uppercase" ) ? 'uppercase' : 'none' ) );

			$less_vars->add_hex_color( "{$id}-color", of_get_option( 'content-headers_color' ) );

		}

	}

	/**
	 * Mobile.
	 */

	$less_vars->add_pixel_number( 'first-switch', of_get_option( 'header-mobile-first_switch-after' ) );

	$less_vars->add_pixel_number( 'second-switch', of_get_option( 'header-mobile-second_switch-after' ) );
	//mobile header
	$less_vars->add_rgba_color( 'mobile-header-bg-color', of_get_option( 'header-mobile-header-bg-color' ) );

	//microwidgets
	$less_vars->add_font( array(
		'mobile-microwidgets-font-family',
		'mobile-microwidgets-font-weight',
		'mobile-microwidgets-font-style',
	), of_get_option( 'header-mobile-microwidgets-font-family' ) );

	$less_vars->add_pixel_number( 'mobile-microwidgets-font-size', of_get_option( 'header-mobile-microwidgets-font-size' ) );
	$less_vars->add_hex_color( 'mobile-microwidgets-color', of_get_option( 'header-mobile-microwidgets-font-color' ) );
	//hamburger
	$less_vars->add_pixel_number( 'mobile-toggle-menu-border-radius', of_get_option( 'header-mobile-menu_icon-bg-border-radius', '0' ) );

	$less_vars->add_pixel_number( 'mobile-hamburger-bg-size', of_get_option( 'header-mobile-menu_icon-bg-size' ) );
	$less_vars->add_hex_color( 'mobile-toggle-menu-color', of_get_option( "header-mobile-menu_icon-color" ) );

	$less_vars->add_rgba_color( 'mobile-toggle-menu-bg-color', of_get_option( 'header-mobile-menu_icon-bg-color' ) );
	// menu
	$less_vars->add_font( array(
		'mobile-menu-font-family',
		'mobile-menu-font-weight',
		'mobile-menu-font-style',
	), of_get_option( 'header-mobile-menu-font-family' ) );

	$less_vars->add_pixel_number( 'mobile-menu-font-size', of_get_option( 'header-mobile-menu-font-size' ) );

	$less_vars->add_keyword( 'mobile-menu-text-transform', ( of_get_option( 'header-mobile-menu-font-is_capitalized' ) ? 'uppercase' : 'none' ) );

	// submenu
	$less_vars->add_font( array(
		'mobile-sub-menu-font-family',
		'mobile-sub-menu-font-weight',
		'mobile-sub-menu-font-style',
	), of_get_option( 'header-mobile-submenu-font-family' ) );

	$less_vars->add_pixel_number( 'mobile-sub-menu-font-size', of_get_option( 'header-mobile-submenu-font-size' ) );

	$less_vars->add_keyword( 'mobile-sub-menu-text-transform', ( of_get_option( 'header-mobile-submenu-font-is_capitalized' ) ? 'uppercase' : 'none' ) );

	// color
	$less_vars->add_hex_color( 'mobile-menu-color', of_get_option( 'header-mobile-menu-font-color' ) );


	$less_vars->add_rgba_color( 'mobile-menu-bg-color', of_get_option( 'header-mobile-menu-bg-color' ) );
	$less_vars->add_rgba_color( 'mobile-overlay-bg-color', of_get_option( 'header-mobile-overlay-bg-color' ) );

	$less_vars->add_pixel_number( 'mobile-menu-width', of_get_option( 'header-mobile-menu-bg-width' ) );

	$less_vars->add_pixel_number( 'first-switch-mobile-header-height', of_get_option( 'header-mobile-first_switch-height' ) );

	$less_vars->add_pixel_number( 'second-switch-mobile-header-height', of_get_option( 'header-mobile-second_switch-height' ) );

	/**
	 * Page titles.
	 */

	$less_vars->add_hex_color( 'page-title-breadcrumbs-color', of_get_option( 'general-breadcrumbs_color' ) );

	$less_vars->add_font( array(
		'breadcrumbs-font-family',
		'breadcrumbs-font-weight',
		'breadcrumbs-font-style',
	), of_get_option( 'general-breadcrumbs_font_family' ) );
	$less_vars->add_pixel_number( 'breadcrumbs-font-size', of_get_option( 'general-breadcrumbs_font_size', '32' ) );
	$less_vars->add_pixel_number( 'breadcrumbs-line-height', of_get_option( 'general-breadcrumbs_line_height', '36' ) );
	$less_vars->add_keyword( 'breadcrumbs-text-transform', ( of_get_option( 'general-breadcrumbs_uppercase' ) ? 'uppercase' : 'none' ) );
	$less_vars->add_rgba_color( 'breadcrumbs-bg-color', of_get_option( 'breadcrumbs_bg_color' ) );

	$less_vars->add_paddings( array(
		'breadcrumbs-padding-top',
		'breadcrumbs-padding-right',
		'breadcrumbs-padding-bottom',
		'breadcrumbs-padding-left',
	), of_get_option( 'breadcrumbs_padding' ) );

	$less_vars->add_paddings( array(
		'breadcrumbs-margin-top',
		'breadcrumbs-margin-right',
		'breadcrumbs-margin-bottom',
		'breadcrumbs-margin-left',
	), of_get_option( 'breadcrumbs_margin' ) );

	$less_vars->add_pixel_number( "breadcrumbs-border-radius", of_get_option( "breadcrumbs_border_radius", 0 ) );
	$less_vars->add_pixel_number( "breadcrumbs-border-width", of_get_option( "breadcrumbs_border_width", 0 ) );
	$less_vars->add_rgba_color( 'breadcrumbs-border-color', of_get_option( 'breadcrumbs_border_color' ) );


	$less_vars->add_hex_color( 'page-title-color', of_get_option( 'general-title_color' ) );
	$less_vars->add_font( array(
		'page-title-font-family',
		'page-title-font-weight',
		'page-title-font-style',
	), of_get_option( 'general-font_family' ) );
	$less_vars->add_pixel_number( 'title-font-size', of_get_option( 'general-title_size', '32' ) );
	$less_vars->add_pixel_number( 'page-title-line-height', of_get_option( 'general-title_line_height', '36' ) );
	$less_vars->add_keyword( 'page-title-text-transform', ( of_get_option( 'general-title_uppercase' ) ? 'uppercase' : 'none' ) );
	$less_vars->add_rgba_color( 'page-title-overlay-color', of_get_option( 'general-title_overlay_color' ) );
	$less_vars->add_rgba_color( 'title-outline-color', of_get_option( 'general-title_decoration_outline_color' ) );
	$less_vars->add_pixel_number( 'page-title-border-height', of_get_option( 'general-title_decoration_outline_height', '1px' ) );
	$less_vars->add_keyword( 'page-title-border-style', ( of_get_option( 'general-title_decoration_outline_style' ) ) );

	$less_vars->add_rgba_color( 'page-title-line-color', of_get_option( 'general-title_decoration_line_color' ) );
	$less_vars->add_pixel_number( 'page-title-decorative-line-height', of_get_option( 'general-title_decoration_line_height', '1px' ) );
	$less_vars->add_keyword( 'page-title-line-style', ( of_get_option( 'general-title_decoration_line_style' ) ) );


	$less_vars->add_image( array(
		'page-title-bg-image',
		'page-title-bg-repeat',
		'page-title-bg-position-x',
		'page-title-bg-position-y',
	), of_get_option( 'general-title_bg_image' ) );

	$less_vars->add_keyword( 'page-title-bg-attachment', ( of_get_option( 'general-title_scroll_effect' ) == 'fixed' ? 'fixed' : '~""' ) );

	/**
	 * Buttons.
	 */

	if ( function_exists( 'presscore_themeoptions_get_buttons_defaults' ) ) {

		foreach ( presscore_themeoptions_get_buttons_defaults() as $id => $opts ) {

			$less_vars->add_font( array(
				"dt-btn-{$id}-font-family",
				"dt-btn-{$id}-font-weight",
				"dt-btn-{$id}-font-style",
			), of_get_option( "buttons-{$id}_font_family" ) );

			$less_vars->add_pixel_number( "dt-btn-{$id}-font-size", of_get_option( "buttons-{$id}_font_size", $opts['fs'] ) );

			$less_vars->add_paddings( array(
				"btn-{$id}-padding-top",
				"btn-{$id}-padding-right",
				"btn-{$id}-padding-bottom",
				"btn-{$id}-padding-left",
			), of_get_option( "buttons-{$id}_padding" ) );

			$less_vars->add_keyword( "dt-btn-{$id}-text-transform", ( of_get_option( "buttons-{$id}_uppercase", $opts['uc'] ) ? 'uppercase' : 'none' ) );

			$less_vars->add_pixel_number( "dt-btn-{$id}-border-radius", of_get_option( "buttons-{$id}_border_radius", $opts['border_radius'] ) );

		}

	}

	/**
	 * Contact forms.
	 */

	$less_vars->add_pixel_number( 'input-height', of_get_option( 'input_height' ) );
	$less_vars->add_pixel_number( 'input-border-radius', of_get_option( 'input_border_radius' ) );
	$less_vars->add_pixel_number( 'input-border-width', of_get_option( 'input_border_width' ) );
	$less_vars->add_hex_color( 'input-color', of_get_option( 'input_color' ) );
	$less_vars->add_rgba_color( 'input-border-color', of_get_option( 'input_border_color' ) );
	$less_vars->add_rgba_color( 'input-bg-color', of_get_option( 'input_bg_color' ) );
	$less_vars->add_hex_color( 'message-color', of_get_option( 'message_color' ) );
	$less_vars->add_rgba_color( 'message-bg-color', of_get_option( 'message_bg_color' ) );
	/**
	 * WC.
	 */
	if ( 'browser_width_based' === of_get_option( 'woocommerce_shop_template_responsiveness' ) ) {
		$bwb_columns = of_get_option( 'woocommerce_shop_template_bwb_columns' );
		$columns     = array(
			'desktop'  => 'desktop',
			'v_tablet' => 'v-tablet',
			'h_tablet' => 'h-tablet',
			'phone'    => 'phone',
		);
		foreach ( $columns as $column => $data_att ) {
			$val         = ( isset( $bwb_columns[ $column ] ) ? absint( $bwb_columns[ $column ] ) : '' );
			$data_atts[] = 'data-' . $data_att . '-columns-num="' . esc_attr( $val ) . '"';

			$less_vars->add_keyword( $data_att . '-wc-columns-num', esc_attr( $val ) );

		};
	};

	$less_vars->add_pixel_number( 'wc-grid-product-gap', of_get_option( 'woocommerce_shop_template_gap' ) );
	$less_vars->add_pixel_number( 'wc-grid-product-min-width', of_get_option( 'woocommerce_shop_template_column_min_width' ) );

	/**
	 * Stripes.
	 */

	if ( function_exists( 'presscore_themeoptions_get_stripes_list' ) ) {

		foreach ( presscore_themeoptions_get_stripes_list() as $id => $opts ) {

			$less_vars->add_rgba_color( "strype-{$id}-bg-color", of_get_option( "stripes-stripe_{$id}_color", $opts['bg_color'] ), 100 );

			$less_vars->add_image( array(
				"strype-{$id}-bg-image",
				"strype-{$id}-bg-repeat",
				'',
				"strype-{$id}-bg-position-y",
			), of_get_option( "stripes-stripe_{$id}_bg_image", $opts['bg_img'] ) );

			$less_vars->add_keyword( "strype-{$id}-bg-size", ( of_get_option( "stripes-stripe_{$id}_bg_fullscreen" ) ? 'cover' : 'auto' ) );

			$less_vars->add_hex_color( "strype-{$id}-header-color", of_get_option( "stripes-stripe_{$id}_headers_color", $opts['text_header_color'] ) );

			$less_vars->add_rgba_color( "strype-{$id}-boxes-bg", of_get_option( "stripes-stripe_{$id}_content_boxes_bg_color" ), of_get_option( "stripes-stripe_{$id}_content_boxes_bg_opacity" ) );

			$less_vars->add_rgba_color( "strype-{$id}-divider-bg-color", of_get_option( "stripes-stripe_{$id}_content_boxes_decoration_outline_color" ), of_get_option( "stripes-stripe_{$id}_content_boxes_decoration_outline_opacity" ) );

			$less_vars->add_rgba_color( "strype-{$id}-backgrounds-bg-color", of_get_option( "stripes-stripe_{$id}_outline_color" ), of_get_option( "stripes-stripe_{$id}_outline_opacity" ) );

			$less_vars->add_hex_color( "strype-{$id}-color", of_get_option( "stripes-stripe_{$id}_text_color", $opts['text_color'] ) );

			if ( 'cover' === $less_vars->get_var( "strype-{$id}-bg-size" ) ) {
				$less_vars->add_keyword( "strype-{$id}-bg-repeat", 'no-repeat' );
				$less_vars->add_keyword( "strype-{$id}-bg-attachment", 'fixed' );
			} else {
				$less_vars->add_keyword( "strype-{$id}-bg-attachment", '~""' );
			}

		}

	}
}

add_action( 'presscore_setup_less_vars', 'presscore_action_add_less_vars' );
