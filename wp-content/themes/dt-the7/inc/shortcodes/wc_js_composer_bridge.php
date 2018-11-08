<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! dt_is_woocommerce_enabled() ) {
	return;
}

vc_lean_map( 'dt_products_carousel', null, dirname( __FILE__ ) . '/vc-bridges/the7-products-carousel-bridge.php' );
vc_lean_map( 'dt_products_masonry', null, dirname( __FILE__ ) . '/vc-bridges/the7-products-masonry-bridge.php' );