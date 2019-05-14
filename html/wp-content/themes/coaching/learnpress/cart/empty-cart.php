<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

learn_press_add_notice( esc_html__( 'Your cart is currently empty.', 'coaching' ), 'error' );

learn_press_print_notices();
?>
<a href="<?php echo learn_press_get_page_link( 'courses' ); ?>"><?php esc_html_e( 'Back to class', 'coaching' ); ?></a>