<?php
/**
 * Output register form
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

$heading    = apply_filters( 'learn_press_checkout_register_heading', esc_html__( 'NEW CUSTOMER', 'coaching' ) );
$subheading = apply_filters( 'learn_press_checkout_register_subheading', esc_html__( 'Register Account', 'coaching' ) );

$register_url         = learn_press_get_register_url();
$register_button_text = apply_filters( 'learn_press_checkout_register_button_text', esc_html__( 'Continue', 'coaching' ) );

$content = sprintf( wp_kses( __( 'By creating an account you will be able to shop faster, be up to date on an order status, and keep track of the orders you have previously made.<br/><a href="%1$s">%2$s</a>', 'coaching' ), array( 'a' => array( 'href' => array() ), 'br' => array() ) ), esc_url( $register_url ), $register_button_text );
$content = apply_filters( 'learn_press_checkout_register_content', $content );

?>

<div id="learn-press-checkout-user-register" class="learn-press-user-form">

	<?php do_action( 'learn_press_checkout_before_user_register_form' ); ?>

	<?php if ( $heading ) { ?>
		<h3 class="form-heading"><?php echo esc_html( $heading ); ?></h3>
	<?php } ?>

	<?php if ( $subheading ) { ?>
		<p class="form-subheading"><?php echo esc_html( $subheading ); ?></p>
	<?php } ?>

	<?php if ( $content ) { ?>
		<div class="form-content">
			<?php echo ent2ncr( $content ); ?>
		</div>
	<?php } ?>

	<?php do_action( 'learn_press_checkout_after_user_register_form' ); ?>

</div>