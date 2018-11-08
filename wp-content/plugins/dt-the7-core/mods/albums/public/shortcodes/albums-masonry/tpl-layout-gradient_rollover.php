<?php
/**
 * Masonry blog layout template.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$rollover_class = "";
// if ( 1 == presscore_project_preview_buttons_count() ) {
// 		$rollover_class .= ' rollover-active';
// }

$config = presscore_config();
$mini_images = presscore_mod_albums_get_mini_images();
$image_class = 'post-thumbnail-rollover';
if ( ! $mini_images ) {
	$image_class .= ' rollover-zoom';
}
$rollover_icons = '';

$image = presscore_mod_albums_get_preview_gallery( $image_class );
?>

<?php if ( presscore_post_format_supports_media_content( get_post_format() ) ) : ?>

<div class="post-thumbnail-wrap <?php echo $rollover_class; ?>">
	<figure class="post-thumbnail<?php echo ( has_post_thumbnail() ? '' : ' overlay-placeholder' ); ?>">

		<?php echo ( isset( $image ) ? $image : '' ); ?>
	</figure>
</div>

<?php endif; ?>

<div class="post-entry-content">
	<div class="post-entry-wrapper">
		<?php
		$rollover_icons = '';

		if ( $config->get( 'post.preview.mini_images.enabled' ) == 'image_miniatures' ) {
			if ( $mini_images ) {
				$rollover_icons = '<span class="album-rollover">'.$mini_images.'</span>';
			}
		}
		else if($config->get( 'post.preview.mini_images.enabled' ) == 'icon'){
			
			$rollover_icons = '<span class="album-rollover"><span class="album-zoom-ico ' . esc_attr( $config->get( 'post.preview.icon' ) ) . '"><span></span></span></span>';
		}

		echo $rollover_icons;

		 ?>
		 <?php 
			$title_class = '';
			if ( 'lightbox' == $config->get( 'post.open_as' ) ) {
				$title_class = 'dt-trigger-first-pswp';
			}
		?>

		<h3 class="entry-title">
			<a href="<?php echo get_permalink(); ?>"  class="<?php echo $title_class; ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>

		<?php echo presscore_get_posted_on(); ?>

		<?php
		if ( $config->get( 'show_excerpts' ) && isset( $post_excerpt ) ) {
			echo '<div class="entry-excerpt">';
			echo $post_excerpt;
			echo '</div>';
		}
		?>

		<?php
		if ( $config->get( 'show_read_more' ) && isset( $details_btn ) ) {
			echo $details_btn;
		}
		?>

	</div>
</div>