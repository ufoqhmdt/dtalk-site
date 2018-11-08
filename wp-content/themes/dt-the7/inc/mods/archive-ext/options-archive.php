<?php
/**
 * Archives settings.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$supported_shortcodes = array(
	'Blog Masonry & Grid',
	'Blog List',
	'Portfolio Masonry & Grid',
	'Portfolio Justified Grid',
	'Team Masonry & Grid',
	'Testimonials Masonry & Grid',
	'Albums Masonry & Grid',
	'Albums Justified Grid',
);
$options[] = array(
	'desc' => sprintf( _x( "Settings bellow allows you to select pages to be used as templates for your Archives and Search results. This includes header, footer, sidebar and <strong>content layout</strong> (beta feature).\nNote that Archives content and Search results appearance will be rendered in accordance with <strong>first</strong> <span class='of-tooltip'><strong>corresponding shortcode</strong><i class='tooltiptext'><b>Supported shortcodes:</b><br />%s</i></span> found on the page. Otherwise it will default to a masonry layout. Categorisation is always disabled and pagination defaults to a 'standard' mode.", 'theme-options', 'the7mk2' ), implode( '<br />', $supported_shortcodes ) ),
	'type' => 'info',
);

$options[] = array( 'name' => _x( 'Archives', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'archives' );

	$options[] = array( 'name' => _x( 'Author', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['template_page_id_author'] = array(
			'id'		=> 'template_page_id_author',
			'name'		=> _x( 'Author archive template', 'theme-options', 'the7mk2' ),
			'type'		=> 'pages_list',
		);

	$options[] = array( 'name' => _x( 'Date', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['template_page_id_date'] = array(
			'id'		=> 'template_page_id_date',
			'name'		=> _x( 'Date archive template', 'theme-options', 'the7mk2' ),
			'type'		=> 'pages_list',
		);

	$options[] = array( 'name' => _x( 'Blog archives', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['template_page_id_blog_category'] = array(
			'id'		=> 'template_page_id_blog_category',
			'name'		=> _x( 'Blog category template', 'theme-options', 'the7mk2' ),
			'type'		=> 'pages_list',
		);

		$options['template_page_id_blog_tags'] = array(
			'id'		=> 'template_page_id_blog_tags',
			'name'		=> _x( 'Blog tags template', 'theme-options', 'the7mk2' ),
			'type'		=> 'pages_list',
		);

	$options['archive_placeholder'] = array();

$options[] = array( 'name' => _x( 'Search', 'theme-options', 'the7mk2' ), 'type' => 'heading', 'id' => 'search' );

	$options[] = array( 'name' => _x( 'Search', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['template_page_id_search'] = array(
			'id'		=> 'template_page_id_search',
			'name'		=> _x( 'Search page', 'theme-options', 'the7mk2' ),
			'type'		=> 'pages_list',
		);
