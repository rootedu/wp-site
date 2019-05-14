<?php
/**
 * @author        ThimPress
 * @package       LearnPress/Templates
 * @version       1.0
 */

defined( 'ABSPATH' ) || exit();
?>
<?php if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'coaching' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				esc_html_e( 'Please attempt your purchase again or go to your account page.', 'coaching' );
			else
				esc_html_e( 'Please attempt your purchase again.', 'coaching' );
			?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'coaching' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( get__permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'coaching' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p><?php echo apply_filters( 'learn_press_confirm_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'coaching' ), $order ); ?></p>

		<ul class="order_details">
			<li class="order">
				<?php esc_html_e( 'Order Number:', 'coaching' ); ?>
				<strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
			</li>
			<li class="date">
				<?php esc_html_e( 'Date:', 'coaching' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php esc_html_e( 'Total:', 'coaching' ); ?>
				<strong><?php echo esc_html( $order->get_formatted_order_total() ); ?></strong>
			</li>
			<?php if ( $payment_method_title = $order->get_payment_method_title() ) : ?>
				<li class="method">
					<?php esc_html_e( 'Payment Method:', 'coaching' ); ?>
					<strong><?php echo esc_html( $payment_method_title ); ?></strong>
				</li>
			<?php endif; ?>
			<li class="status">
				<?php esc_html_e( 'Status:', 'coaching' ); ?>
				<strong><?php echo esc_html( $order->get_status() ); ?></strong>
			</li>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'learn_press_confirm_order' . $order->transaction_method, $order->id ); ?>
	<?php do_action( 'learn_press_confirm_order', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'learn_press_confirm_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'coaching' ), null ); ?></p>

<?php endif; ?>