<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $vc_manager;

$use_the7_rows = ( ! $vc_manager || ! isset( $atts['type'] ) || $atts['type'] !== 'vc_default' );

if ( The7_Admin_Dashboard_Settings::get( 'rows' ) && $use_the7_rows ) {
	include 'dt_vc_row.php';
} else {
	include trailingslashit( $vc_manager->getDefaultShortcodesTemplatesDir() ) . 'vc_row.php';
}
