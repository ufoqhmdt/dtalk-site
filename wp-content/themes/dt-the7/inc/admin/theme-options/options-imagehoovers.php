<?php
/**
 * Image Hovers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Heading definition.
 */
$options[] = array(
	'name' => _x( 'Images Styling &amp; Hovers', 'theme-options', 'the7mk2' ),
	'type' => 'heading',
	'id'   => 'images-styling-hovers',
);

/**
 * Styling.
 */
$options[] = array( 'name' => _x( 'Styling', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['image_hover-style'] = array(
	'name'    => _x( 'Image &amp; hover decoration', 'theme-options', 'the7mk2' ),
	'desc'    => _x( 'May not have effect on some portfolio, photo albums and shortcodes image hovers.', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-style',
	'std'     => 'none',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'none'       => array(
			'title' => _x( 'None', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-none.gif',
		),
		'grayscale'  => array(
			'title' => _x( 'Grayscale', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-grayscale.gif',
		),
		'gray_color' => array(
			'title' => _x( 'Grayscale with color hovers', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-grayscale-with-color-hover.gif',
		),
		'blur'       => array(
			'title' => _x( 'Blur', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-blur.gif',
		),
		'scale'      => array(
			'title' => _x( 'Scale', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-scale.gif',
		),
	),
);

/**
 * Hover color.
 */
$options[] = array( 'name' => _x( 'Default image hovers', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['image_hover-default_icon'] = array(
	'name'    => _x( 'Icon', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-default_icon',
	'std'     => 'none',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'none'         => array(
			'title' => _x( 'No icon', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-style-grayscale.gif',
		),
		'small_corner' => array(
			'title' => _x( 'Small icon in the corner', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-default_icon-small-icon.gif',
		),
		'big_center'   => array(
			'title' => _x( 'Large centered icon', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-default_icon-large-icon.gif',
		),
	),
);

$options['image_hover-color_mode'] = array(
	'name'    => _x( 'Hovers background color', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-color_mode',
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

$options['image_hover-color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'image_hover-color',
	'std'        => '#ffffff',
	'type'       => 'alpha_color',
	'dependency' => array(
		'field'    => 'image_hover-color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

$options['image_hover-color_gradient'] = array(
	'name'       => '&nbsp;',
	'type'       => 'gradient_picker',
	'id'         => 'image_hover-color_gradient',
	'std'        => '135deg|#ffffff 30%|#000000 100%',
	'dependency' => array(
		'field'    => 'image_hover-color_mode',
		'operator' => '==',
		'value'    => 'gradient',
	),
);

$options['image_hover-opacity'] = array(
	'name'       => _x( 'Hovers background opacity', 'theme-options', 'the7mk2' ),
	'id'         => 'image_hover-opacity',
	'std'        => 30,
	'type'       => 'slider',
	'dependency' => array(
		'field'    => 'image_hover-color_mode',
		'operator' => '==',
		'value'    => 'accent',
	),
);

/**
 * Hover opacity.
 */
$options[] = array(
	'name' => _x( 'Portfolio &amp; photo albums hovers', 'theme-options', 'the7mk2' ),
	'type' => 'block',
);

$options['image_hover-project_icons_style'] = array(
	'name'    => _x( 'Icons on hover in portfolio', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-project_icons_style',
	'std'     => 'accent',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'outline'     => array(
			'title' => _x( 'Outline', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-project_icons_style-outline.gif',
		),
		'transparent' => array(
			'title' => _x( 'Semitransparent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-project_icons_style-semitransp.gif',
		),
		'accent'      => array(
			'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-project_icons_style-accent.gif',
		),
		'small'       => array(
			'title' => _x( 'Small', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-project_icons_style-small.gif',
		),
	),
);

$options['image_hover-album_miniatures_style'] = array(
	'name'    => _x( 'Image minuatures on hover in photo albums', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-album_miniatures_style',
	'style'   => 'vertical',
	'std'     => 'style_1',
	'type'    => 'images',
	'class'   => 'small',
	'options' => array(
		'style_1' => array(
			'title' => _x( 'Overlapping miniatures of a different size', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-album_miniatures_style-1.gif',
		),
		'style_2' => array(
			'title' => _x( 'Three miniatures in a row', 'theme-options', 'the7mk2' ),
			'src'   => '/inc/admin/assets/images/image_hover-album_miniatures_style-2.gif',
		),
	),
);

$options['image_hover-project_rollover_color_mode'] = array(
	'name'    => _x( 'Hovers background color', 'theme-options', 'the7mk2' ),
	'id'      => 'image_hover-project_rollover_color_mode',
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

$options['image_hover-project_rollover_color'] = array(
	'name'       => '&nbsp;',
	'id'         => 'image_hover-project_rollover_color',
	'std'        => '#ffffff',
	'type'       => 'alpha_color',
	'dependency' => array(
		'field'    => 'image_hover-project_rollover_color_mode',
		'operator' => '==',
		'value'    => 'color',
	),
);

$options['image_hover-project_rollover_color_gradient'] = array(
	'name'       => '&nbsp;',
	'type'       => 'gradient_picker',
	'id'         => 'image_hover-project_rollover_color_gradient',
	'std'        => '135deg|#ffffff 30%|#000000 100%',
	'dependency' => array(
		'field'    => 'image_hover-project_rollover_color_mode',
		'operator' => '==',
		'value'    => 'gradient',
	),
);

$options['image_hover-project_rollover_opacity'] = array(
	'name'       => _x( 'Hovers background opacity', 'theme-options', 'the7mk2' ),
	'id'         => 'image_hover-project_rollover_opacity',
	'std'        => 70,
	'type'       => 'slider',
	'dependency' => array(
		'field'    => 'image_hover-project_rollover_color_mode',
		'operator' => '==',
		'value'    => 'accent',
	),
);
