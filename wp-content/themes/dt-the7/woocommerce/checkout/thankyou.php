<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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

if ( $order ) : ?>
	<div class="wc-complete-wrap">
		<?php if ( $order->has_status( 'failed' ) ) : ?>
			<div class="wc-side-column">
				<h4 class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'the7mk2' ); ?></h4>

				<p class="woocommerce-thankyou-order-failed-actions">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'the7mk2' ) ?></a>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'the7mk2' ); ?></a>
					<?php endif; ?>
				</p>
			</div>

		<?php else : ?>
			<div class="wc-side-column">
				<h4 class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you! Your order has been received.', 'the7mk2' ), $order ); ?></h4>

				<ul class="woocommerce-thankyou-order-details order_details">
					<li class="order">
						<?php _e( 'Order Number', 'the7mk2' ); ?>
						<strong><?php echo $order->get_order_number(); ?></strong>
					</li>
					<li class="date">
						<?php _e( 'Date', 'the7mk2' ); ?>
						<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
					</li>
					<li class="total">
						<?php _e( 'Total', 'the7mk2' ); ?>
						<strong><?php echo $order->get_formatted_order_total(); ?></strong>
					</li>
					<?php if ( $order->payment_method_title ) : ?>
					<li class="method">
						<?php _e( 'Payment Method', 'the7mk2' ); ?>
						<strong><?php echo $order->payment_method_title; ?></strong>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="clear"></div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->id ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
	</div>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'the7mk2' ), null ); ?></p>

<?php endif; ?>
