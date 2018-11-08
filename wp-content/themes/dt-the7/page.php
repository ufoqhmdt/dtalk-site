<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package The7
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$config = presscore_config();
$config->set( 'template', 'page' );

get_header();
?>

<?php if ( presscore_is_content_visible() ): ?>

    <div id="content" class="content" role="main">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				do_action( 'presscore_before_loop' );
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'the7mk2' ),
					'after'  => '</div>',
				) );
				presscore_display_share_buttons_for_post( 'page' );
				comments_template( '', true );
			}
		} else {
			get_template_part( 'no-results', 'page' );
		}
		?>

    </div><!-- #content -->

	<?php do_action( 'presscore_after_content' ) ?>

<?php endif // if content visible ?>

<?php get_footer() ?>