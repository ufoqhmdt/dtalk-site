<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title" => _x( "WooCommerce", 'theme-options', 'the7mk2' ),
	"menu_title" => _x( "WooCommerce", 'theme-options', 'the7mk2' ),
	"menu_slug" => "of-woocommerce-menu",
	"type" => "page"
);


/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Product list', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * List settings.
 */
$options[] = array( "name" => _x("Layout", "theme-options", 'the7mk2'), "type" => "block" );

$options[] = array(
	"name" => _x( "Layout", "theme-options", 'the7mk2' ),
	"id" => "wc_view_mode",
	"std" => "masonry_grid",
	"type" => "radio",
	//'show_hide'    => array( 'masonry_grid' => true, 'view_mode' => true ),
	'show_hide' => array(
        'masonry_grid'       => array( 'isotope-block-settings', 'masonry_show_desc' ),
        'list'       => array( 'list-block-settings', 'list_show_desc' ),
        'view_mode'       => array( 'isotope-block-settings',  'list-block-settings', 'default-block-settings', 'masonry_show_desc', 'list_show_desc' ),
        
    ),
	"options" => array(
		'masonry_grid' => _x( "Masonry/Grid", "theme-options", 'the7mk2' ),
		'list' => _x( "List", "theme-options", 'the7mk2' ),
		'view_mode' => _x( "Layout switcher", "theme-options", 'the7mk2' )
	)
);

