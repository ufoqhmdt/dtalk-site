<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
//Responsiveness mode:Browser width based data atts

$wp_col_responsiveness = of_get_option( 'woocommerce_shop_template_bwb_columns' );
$columns = array(
	'desktop' => 'desktop',
	'v_tablet' => 'v-tablet',
	'h_tablet' => 'h-tablet',
	'phone' => 'phone',
);

if ( $wp_col_responsiveness ) {
	foreach ( $columns as $column => $data_att ) {
		$val = ( isset( $wp_col_responsiveness[ $column ] ) ? absint( $wp_col_responsiveness[ $column ] ) : '' );
		$data_atts[] = 'data-' . $data_att . '-columns-num="' . esc_attr( $val ) . '"';
	}
}
//Layout list class
$wc_list_html_class = '';
if ( of_get_option( 'woocommerce_hover_image' ) ) {
	$wc_list_html_class = 'wc-img-hover';
}
$hide_desc_class = '';
if ( !of_get_option( 'woocommerce_show_list_desc' ) ) {
	$hide_desc_class = ' hide-description';
}
do_action( 'dt_wc_loop_start' );

do_action( 'presscore_before_loop' );



// fullwidth wrap open
if ( presscore_config()->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }
if ( 'list' === presscore_config()->get( 'layout' )) {
	echo '<div class="wc-layout-list dt-products '. $wc_list_html_class .  $hide_desc_class .'" >';

}else{
// masonry container open

	if ( 'grid' === presscore_config()->get( 'layout' )) {
		$classes = array_diff( presscore_masonry_container_classes_array(), array( 'iso-grid') );
		echo '<div class="dt-css-grid-wrap woo-hover wc-grid dt-products ' . esc_attr( implode( ' ', $classes ) ) . '" ' . presscore_masonry_container_data_atts($data_atts) . '>';
		echo '<div class="dt-css-grid">';
	}else{
		echo '<div ' . presscore_masonry_container_class( array( 'wf-container dt-products ', 'woo-hover' ) ) . presscore_masonry_container_data_atts($data_atts) . '>';
	}
}
