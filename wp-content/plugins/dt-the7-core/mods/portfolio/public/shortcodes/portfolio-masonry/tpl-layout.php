<?php
/**
 * Masonry blog layout template.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$rollover_class = "";
if ( 1 == presscore_project_preview_buttons_count() ) {
		$rollover_class .= ' rollover-active';
}
$config = presscore_config();
$target = '';
if($config->get( 'follow_external_link' )){
	$target = $config->get( 'post.buttons.link.target_blank' );
}
?>

<?php if ( presscore_post_format_supports_media_content( get_post_format() ) && ! empty( $post_media ) ) : ?>

<div class="post-thumbnail-wrap <?php echo $rollover_class; ?> ">
	<div class="post-thumbnail">

		<?php
		$rollover_icons = '';

		if ( $config->get( 'show_links' ) ) {
			$project_link = presscore_get_project_link( 'project-link '. $external_link_icon .'' );
			if ( $project_link ) {
				$rollover_icons = $project_link;
			}
		}
		$rollover_icons .= presscore_get_project_rollover_zoom_icon( array( 'popup' => 'single', 'class' => $image_zoom_icon, 'attachment_id' => get_post_thumbnail_id()) );
		if ( $config->get( 'show_details' ) ) {
			$rollover_icons .= '<a href=" '. $follow_link .'" target="'. $target . '" class="project-details '. $project_link_icon .'"></a>';
		}
		if ( $rollover_icons ) {
			$rollover_icons = '<div class="project-links-container">' . $rollover_icons . '</div>';
		};

		 echo $post_media . $rollover_icons;
		?>

	</div>
</div>

<?php endif; ?>

<div class="post-entry-content">

	<h3 class="entry-title">
		<a href="<?php echo $follow_link; ?>" target="<?php echo $target;?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
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