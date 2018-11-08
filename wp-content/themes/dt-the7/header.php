<?php
/**
 * Header template.
 *
 * @package The7
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'header-single' );
get_template_part( 'header-main' );

// Little trick!
// wp_head()