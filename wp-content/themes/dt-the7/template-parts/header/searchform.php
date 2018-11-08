<?php
/**
 * Search form view.
 *
 * @package the7
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$show_icon = presscore_config()->get( 'header.elements.search.icon.enabled' );

$class = $show_icon != 'disabled' ? '' : ' mini-icon-off';

$caption = presscore_config()->get( 'header.elements.search.caption' );
$input_caption = presscore_config()->get( 'header.elements.search.input.caption' );

if ( ! $caption && $show_icon!= 'disabled' ) {
	$class .= ' text-disable';
}
if ( $show_icon == 'default' ) {
	$class .= ' default-icon';
}
$class_icon = '';
if ( presscore_config()->get( 'header.elements.search.icon' ) == 'disabled' ) {
	$class_icon = ' search-icon-disabled';
}

if ( ! $caption ) {
	$caption = '&nbsp;';
}
if ( ! $input_caption ) {
	$input_caption = '&nbsp;';
}
$custom_icon = '';
if(presscore_config()->get( 'header.elements.search.icon' ) == 'custom'){
	$custom_icon = '<i class=" ' . presscore_config()->get( "header.elements.search.custom.icon" ) . '"></i>';
}
$custom_search_icon = '';
if($show_icon == 'custom'){
	$custom_search_icon = '<i class=" ' . presscore_config()->get( "header.elements.search.icon.custom" ) . '"></i>';
}
?>
<form class="searchform<?php echo $class_icon; ?>" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label for="search" class="screen-reader-text"><?php esc_html_e('Search:', 'the7mk2'); ?></label>
	<?php if(presscore_config()->get( 'header.elements.search.style' ) == 'classic' || presscore_config()->get( 'header.elements.search.style' ) == 'animate_width'):?>

		<input type="text" class="field searchform-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_html($input_caption); ?>" />

		<a href="#go" class="search-icon"><?php echo $custom_icon; ?></a>

	<?php elseif(presscore_config()->get( 'header.elements.search.style' ) == 'popup'):?>
		<a href="#go" class="submit<?php echo $class; ?>"><?php echo $custom_search_icon  . '<span>' .  esc_html($caption) . '</span>'; ?></a>
		<div class="popup-search-wrap">
			<input type="text" class="field searchform-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_html($input_caption); ?>" />

			<a href="#go" class="search-icon"><?php echo $custom_icon; ?></a>
		</div>
	<?php else:?>
		<div class='overlay-search-wrap'>
			<input type="text" class="field searchform-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_html($input_caption); ?>" />

			<a href="#go" class="search-icon"><?php echo $custom_icon; ?></a>
		</div>
		

		<a href="#go" class="submit<?php echo $class; ?>"><?php echo $custom_search_icon . '<span>' . esc_html($caption) . '</span>'; ?></a>

	<?php
		endif;do_action( 'presscore_header_searchform_fields' ); ?>
		<input type="submit" class="assistive-text searchsubmit" value="<?php esc_attr_e( 'Go!', 'the7mk2' ); ?>" />
</form>

