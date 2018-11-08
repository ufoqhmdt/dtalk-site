<?php
/* Template Name: Blog - masonry & grid */

/**
 * Blog masonry template.
 *
 * @package The7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$config = presscore_config();
$config->set( 'template', 'blog' );
$config->set( 'template.layout.type', 'masonry' );

// add content controller
add_action( 'presscore_before_main_container', 'presscore_page_content_controller', 15 );

get_header();

if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop

					do_action( 'presscore_before_loop' );

					if ( post_password_required() ) {
						the_content();
					} else {
						// backup config
						$config_backup = $config->get();

						presscore_display_posts_filter( array(
							'post_type' => 'post',
							'taxonomy' => 'category'
						) );

						// fullwidth wrap open
						if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

						$container_class = array( 'wf-container' );
						if ( $config->get( 'post.fancy_date.enabled' ) ) {
							$container_class[] = presscore_blog_fancy_date_class();
						}

						// masonry container open
						echo '<div ' . presscore_masonry_container_class( $container_class ) . presscore_masonry_container_data_atts() . '>';

							$page_query = presscore_get_blog_query();

							if ( $page_query->have_posts() ): while( $page_query->have_posts() ): $page_query->the_post();

								// populate config with current post settings
								presscore_populate_post_config();

								presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post' );

							endwhile; wp_reset_postdata(); endif;

						// masonry container close
						echo '</div>';

						// fullwidth wrap close
						if ( $config->get( 'full_width' ) ) { echo '</div>'; }

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );
					}

					do_action( 'presscore_after_loop' );

					presscore_display_share_buttons_for_post( 'page' );

				endwhile; endif; ?>

			</div><!-- #content -->

		<?php
		do_action('presscore_after_content');

endif; // if content visible

get_footer(); ?>