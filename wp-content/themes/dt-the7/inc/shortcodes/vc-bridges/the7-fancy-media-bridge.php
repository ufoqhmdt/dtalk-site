<?php

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'weight'      => -1,
	'name'        => __( 'Fancy Media', 'the7mk2' ),
	'description' => __( 'Image or video from Media Library', 'the7mk2' ),
	'base'        => 'dt_fancy_image',
	'icon'        => 'dt_vc_ico_fancy_image',
	'class'       => 'dt_vc_sc_fancy_image',
	'category'    => __( 'by Dream-Theme', 'the7mk2' ),
	'params'      => array(
		array(
			'type'             => 'dropdown',
			'class'            => '',
			'heading'          => __( 'Type', 'the7mk2' ),
			'param_name'       => 'type',
			'value'            => array(
				'Uploaded media' => 'uploaded_image',
				'Media from url' => 'from_url',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'        => 'attach_image',
			'holder'      => 'img',
			'class'       => 'dt_image',
			'heading'     => __( 'Choose image', 'the7mk2' ),
			'param_name'  => 'image_id',
			'value'       => '',
			'description' => '',
			'dependency'  => array(
				'element' => 'type',
				'value'   => array(
					'uploaded_image',
				),
			),
		),
		array(
			'type'             => 'textfield',
			'class'            => 'dt_image',
			'heading'          => __( 'Image URL', 'the7mk2' ),
			'param_name'       => 'image',
			'value'            => '',
			'dependency'       => array(
				'element' => 'type',
				'value'   => array(
					'from_url',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'class'            => 'dt_image',
			'heading'          => __( 'Image size', 'the7mk2' ),
			'description'      => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'the7mk2' ),
			'param_name'       => 'image_dimensions',
			'value'            => '',
			'dependency'       => array(
				'element' => 'type',
				'value'   => array(
					'from_url',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'class'            => 'dt_image',
			'heading'          => __( 'Image ALT', 'the7mk2' ),
			'param_name'       => 'image_alt',
			'value'            => '',
			'dependency'       => array(
				'element' => 'type',
				'value'   => array(
					'from_url',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Video URL', 'the7mk2' ),
			'admin_label'      => true,
			'param_name'       => 'media',
			'value'            => '',
			'dependency'       => array(
				'element' => 'type',
				'value'   => array(
					'from_url',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'On click action', 'the7mk2' ),
			'param_name'       => 'onclick',
			'value'            => array(
				'None'             => 'none',
				'Open in lightbox' => 'lightbox',
				'Open custom link' => 'custom_link',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Image link', 'the7mk2' ),
			'param_name'       => 'image_link',
			'value'            => '',
			'dependency'       => array(
				'element' => 'onclick',
				'value'   => array( 'custom_link' ),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Link Target', 'the7mk2' ),
			'param_name'       => 'custom_link_target',
			'value'            => array(
				'Same window' => '_self',
				'New window'  => '_blank',
			),
			'dependency'       => array(
				'element' => 'onclick',
				'value'   => array( 'custom_link' ),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'       => 'dt_switch',
			'heading'    => __( 'Enable image hovers', 'the7mk2' ),
			'param_name' => 'image_hovers',
			'value'      => 'true',
			'options'    => array(
				'Yes' => 'true',
				'No'  => 'false',
			),
			'dependency' => array(
				'element' => 'onclick',
				'value'   => array( 'lightbox', 'custom_link' ),
			),
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Style', 'the7mk2' ),
			'param_name'       => 'style',
			'value'            => array(
				'Full-width media'                     => '1',
				'Media with padding & outline'         => '2',
				'Media with padding & background fill' => '3',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Width', 'the7mk2' ),
			'param_name'       => 'width',
			'value'            => '500',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Height', 'the7mk2' ),
			'param_name'       => 'height',
			'value'            => '',
			'description'      => __( 'In pixels. Will be calculated automatically if empty.', 'the7mk2' ),
			'dependency'       => array(
				'element' => 'type',
				'value'   => array(
					'uploaded_image',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading'          => __( 'Border radius', 'the7mk2' ),
			'param_name'       => 'border_radius',
			'type'             => 'dt_number',
			'value'            => '',
			'units'            => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Padding', 'the7mk2' ),
			'param_name'       => 'padding',
			'value'            => '',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'dependency'       => array(
				'element' => 'style',
				'value'   => array(
					'2',
					'3',
				),
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Margin-top', 'the7mk2' ),
			'param_name'       => 'margin_top',
			'value'            => '',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Margin-bottom', 'the7mk2' ),
			'param_name'       => 'margin_bottom',
			'value'            => '',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Margin-left', 'the7mk2' ),
			'param_name'       => 'margin_left',
			'value'            => '',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Margin-right', 'the7mk2' ),
			'param_name'       => 'margin_right',
			'value'            => '',
			'description'      => __( 'In pixels.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt-force-hidden',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Align', 'the7mk2' ),
			'param_name'       => 'align',
			'std'              => 'center',
			'value'            => array(
				'Left'   => 'left',
				'Center' => 'center',
				'Right'  => 'right',
			),
			'description'      => __( 'Please note: narrow image with left or right alignment will be wrapped by the text below.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Image decoration', 'the7mk2' ),
			'param_name'       => 'image_decoration',
			'value'            => array(
				'None'   => 'none',
				'Shadow' => 'shadow',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading'    => __( 'Horizontal length', 'the7mk2' ),
			'param_name' => 'shadow_h_length',
			'type'       => 'dt_number',
			'value'      => '5px',
			'units'      => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value'   => 'shadow',
			),
		),
		array(
			'heading'    => __( 'Vertical length', 'the7mk2' ),
			'param_name' => 'shadow_v_length',
			'type'       => 'dt_number',
			'value'      => '5px',
			'units'      => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value'   => 'shadow',
			),
		),
		array(
			'heading'    => __( 'Blur radius', 'the7mk2' ),
			'param_name' => 'shadow_blur_radius',
			'type'       => 'dt_number',
			'value'      => '5px',
			'units'      => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value'   => 'shadow',
			),
		),
		array(
			'heading'    => __( 'Spread', 'the7mk2' ),
			'param_name' => 'shadow_spread',
			'type'       => 'dt_number',
			'value'      => '5px',
			'units'      => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value'   => 'shadow',
			),
		),
		array(
			'heading'    => __( 'Shadow color', 'the7mk2' ),
			'type'       => 'colorpicker',
			'param_name' => 'shadow_color',
			'value'      => 'rgba(0,0,0,.6)',
			'dependency' => array(
				'element' => 'image_decoration',
				'value'   => 'shadow',
			),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Animation', 'the7mk2' ),
			'param_name'       => 'animation',
			'value'            => presscore_get_vc_animation_options(),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Extra class name', 'the7mk2' ),
			'param_name'       => 'extra_class',
			'value'            => '',
			'description'      => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type'       => 'css_editor',
			'heading'    => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'the7mk2' ),
		),
	),
);

