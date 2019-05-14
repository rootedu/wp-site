<?php
/**
 * Checkout Payment Section
 *
 * @author        ThimPress
 * @package       LearnPress/Templates
 * @version       2.0.4
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$order_button_text            = apply_filters( 'learn_press_order_button_text', __( 'Place order', 'coaching' ) );
$order_button_text_processing = apply_filters( 'learn_press_order_button_text_processing', __( 'Processing', 'coaching' ) );
$show_button                  = true;
$count_gateways               = !empty( $available_gateways ) ? sizeof( $available_gateways ) : 0;
?>

<div id="learn-press-payment" class="learn-press-checkout-payment">
	<?php if ( LP()->get_checkout_cart()->needs_payment() ): ?>

		<?php if ( !$count_gateways ): $show_button = false; ?>

			<?php if ( $message = apply_filters( 'learn_press_no_available_payment_methods_message', __( 'No payment methods is available.', 'coaching' ) ) ) { ?>
				<?php learn_press_display_message( $message, 'error' ); ?>
			<?php } ?>

		<?php else: ?>
			<h3 class="title"><?php esc_html_e( 'Payment Method', 'coaching' ); ?></h3>
			<ul class="payment-methods">

				<?php do_action( 'learn_press_before_payments' ); ?>

				<?php foreach ( $available_gateways as $gateway ) { ?>

					<?php learn_press_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway, 'selected' => $count_gateways ) ); ?>

				<?php } ?>

				<?php do_action( 'learn_press_after_payments' ); ?>

			</ul>

		<?php endif; ?>

	<?php endif; ?>
	<?php if ( $show_button ): ?>

		<div class="place-order-action">

			<?php do_action( 'learn_press_order_before_submit' ); ?>

			<?php echo apply_filters( 'learn_press_order_button_html', '<input type="submit" class="button alt" name="learn_press_checkout_place_order" id="learn-press-checkout" data-processing-text="' . esc_attr( $order_button_text_processing ) . '" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

			<?php do_action( 'learn_press_order_after_submit' ); ?>

		</div>

	<?php endif; ?>

</div>

<div class="learn-press"></div>
<div class="adsad learn-press-asdasd"></div>