<?php
/**
 * Testimonials content template.
 *
 * @package The7
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'presscore_before_post' ) ?>

    <div class="testimonial-item">
		<?php presscore_get_template_part( 'mod_testimonials', 'testimonials-post' ) ?>
    </div>

<?php do_action( 'presscore_after_post' ) ?>