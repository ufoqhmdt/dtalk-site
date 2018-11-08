<?php
/**
 * Buttons options.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Heading definition.
 */
$options[] = array( 'name' => _x( 'Buttons', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'buttons' );

/**
 * Buttons style.
 */
$options[] = array( 'name' => _x( 'Buttons style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['buttons-style'] = array(
	'name'    => 'Choose buttons style',
	'id'      => 'buttons-style',
	'std'     => 'flat',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'flat'   => array(
			'title' => _x( 'Flat', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/buttons-style-flat.gif',
		),
		'3d'     => array(
			'title' => _x( '3D', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/buttons-style-3d.gif',
		),
		'shadow' => array(
			'title' => _x( 'Shadow', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/buttons-style-shadow.gif',
		),
	),
);

/**
 * Buttons color.
 */
$options[] = array( 'name' => _x( 'Buttons color', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['buttons-color_mode'] = array(
	'name'    => _x( 'Buttons color', 'theme-options', 'the7mk2' ),
	'id'      => 'buttons-color_mode',
	'std'     => 'accent',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'accent'   => array(
			'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-accent.gif',
		),
		'color'    => array(
			'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom.gif',
		),
		'gradient' => array(
			'title' => _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom-gradient.gif',
		),
	),
);

$options['buttons-color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-color',
	'std'        => '#ffffff',
	'type'       => 'color',
	'dependency' => array(
		'field'    => 'buttons-color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

$options['buttons-color_gradient'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-color_gradient',
	'std'        => '135deg|#ffffff 30%|#000000 100%',
	'type'       => 'gradient_picker',
	'dependency' => array(
		'field'    => 'buttons-color_mode',
		'operator' => '==',
		'value'    => 'gradient',
	),
);

$options['buttons-hover_color_mode'] = array(
	'name'    => _x( 'Buttons hover color', 'theme-options', 'the7mk2' ),
	'id'      => 'buttons-hover_color_mode',
	'std'     => 'accent',
	'type'    => 'images',
	'class'   => 'small',
	'divider' => 'top',
	'options' => array(
		'accent'   => array(
			'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-accent.gif',
		),
		'color'    => array(
			'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom.gif',
		),
		'gradient' => array(
			'title' => _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom-gradient.gif',
		),
	),
);

$options['buttons-hover_color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-hover_color',
	'std'        => '#ffffff',
	'type'       => 'color',
	'dependency' => array(
		'field'    => 'buttons-hover_color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

$options['buttons-hover_color_gradient'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-hover_color_gradient',
	'std'        => '135deg|#ffffff 30%|#000000 100%',
	'type'       => 'gradient_picker',
	'dependency' => array(
		'field'    => 'buttons-hover_color_mode',
		'operator' => '==',
		'value'    => 'gradient',
	),
);

$options['buttons-text_color_mode'] = array(
	'name'    => _x( 'Text color', 'theme-options', 'the7mk2' ),
	'id'      => 'buttons-text_color_mode',
	'std'     => 'color',
	'type'    => 'images',
	'class'   => 'small',
	'divider' => 'top',
	'options' => array(
		'accent' => array(
			'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-accent.gif',
		),
		'color'  => array(
			'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom.gif',
		),
	),
);

$options['buttons-text_color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-text_color',
	'std'        => '#ffffff',
	'type'       => 'color',
	'dependency' => array(
		'field'    => 'buttons-text_color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

$options['buttons-text_hover_color_mode'] = array(
	'name'    => _x( 'Text hover color', 'theme-options', 'the7mk2' ),
	'id'      => 'buttons-text_hover_color_mode',
	'std'     => 'color',
	'type'    => 'images',
	'class'   => 'small',
	'divider' => 'top',
	'options' => array(
		'accent' => array(
			'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-accent.gif',
		),
		'color'  => array(
			'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/color-custom.gif',
		),
	),
);

$options['buttons-text_hover_color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'buttons-text_hover_color',
	'std'        => '#ffffff',
	'type'       => 'color',
	'dependency' => array(
		'field'    => 'buttons-text_hover_color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

/**
 * Small, Medium, Big Buttons.
 */

foreach ( presscore_themeoptions_get_buttons_defaults() as $id => $opts ) {

	$options[] = array( 'name' => _x( $opts['desc'], 'theme-options', 'the7mk2' ), 'type' => 'block' );

	$options["buttons-{$id}_font_family"] = array(
		'name'  => _x( 'Font-family', 'theme-options', 'the7mk2' ),
		'id'    => "buttons-{$id}_font_family",
		'std'   => ! empty( $opts['ff'] ) ? $opts['ff'] : 'Open Sans',
		'type'  => 'web_fonts',
		'fonts' => 'all',
	);

	$options["buttons-{$id}_font_size"] = array(
		'name'     => _x( 'Font-size', 'theme-options', 'the7mk2' ),
		'id'       => "buttons-{$id}_font_size",
		'std'      => $opts['fs'],
		'type'     => 'slider',
		'options'  => array( 'min' => 9, 'max' => 120 ),
		'sanitize' => 'font_size',
	);

	$options["buttons-{$id}_uppercase"] = array(
		'name' => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
		'id'   => "buttons-{$id}_uppercase",
		'type' => 'checkbox',
		'std'  => $opts['uc'],
	);

	$padding_std                      = sprintf( '%spx %spx %spx %spx', $opts['padding_top'], $opts['padding_right'], $opts['padding_bottom'], $opts['padding_left'] );
	$options["buttons-{$id}_padding"] = array(
		'id'   => "buttons-{$id}_padding",
		'name' => _x( 'Padding', 'theme-options', 'the7mk2' ),
		'type' => 'spacing',
		'std'  => $padding_std,
	);

	$options["buttons-{$id}_border_radius"] = array(
		'name'  => _x( 'Border radius', 'theme-options', 'the7mk2' ),
		'id'    => "buttons-{$id}_border_radius",
		'std'   => $opts['border_radius'],
		'type'  => 'number',
		'units' => 'px',
	);
}