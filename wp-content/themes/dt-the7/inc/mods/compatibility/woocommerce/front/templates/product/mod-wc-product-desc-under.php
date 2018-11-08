<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// get rollover icons
global $product;
$rollover_icons = dt_woocommerce_get_product_preview_icons();
if ( $rollover_icons ) {
	$rollover_icons = '<div class="woo-buttons">' . $rollover_icons . '</div>';
}
?>
<figure class="woocom-project">
	<div class="woo-buttons-on-img">

		<?php presscore_wc_template_loop_product_thumbnail( 'alignnone' ); ?>
		<?php 
			echo $rollover_icons;
			if ( !$product->is_in_stock() ) {
				echo '<span class="out-stock-label">'.__('Out Of Stock','the7mk2').'</span>';
			}
		?>


	</div>
	<figcaption class="woocom-list-content">

		<?php echo dt_woocommerce_get_product_description(); ?>

	</figcaption>
</figure>