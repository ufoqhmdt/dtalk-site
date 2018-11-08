<?php

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	"weight" => -1,
	"name" => __("Default Button", 'the7mk2'),
	"base" => "dt_default_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_default_button",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "vc_link",
			"class" => "",
			"heading" => __("Link URL", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			'heading' => __( 'Enable smooth scroll for anchor navigation', 'the7mk2' ),
			'param_name' => 'smooth_scroll',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'description' => __( 'for #anchor navigation', 'the7mk2' )
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'the7mk2')
		),
		array(
			"group" => __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'the7mk2'),
			"param_name" => "size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Large" => "big"
			),
			"description" => __("Buttons style, color, font, border radius & paddings can be set up in Theme Options / Buttons. ", 'the7mk2')
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button width", 'the7mk2'),
			"param_name" => "btn_width",
			"value" => array(
				"Default" => "btn_auto_width",
				"Custom" => "btn_fixed_width",
				"Fullwidth" => "btn_full_width"
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "custom_btn_width",
			"type" => "dt_number",
			"value" => "200px",
			'dependency'	=> array(
				'element'	=> 'btn_width',
				'value'		=> 'btn_fixed_width',
			),
			"edit_field_class" => "vc_col-sm-3 vc_column dt_col_custom",
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "button_alignment",
			"value" => array(
				"Inline left" => "btn_inline_left",
				"Inline right" => "btn_inline_right",
				"Left" => "btn_left",
				"Center" => "btn_center",
				"Right" => "btn_right"
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options()
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background color", 'the7mk2'),
			"param_name"	=> "default_btn_bg_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text color", 'the7mk2'),
			"param_name"	=> "text_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Icon", 'the7mk2'),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", 'the7mk2'),
			"param_name" => "icon",
			"value" => '',
			//"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', 'the7mk2'),
			'description' => sprintf( __( 'f.e. <code>&lt;i class="fa fa-arrow-circle-right"&gt;&lt;/i&gt;</code> <a href="%s" target="_blank">http://fontawesome.io/icons/</a>.', 'the7mk2' ), 'http://fontawesome.io/icons/' ),
			'edit_field_class' => 'custom-textarea-height vc_col-xs-12  vc_column',
		),
		array(
			"group"			=> __("Icon", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon alignment", 'the7mk2'),
			"param_name" => "icon_align",
			"value" => array(
				"Left" => "left",
				"Right" => "right"
			)
		),
		array(
			'type' => 'css_editor',
            'heading' => __( 'CSS box', 'the7mk2' ),
            'param_name' => 'css',
            'group' => __( 'Design Options ', 'the7mk2' ),
            'edit_field_class' => 'vc_col-sm-12 vc_column no-vc-background no-vc-padding no-vc-border',
		),
	)
);

