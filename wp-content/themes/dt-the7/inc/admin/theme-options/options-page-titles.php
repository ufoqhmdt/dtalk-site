<?php
/**
 * Page titles settings.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array( 'name' => _x( 'Layout', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'layout' );

	$options[] = array( 'name' => _x( 'Title area layout', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		//Title area layout
		$options['general-title_align'] = array(
			'id'        => 'general-title_align',
			'name'      => _x( 'Title area layout', 'theme-options', 'the7mk2' ),
			'desc'      => _x( 'Title and breadcrumbs interposition', 'theme-options', 'the7mk2' ),
			'type'      => 'images',
			'class'     => 'small',
			'std'       => 'left',
			'options'   => array(
				'left'		=> array(
					'title' => 'Left title + right breadcrumbs',
					'src'   => '/inc/admin/assets/images/l-r.gif',
				),
				'right'		=> array(
					'title' => 'Right title + left breadcrumbs',
					'src'   => '/inc/admin/assets/images/r-l.gif',
				),
				'all_left'	=> array(
					'title' => 'Left',
					'src'   => '/inc/admin/assets/images/l-l.gif',
				),
				'all_right'	=> array(
					'title' => 'Right',
					'src'   => '/inc/admin/assets/images/r-r.gif',
				),
				'center'	=> array(
					'title' => 'Centered',
					'src'   => '/inc/admin/assets/images/centre.gif',
				),
			),
		);

		//Title area height/paddings
		$options[] = array( 'type' => 'divider' );

		$options['general-title_height'] = array(
			'id'		=> 'general-title_height',
			'name'		=> _x( 'Title area height (px)', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> '170',
			'class'		=> 'mini',
			'sanitize'	=> 'dimensions',
		);

		$options[] = array( 'type' => 'divider' );

		$options['page_title-padding-top'] = array(
			'id'		=> 'page_title-padding-top',
			'name'       => _x( 'Top padding (px or %)', 'theme-options', 'the7mk2' ),
			'type'       => 'text',
			'std'        => '0px',
			'class'      => 'mini',
			'sanitize'   => 'css_width',
		);

		$options['page_title-padding-bottom'] = array(
			'id'		=> 'page_title-padding-bottom',
			'name'       => _x( 'Bottom padding (px or %)', 'theme-options', 'the7mk2' ),
			'type'       => 'text',
			'std'        => '0px',
			'class'      => 'mini',
			'sanitize'   => 'css_width',
		);

$options[] = array( 'name' => _x( 'Style', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'style' );

	// Title style
	$options[] = array( 'name' => _x( 'Title area style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-title_bg_mode'] = array(
			'id'		=> 'general-title_bg_mode',
			'name'		=> _x( 'Choose style', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'content_line',
			'options'	=> array(
				'disabled'			=> array(
					'title' => _x( 'Plain', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-disabled.gif',
				),
				'background'		=> array(
					'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/centre.gif',
				),
				'gradient'			=> array(
					'title' => _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-gradient.gif',
				),
				'content_line'		=> array(
					'title' => _x( 'Decorative line', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-content-width-line.gif',
				),
			),
			'show_hide'	=> array(
				'background' => array( 'general-title-bg-mode-main-container', 'general-title-bg-image', 'general-title-bg-solid-color' ),
				'gradient' => array( 'general-title-bg-mode-main-container', 'general-title-bg-gradient-color' ),
				'content_line' => array( 'general-title-line-mode-main-container' ),
			),
		);

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-mode-main-container' );

		
			//Title Background
			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-solid-color' );

				$options[] = array( 'name' => _x( 'Background', 'theme-options', 'the7mk2' ), 'type' => 'title' );
				$options['general-title_bg_color'] = array(
					'id'	=> 'general-title_bg_color',
					'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
				);

				$options['general-title_bg_opacity'] = array(
					'id'        => 'general-title_bg_opacity',
					'name'      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
					'type'      => 'slider',
					'std'       => 100, 
				);

				$options[] = array( 'type' => 'divider' );

				//Title border bottom
				$options[] = array( 'name' => _x( 'Border', 'theme-options', 'the7mk2' ), 'type' => 'title' );


				$options['general-title_decoration'] = array(
					'id'		=> 'general-title_decoration',
					'name'		=> _x( 'Border', 'theme-options', 'the7mk2' ),
					'type'		=> 'radio',
					'class'     => 'small',
					'desc'      => _x( 'Decorative line below background.', 'theme-options', 'the7mk2' ),
					'std'		=> 'none',
					'show_hide'	=> array( 'outline'	=> true ),
					'options'	=> array(
						'outline'  => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'none'  => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					),
				);

				$options[] = array( 'type' => 'js_hide_begin' );

					$options['general-title_decoration_outline_color'] = array(
						'id'	=> 'general-title_decoration_outline_color',
						'name'	=> _x( 'Border color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#FFFFFF',
					);

					$options['general-title_decoration_outline_opacity'] = array(
						'id'        => 'general-title_decoration_outline_opacity',
						'name'      => _x( 'Border opacity', 'theme-options', 'the7mk2' ),
						'type'      => 'slider',
						'std'       => 100,
					);
					$options['general-title_decoration_outline_height'] = array(
						"name"		=> _x( "Border height (px)", "theme-options", 'the7mk2' ),
						"id"		=> "general-title_decoration_outline_height",
						"class"		=> "mini",
						"std"		=> '1',
						"type"		=> "text",
						"sanitize"	=> "dimensions",
					);
					$options['general-title_decoration_outline_style'] = array(
						'name' => _x( 'Border style', "theme-options", 'the7mk2' ),
						"id" => 'general-title_decoration_outline_style',
						'type' => 'select',
						"class"	=> "middle",
						"std" => "solid",
						'options' => array(
				            'solid' =>  __( 'Solid' ),
				            'dotted' =>  __( 'Dotted' ),
				            'dashed' =>  __( 'Dashed' ),
				            'double' =>  __( 'Double' ),
				        ),
					);


				$options[] = array( 'type' => 'js_hide_end' );
				//-----

				$options[] = array( 'type' => 'divider' );

			$options[] = array( 'type' => 'js_hide_end' );


			//Title gradient settings
			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-gradient-color' );

				$options[] = array( 'name' => _x( 'Gradient', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				$options['general-title_bg_gradient'] = array(
					'id'	=> 'general-title_bg_gradient',
					'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
				);
				$options['general-title_dir_gradient'] = array(
					"name"		=> _x( "Gradient direction (deg)", "theme-options", 'the7mk2' ),
					"id"		=> "general-title_dir_gradient",
					"class"		=> "mini",
					"std"		=> '135',
					"type"		=> "text",
					"sanitize"	=> "dimensions",
				);
				//-----

			$options[] = array( 'type' => 'js_hide_end' );

			//Title image bg settings
			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-image' );

			$options[] = array( 'name' => _x( 'Background Image', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				$options['general-title_enable_bg_img'] = array(
					'id'		=> 'general-title_enable_bg_img',
					'name'		=> _x( 'Background Image', 'theme-options', 'the7mk2' ),
					'type'		=> 'radio',
					'class'     => 'small',
					'std'		=> 'disabled',
					'show_hide'	=> array( 'enabled'	=> true ),
					'options'	=> array(
						'enabled' => _x( 'Enabled', 'backend metabox', 'the7mk2' ),
						'disabled'	=>  _x( 'Disabled', 'backend metabox', 'the7mk2' ),
					),
				);

				$options[] = array( 'type' => 'js_hide_begin' );

					$options['general-title_bg_image'] = array(
						'id' 			=> 'general-title_bg_image',
						'name' 			=> _x( 'Add background image', 'theme-options', 'the7mk2' ),
						'type' 			=> 'background_img',
						'std' 			=> array(
							'image'			=> '',
							'repeat'		=> 'repeat',
							'position_x'	=> 'center',
							'position_y'	=> 'center',
						),
					);
					//-----

					$options['general-title_bg_fullscreen'] = array(
						'id'    	=> 'general-title_bg_fullscreen',
						'name'      => _x( 'Fullscreen ', 'theme-options', 'the7mk2' ),
						'type'  	=> 'checkbox',
						'std'   	=> 0,
					);
					//-----

					//Title overlay bg settings
					$options['general-title_bg_overlay'] = array(
						'id'    	=> 'general-title_bg_overlay',
						'name'      => _x( 'Enable color overlay ', 'theme-options', 'the7mk2' ),
						'type'  	=> 'checkbox',
						'std'   	=> 0,
					);

					$options['general-title_overlay_color'] = array(
						'id'	=> 'general-title_overlay_color',
						'name'	=> _x( 'Overlay color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#000',
						'dependency' => array(
							array(
								array(
									'field'    => 'general-title_bg_overlay',
									'operator' => '==',
									'value'    => '1',
								),
							),
						),
					);

					$options['general-title_bg_overlay_opacity'] = array(
						'id'        => 'general-title_bg_overlay_opacity',
						'name'      => _x( 'Overlay opacity', 'theme-options', 'the7mk2' ),
						'type'      => 'slider',
						'std'       => 50,
						'dependency' => array(
							array(
								array(
									'field'    => 'general-title_bg_overlay',
									'operator' => '==',
									'value'    => '1',
								),
							),
						),
					);
					//-----


					//Background effects
					$options['general-title_scroll_effect'] = array(
						'name' => _x( 'Scroll effect', 'theme-options', 'the7mk2' ),
						'id' => 'general-title_scroll_effect',
						'type' => 'radio',
						'std' => 'default',
						'options' => array(
							'default' => _x( 'Move with the content', 'theme-options', 'the7mk2' ),
							'fixed' => _x( "Fixed at it's position", 'theme-options', 'the7mk2' ),
							'parallax' => _x( 'Vertical parallax on scroll', 'theme-options', 'the7mk2' ),
						),
						'show_hide' => array( 'custom' => true ),
					);

					//-----

					$options['general-title_bg_parallax'] = array(
						'id'		=> 'general-title_bg_parallax',
						'name'		=> _x( 'Parallax speed', 'theme-options', 'the7mk2' ),
						'desc'      => _x( 'Enter value between 0 to 1', 'theme-options', 'the7mk2' ),
						'type'		=> 'text',
						'std'		=> '0.5',
						'class'		=> 'mini',
						'dependency' => array(
							array(
								array(
									'field'    => 'general-title_scroll_effect',
									'operator' => '==',
									'value'    => 'parallax',
								),
							),
						),
					);
					//-----

				$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'divider' );
			$options[] = array( 'name' => _x( 'Header', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			//Choose header style
			$options['header-background'] = array(
				'id'      		=> 'header-background',
				'name'    		=> _x( 'Header style', 'theme-options', 'the7mk2' ),
				'std'			=> 'normal',
				'type'    		=> 'images',
				'class'         => 'small',
				'options'		=> array(
					'normal'		=> array(
						'src' => '/inc/admin/assets/images/header-background-default.gif',
						'title' => _x( 'Default', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
					'overlap'		=> array(
						'src' => '/inc/admin/assets/images/header-background-overlapping.gif',
						'title' => _x( 'Overlapping', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
					'transparent'	=> array(
						'src' => '/inc/admin/assets/images/header-background-transparent.gif',
						'title' => _x( 'Transparent', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
				),
				'show_hide'	=> array(
					'transparent' => true,
				),
			);

			//Transparent header style
			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-transparent_bg_color'] = array(
					'id'      		=> 'header-transparent_bg_color',
					'name'    		=> _x( 'Header color', 'backend metabox', 'the7mk2' ),
					'type'    		=> 'color',
					'std'			=> '#000000',
				);

				$options['header-transparent_bg_opacity'] = array(
					'id'	=> 'header-transparent_bg_opacity',
					'name'	=> _x( 'Header opacity', 'backend metabox', 'the7mk2' ),
					'type'	=> 'slider',
					'std'	=> '50',
					'options' => array(
						'min' => 0,
						'max' => 100,
					),
				);

				$options['page_title-background-style-transparent-color_scheme'] = array(
					'id'		=> 'page_title-background-style-transparent-color_scheme',
					'name'		=> _x( 'Color scheme', 'theme-options', 'the7mk2' ),
					'desc'      => _x( 'Affects menu color, top bar, microwidgets etc.', 'theme-options', 'the7mk2' ),
					'type'		=> 'radio',
					'std'		=> 'from_options',
					'options'	=> array(
						'from_options' => _x( 'From Theme Options', 'theme-options', 'the7mk2' ),
						'light'        => _x( 'Light', 'theme-options', 'the7mk2' ),
					),
				);

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		
		//Title Decorative line mode
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-line-mode-main-container' );

			$options[] = array( 'type' => 'divider' );

			//Title border bottom
			$options[] = array( 'name' => _x( 'Decorative line', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				$options['general-title_decoration_line_color'] = array(
					'id'	=> 'general-title_decoration_line_color',
					'name'	=> _x( 'Сolor', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#333333',
				);

				$options['general-title_decoration_line_opacity'] = array(
					'id'        => 'general-title_decoration_line_opacity',
					'name'      => _x( 'Opacity', 'theme-options', 'the7mk2' ),
					'type'      => 'slider',
					'std'       => 11,
				);
				$options['general-title_decoration_line_height'] = array(
					"name"		=> _x( "Height (px)", "theme-options", 'the7mk2' ),
					"id"		=> "general-title_decoration_line_height",
					"class"		=> "mini",
					"std"		=> '1',
					"type"		=> "text",
					"sanitize"	=> "dimensions",
				);
				$options['general-title_decoration_line_style'] = array(
					'name' => _x( 'Style', "theme-options", 'the7mk2' ),
					"id" => 'general-title_decoration_line_style',
					'type' => 'select',
					"class"	=> "middle",
					"std" => "solid",
					'options' => array(
			            'solid' =>  __( 'Solid' ),
			            'dotted' =>  __( 'Dotted' ),
			            'dashed' =>  __( 'Dashed' ),
			            'double' =>  __( 'Double' ),
			        ),
				);

		$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( 'name' => _x( 'Title', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'title' );
	$options[] = array( 'name' => _x( 'Page title', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		//Enable/disable Title

		$options['general-show_titles'] = array(
			'id'		=> 'general-show_titles',
			'name'		=> _x( 'Page title', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> '1',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showtitles-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showtitles-disabled.gif',
				),
			),
		);

		// Title font settings
		$options['general-font_family'] = array(
			"name"      => _x( 'Font family', 'theme-options', 'the7mk2' ),
			"id"        => "general-font_family",
			"std"       => 'Roboto:700',
			"type"      => "web_fonts",
			"fonts"     => 'all',
			'dependency' => array(
				array(
					array(
						'field'    => 'general-show_titles',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		$options['general-title_size'] = array(
			"name"      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			"id"        => "general-title_size",
			"std"       => '30',
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 120 ),
			"sanitize"  => 'font_size',
			'dependency' => array(
				array(
					array(
						'field'    => 'general-show_titles',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		$options['general-title_line_height'] = array(
			"name"      => _x( 'Line height', 'theme-options', 'the7mk2' ),
			"id"        => "general-title_line_height",
			"std"       => '36',
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 150 ),
			//"sanitize"  => 'font_size',
			'dependency' => array(
				array(
					array(
						'field'    => 'general-show_titles',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		$options['general-title_uppercase'] = array(
			"name" => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
			"id" => 'general-title_uppercase',
			"type" => 'checkbox',
			'std' => '0',
			'dependency' => array(
				array(
					array(
						'field'    => 'general-show_titles',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		$options['general-title_color'] = array(
			'id'	=> 'general-title_color',
			'name'	=> _x( 'Font color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#222222',
			'dependency' => array(
				array(
					array(
						'field'    => 'general-show_titles',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);


$options[] = array( 'name' => _x( 'Breadcrumbs', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'breadcrumbs' );
	$options[] = array( 'name' => _x( 'Breadcrumbs', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		// Title breadcrumbs
		$options['general-show_breadcrumbs'] = array(
			'id'		=> 'general-show_breadcrumbs',
			'name'		=> _x('Breadcrumbs', 'theme-options', 'the7mk2'),
			'std'		=> '1',
			'type'		=> 'images',
			'class'     => 'small',
			'show_hide'	=> array( '1'	=> true ),
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showbreadcrumbs-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showbreadcrumbs-disabled.gif',
				),
			),
		);
		$options[] = array( 'type' => 'js_hide_begin' );
			$options[] = array( 'type' => 'divider' );
			$options[] = array( 'name' => _x( 'Font', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['general-breadcrumbs_font_family'] = array(
				"name"      => _x( 'Font family', 'theme-options', 'the7mk2' ),
				"id"        => "general-breadcrumbs_font_family",
				"std"       => "Open Sans",
				"type"      => "web_fonts",
				"fonts"     => 'all',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['general-breadcrumbs_font_size'] = array(
				"name"      => _x( 'Font size', 'theme-options', 'the7mk2' ),
				"id"        => "general-breadcrumbs_font_size",
				"std"       => '12', 
				"type"      => "slider",
				"options"   => array( 'min' => 9, 'max' => 120 ),
				"sanitize"  => 'font_size',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['general-breadcrumbs_line_height'] = array(
				"name"      => _x( 'Line height', 'theme-options', 'the7mk2' ),
				"id"        => "general-breadcrumbs_line_height",
				"std"       => '16', 
				"type"      => "slider",
				"options"   => array( 'min' => 9, 'max' => 150 ),
				"sanitize"  => 'font_size',
				'dependency' => array(
						array(
							array(
								'field'    => 'general-show_breadcrumbs',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
			);

			$options['general-breadcrumbs_uppercase'] = array(
				"name" => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
				"id" => 'general-breadcrumbs_uppercase',
				"type" => 'checkbox',
				'std' => '0',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['general-breadcrumbs_color'] = array(
				'id'	=> 'general-breadcrumbs_color',
				'name'	=> _x( 'Font color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options[] = array( 'type' => 'divider' );
			$options[] = array( 'name' => _x( 'Paddings', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['breadcrumbs_padding-top'] = array(
				'id' => 'breadcrumbs_padding-top',
				'name' => _x( 'Padding top (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '3px',
				"class"	=> "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_padding-right'] = array(
				'id' => 'breadcrumbs_padding-right',
				'name' => _x( 'Padding right (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '12px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_padding-bottom'] = array(
				'id' => 'breadcrumbs_padding-bottom',
				'name' => _x( 'Padding bottom (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '2px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_padding-left'] = array(
				'id' => 'breadcrumbs_padding-left',
				'name' => _x( 'Padding left (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '12px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options[] = array( 'type' => 'divider' );
			$options[] = array( 'name' => _x( 'Margins', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['breadcrumbs_margin-top'] = array(
				'id' => 'breadcrumbs_margin-top',
				'name' => _x( 'Margin top (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '0px',
				"class"	=> "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_margin-right'] = array(
				'id' => 'breadcrumbs_margin-right',
				'name' => _x( 'Margin right (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '0px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_margin-bottom'] = array(
				'id' => 'breadcrumbs_margin-bottom',
				'name' => _x( 'Margin bottom (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '0px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_margin-left'] = array(
				'id' => 'breadcrumbs_margin-left',
				'name' => _x( 'Margin left (px or %)', 'theme-options', 'the7mk2' ),
				"type" => "text",
				'std' => '0px',
				"class" => "mini",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options[] = array( 'type' => 'divider' );
			$options[] = array( 'name' => _x( 'Background & border', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['general-breadcrumbs_bg_color'] = array(
				'id'		=> 'general-breadcrumbs_bg_color',
				'name'		=> _x( 'Background & border', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'disabled',
				'options'	=> array(
					
					'enabled'		=> array(
						'title' => _x( 'Enabled', 'backend metabox', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/general-breadcrumbsbgcolor-black.gif',
					),
					'disabled'	=> array(
						'title' => _x( 'Disabled', 'backend metabox', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/general-breadcrumbsbgcolor-disabled.gif',
					),
				),
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['breadcrumbs_bg_color'] = array(
				'id'	=> 'breadcrumbs_bg_color',
				'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);

			$options['breadcrumbs_bg_opacity'] = array(
				'id'        => 'breadcrumbs_bg_opacity',
				'name'      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
				'type'      => 'slider',
				'std'       => 20,
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);

			$options['breadcrumbs_border_radius'] = array(
				"name"		=> _x( "Border radius (px)", "theme-options", 'the7mk2' ),
				"id"		=> "breadcrumbs_border_radius",
				"class"		=> "mini",
				"std"		=> 2,
				"type"		=> "text",
				"sanitize"	=> "dimensions",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);

			$options['breadcrumbs_border_width'] = array(
				"name"		=> _x( "Border width (px)", "theme-options", 'the7mk2' ),
				"id"		=> "breadcrumbs_border_width",
				"class"		=> "mini",
				"std"		=> 0,
				"type"		=> "text",
				"sanitize"	=> "dimensions",
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);

			$options['breadcrumbs_border_color'] = array(
				'id'	=> 'breadcrumbs_border_color',
				'name'	=> _x( 'Border color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);

			$options['breadcrumbs_border_opacity'] = array(
				'id'        => 'breadcrumbs_border_opacity',
				'name'      => _x( 'Border opacity', 'theme-options', 'the7mk2' ),
				'type'      => 'slider',
				'std'       => 50,
				'dependency' => array(
					array(
						array(
							'field'    => 'general-breadcrumbs_bg_color',
							'operator' => '==',
							'value'    => 'enabled',
						),
					),
				),
			);
		$options[] = array( 'type' => 'js_hide_end' );



$options[] = array( 'name' => _x( 'Responsiveness', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'responsiveness' );

	// Title Responsiveness
	$options[] = array( 'name' => _x( 'Responsive layout ', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-titles_responsiveness'] = array(
			'id'		=> 'general-titles_responsiveness',
			'name'		=> _x( 'Responsive layout', 'theme-options', 'the7mk2' ),
			'type'		=> 'radio',
			'class'     => 'small',
			'std'		=> '0',
			'options'	=> array(
				'1'  => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					
				'0'  => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					
			),
			'show_hide'	=> array(
				'1' => true,
			),
		);
		

		$options[] = array( 'type' => 'js_hide_begin' );

			$options[] = array(
				"name"		=> _x('Switch to responsive layout after (px)', 'theme-options', 'the7mk2'),
				"id"		=> 'general-titles-responsiveness-switch',
				"std"		=> "990",
				"type"		=> "text",
				"class"		=> "mini",
				"sanitize"	=> "dimensions"
			);
			$options['general-responsive_title_height'] = array(
				'id'		=> 'general-responsive_title_height',
				'name'		=> _x( 'Responsive title area height (px)', 'theme-options', 'the7mk2' ),
				'type'		=> 'text',
				'std'		=> '150',
				'class'		=> 'mini',
				'sanitize'	=> 'dimensions',
			);
			$options['general-responsive_title_size'] = array(
				"name"      => _x( 'Responsive title font size', 'theme-options', 'the7mk2' ),
				"id"        => "general-responsive_title_size",
				"std"       => '20',
				"type"      => "slider",
				"options"   => array( 'min' => 9, 'max' => 120 ),
				"sanitize"  => 'font_size',
			);

			$options['general-responsive_title_line_height'] = array(
				"name"      => _x( 'Responsive title line height', 'theme-options', 'the7mk2' ),
				"id"        => "general-responsive_title_line_height",
				"std"       => '30',
				"type"      => "slider",
				"options"   => array( 'min' => 9, 'max' => 150 ),
			);
			$options['general-title_responsive_breadcrumbs'] = array(
				"name" => _x( 'Disable breadcrumbs', 'theme-options', 'the7mk2' ),
				"id" => 'general-title_responsive_breadcrumbs',
				"type" => 'checkbox',
				'std' => '0',
			);

		$options[] = array( 'type' => 'js_hide_end' );
