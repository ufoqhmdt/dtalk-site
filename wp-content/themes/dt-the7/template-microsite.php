<?php
/**
 * Template Name: Microsite
 * Template Post Type: post, page, dt_portfolio
 *
 * @package The7
 * @since   3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

presscore_config()->set( 'template', 'microsite' );
get_header(); ?>

<?php
if ( presscore_is_content_visible() ) {
	presscore_get_template_part( 'theme', 'microsite/microsite', get_post_type() );
}
?>

<?php get_footer(); ?>