$options[] = array( 'type' => 'js_hide_begin', 'class' => 'wc_view_mode default-block-settings' );

	$options[] = array( 'type' => 'divider' );

	$options[] = array(
		"name" => _x( "Default layout", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_layout_default",
		"std" => "masonry_grid_default",
		"type" => "radio",
		"options" => array(
			'masonry_grid_default' => _x( "Masonry/Grid", "theme-options", 'the7mk2' ),
			'list_default' => _x( "List", "theme-options", 'the7mk2' )
		),
	);
$options[] = array( "type" => "js_hide_end" );



	/**
	 * Masonry & Grid.
	 */
	$options[] = array(    "name" => _x('Masonry & Grid', 'theme-options', 'the7mk2'), 'class' => 'wc_view_mode isotope-block-settings', "type" => "block" );
	
		$options[] = array(
			"name" => _x( "Layout", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_shop_template_isotope",
			"std" => "masonry",
			"type" => "radio",
			"options" => array(
				'masonry' => _x( "Masonry", "theme-options", 'the7mk2' ),
				'grid' => _x( "Grid", "theme-options", 'the7mk2' )
			),
			
		);

		$options[] = array( 
			'type' => 'divider',
		);

		$options[] = array(
			"name" => _x( "Text & button position", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_display_product_info",
			"std" => "wc_btn_on_hoover",
			"type" => "images",
			'options'   => array(
				'under_image'       => array(
					'title' => _x( 'Text & button below image', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/woo-grid-01.gif',
				),
				'wc_btn_on_img'        => array(
					'title' => _x( 'Text below image, button on image', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/icon-image-always.gif',
				),
				'wc_btn_on_hoover'        => array(
					'title' => _x( 'Text below image, button on image hover', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/icon-image-hover.gif',
				),
			),
		);

		

		$options[] = array( 'type' => 'divider' );
		$options[] = array(
			'name' => _x( 'Responsiveness mode', "theme-options", 'the7mk2' ),
			"id" => 'woocommerce_shop_template_responsiveness',
			'type' => 'select',
			"class"	=> "middle",
			"std" => "post_width_based",
			'options' => array(
	            'browser_width_based' =>  __( 'Browser width based' ),
	            'post_width_based' =>  __( 'Post width based' ),
	        ),
		);
			//-- Browser width based.
		    $options[] = array(
				'name' => __('Number of columns', "theme-options", 'the7mk2'),
				'id' => 'woocommerce_shop_template_bwb_columns',
				'type' => 'responsive_columns',
				 'std' => array(
	                'desktop'  => 4,
	                'h_tablet' => 3,
	                'v_tablet' => 2,
	                'phone'    => 1,
	            ),

		        'dependency' => array(
					array(

						array(
							'field' => 'woocommerce_shop_template_responsiveness',
							'operator' => '==',
							'value' => 'browser_width_based',
						),
					),
					
				),
			);
		    // -- Post width based.
			$options[] = array(
				'name' => __('Column minimum width', "theme-options", 'the7mk2'),
				"id" => 'woocommerce_shop_template_column_min_width',
				"class" => "mini",
				"std" => '220',
				"type" => "text",

				'dependency' => array(
					array(

						array(
							'field' => 'woocommerce_shop_template_responsiveness',
							'operator' => '==',
							'value' => 'post_width_based',
						),
					),
					
				),
			);
			$options[] = array(
				'name' => __('Desired columns number', "theme-options", 'the7mk2'),
				"id" => 'woocommerce_shop_template_columns',
				"class" => "mini",
				"std" => '5',
				"type" => "text",
				"sanitize" => "dimensions",
				'dependency' => array(
					array(

						array(
							'field' => 'woocommerce_shop_template_responsiveness',
							'operator' => '==',
							'value' => 'post_width_based',
						),
					),
					
				),
			);

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name" => _x( "Gap between columns (px)", "theme-options", 'the7mk2' ),
			"desc" => _x( "For example: a value 10px will give you 20px gaps between posts", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_shop_template_gap",
			"class" => "mini",
			"std" => '22',
			"type" => "text",
			"sanitize" => "dimensions",
		);

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name" => _x( "Loading effect", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_shop_template_loading_effect",
			"std" => "none",
			"type" => "radio",
			"options" => array(
				'none'				=> _x( 'None', 'backend metabox', 'the7mk2' ),
				'fade_in'			=> _x( 'Fade in', 'backend metabox', 'the7mk2' ),
				'move_up'			=> _x( 'Move up', 'backend metabox', 'the7mk2' ),
				'scale_up'			=> _x( 'Scale up', 'backend metabox', 'the7mk2' ),
				'fall_perspective'	=> _x( 'Fall perspective', 'backend metabox', 'the7mk2' ),
				'fly'				=> _x( 'Fly', 'backend metabox', 'the7mk2' ),
				'flip'				=> _x( 'Flip', 'backend metabox', 'the7mk2' ),
				'helix'				=> _x( 'Helix', 'backend metabox', 'the7mk2' ),
				'scale'				=> _x( 'Scale', 'backend metabox', 'the7mk2' )
			)
		);

	

	

	/**
	 * List.
	 */
	$options[] = array(	"name" => _x('List', 'theme-options', 'the7mk2'), 'class' => 'wc_view_mode list-block-settings', "type" => "block" );

	$options[] = array(
		"name" => _x( "Image width (in 'px' or '%')", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_img_width",
		"class" => "mini",
		"std" => '30%',
		"type" => "text",
		"sanitize" => "css_width",
	);
	$options[] = array(
		"name" => _x( "Switch to mobile layout after (px)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_list_switch",
		"class" => "mini",
		"std" => '500px',
		"type" => "text",
		"sanitize" => "dimensions",
	);

	
	/**
	 * Appearance.
	 */
	$options[] = array(	"name" => _x('Appearance', 'theme-options', 'the7mk2'), "type" => "block" );

	$options[] = array(
		"name" => _x( "Change image on hover", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_hover_image",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);
	$options[] = array( "type" => "divider" );
	
	$options[] = array(
		"name" => _x( "Product titles", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_titles",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product price", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_price",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product rating", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_rating",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( '"Add to cart" button', "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_cart_icon",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'wc_view_mode masonry_show_desc' );

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product short description in masonry/grid layout", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_masonry_desc",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);
	$options[] = array( "type" => "js_hide_end" );
	

	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'wc_view_mode list_show_desc' );

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product short description in list layout", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_list_desc",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);
	$options[] = array( "type" => "js_hide_end" );





/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Product page", "theme-options", 'the7mk2'), "type" => "heading" );

/**
 * Related products.
 */
$options[] = array( "name" => _x("Product settings", "theme-options", 'the7mk2'), "type" => "block_begin" );

	// input
	$options[] = array(
		"name"		=> _x( "Maximum number of related products", "theme-options", 'the7mk2' ),
		"id"		=> "woocommerce_rel_products_max",
		"std"		=> "3",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "slider"
	);

/**
 * Product media width.
 */

	// input
	$options[] = array(
		"name" => _x( "Product image width (in 'px' or '%')", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_product_img_width",
		"class" => "mini",
		"std" => '30%',
		"type" => "text",
		"sanitize" => "css_width"
	);
	$options[] = array(
		"name" => _x( "Switch to one column layout after (px)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_product_switch",
		"class" => "mini",
		"std" => '768',
		"type" => "text",
		"sanitize" => "dimensions"
	);

$options[] = array( "type" => "block_end" );
/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Cart & Checkout', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
/**
 * Cart settings.
 */
$options[] = array( "name" => _x("Cart settings", "theme-options", 'the7mk2'), "type" => "block_begin" );

	
	$options[] = array(
		"name" => _x( "Side column width (in 'px' or '%')", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_cart_total_width",
		"class" => "mini",
		"std" => '30%',
		"desc"      => _x( 'Use 100% to place side column below checkout content', 'theme-options', 'the7mk2' ),
		"type" => "text",
		"sanitize" => "css_width"
	);

	$options[] = array(
		"name" => _x( "Switch to one column layout after (px)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_cart_switch",
		"class" => "mini",
		"std" => '700',
		"type" => "text",
		"sanitize" => "dimensions"
	);
	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Checkout steps", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_steps",
		"std" => 0,
		"type" => "radio",
		"options" => $en_dis_options
	);
	//if ( of_get_option( 'woocommerce_show_steps' ) ) {
		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
			"id"	=> "woocommerce_steps_bg_color",
			"std"	=> "#f8f8f9",
			"type"	=> "color",
			'dependency' => array(
				array(
					array(
						'field'    => 'woocommerce_show_steps',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);
		$options[] = array(
			"name"      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			// "desc"      => _x( '"Opacity" isn\'t compatible with slide-out footer', 'theme-options', 'the7mk2' ),
			"id"        => "woocommerce_steps-bg_opacity",
			"std"       => 100, 
			"type"      => "slider",
			'dependency' => array(
				array(
					array(
						'field'    => 'woocommerce_show_steps',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);
		$options[] = array(
			"name"	=> _x( 'Font color', 'theme-options', 'the7mk2' ),
			"id"	=> "woocommerce_steps_color",
			"std"	=> "#3b3f4a",
			"type"	=> "color",
			'dependency' => array(
				array(
					array(
						'field'    => 'woocommerce_show_steps',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);
		$options[] = array(
			"name" => _x( "Top padding", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_cart_top_padding",
			"class" => "mini",
			"std" => '30',
			"type" => "text",
			"sanitize" => "dimensions",
			'dependency' => array(
				array(
					array(
						'field'    => 'woocommerce_show_steps',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);
		$options[] = array(
			"name" => _x( "Bottom padding", "theme-options", 'the7mk2' ),
			"id" => "woocommerce_cart_bottom_padding",
			"class" => "mini",
			"std" => '30',
			"type" => "text",
			"sanitize" => "dimensions",
			'dependency' => array(
				array(
					array(
						'field'    => 'woocommerce_show_steps',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);
	//}


$options[] = array( "type" => "block_end" );
