<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<h2><?php esc_html_e( 'Related products', 'the7mk2' ); ?></h2>

		<ul class="related-product">

			<?php foreach ( $related_products as $related_product ) : ?>
				<li>

					<?php
					 	$post_object = get_post( $related_product->get_id() );
					 	$product = wc_get_product( $related_product->get_id() );
					 	if ( $product->is_on_sale() ) {
					?>
					<span class="onsale"><i class="fa fa-percent" aria-hidden="true"></i></span>
					<?php
						}
					?>
					<a class="product-thumbnail" href="<?php echo esc_url( $product->get_permalink() ); ?>">
						<?php echo $product->get_image(); ?>
					</a>
					<div class="product-content">
						<a class="product-title" href="<?php echo esc_url( $product->get_permalink() ); ?>">
							<?php echo $product->get_name(); ?>
						</a>
						
						<span class="price"><?php echo $product->get_price_html(); ?></span>

						<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
					</div>

				</li>

			<?php endforeach; ?>

		</ul>

	</section>

<?php endif;

wp_reset_postdata();
