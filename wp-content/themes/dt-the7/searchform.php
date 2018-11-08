<?php
/**
 * The template for displaying search forms in PressCore
 *
 * @package The7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<form class="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
		<label for="search" class="screen-reader-text"><?php esc_html_e( 'Search:', 'the7mk2' ) ?></label>
		<input type="text" class="field searchform-s" name="s" value="<?php echo esc_attr( get_search_query() ) ?>" placeholder="<?php _e( 'Type and hit enter &hellip;', 'the7mk2' ) ?>" />
		<input type="submit" class="assistive-text searchsubmit" value="<?php esc_attr_e( 'Go!', 'the7mk2' ) ?>" />
		<a href="#go" class="submit"></a>
	</form>