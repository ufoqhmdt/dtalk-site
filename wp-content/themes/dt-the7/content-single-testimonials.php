<?php
/**
 * Testimonials single post template.
 * 
 * @package The7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID() ?>" <?php post_class() ?>>

	<?php
	do_action( 'presscore_before_post_content' );

	the_content();

	do_action( 'presscore_after_post_content' );
	?>

</article>