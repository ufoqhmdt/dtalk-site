<?php
/**
 * Portfolio single page template.
 *
 * @package The7
 * @since  1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	<article id="post-<?php the_ID() ?>" <?php post_class( 'project-post' ) ?>>

		<?php
		do_action( 'presscore_before_post_content' );

		presscore_get_template_part( 'mod_portfolio', 'portfolio-post-single-content' );

		do_action( 'presscore_after_post_content' );
		?>

	</article>

<?php presscore_display_related_projects() ?>