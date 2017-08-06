<?php
/**
 * Portfolio archive options.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options[] = array( 'name' => _x( 'Portfolio archives', 'theme-options', 'dt-the7-core' ), 'type' => 'block' );

	$new_options['template_page_id_portfolio_category'] = array(
		'id'		=> 'template_page_id_portfolio_category',
		'name'		=> _x( 'Choose a page to take settings from', 'theme-options', 'dt-the7-core' ),
		'desc'		=> _x( 'Page header, sidebar and footer settings would be applied to taxonomy and post type archive pages.', 'theme-options', 'dt-the7-core' ),
		'type'		=> 'pages_list',
	);

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'archive_placeholder' );
}

// cleanup
unset( $new_options );
