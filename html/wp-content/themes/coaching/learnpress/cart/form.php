<?php
/**
 * Template for displaying checkout form
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

learn_press_print_notices();

do_action( 'learn_press_before_cart' );

$checkout_url = apply_filters( 'learn_press_get_checkout_url', LP()->cart->get_checkout_url() );

?>

	<form method="post" name="lp-cart" class="lp-cart" action="<?php echo esc_url( $checkout_url ); ?>" enctype="multipart/form-data">

		<?php do_action( 'learn_press_before_cart_table' ); ?>

		<table class="learn-press-cart-table">
			<thead>
			<tr>
				<th class="course-remove"></th>
				<th class="course-thumbnail"></th>
				<th class="course-name"><?php esc_html_e( 'Course', 'coaching' ); ?></th>
				<th class="course-price"><?php esc_html_e( 'Price', 'coaching' ); ?></th>
				<th class="course-quantity"><?php esc_html_e( 'Quantity', 'coaching' ); ?></th>
				<th class="course-total"><?php esc_html_e( 'Total', 'coaching' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php do_action( 'learn_press_before_cart_contents' ); ?>

			<?php
			foreach ( LP()->cart->get_items() as $cart_item ) {
				$_course_id = apply_filters( 'learn_press_cart_item_course_id', $cart_item['item_id'], $cart_item );
				$_course    = apply_filters( 'learn_press_cart_item_course', LP_Course::get_course( $_course_id ), $cart_item );

				if ( $_course && $_course->exists() && $cart_item['quantity'] > 0 && apply_filters( 'learn_press_cart_item_visible', true, $cart_item ) ) {
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'learn_press_cart_item_class', 'cart_item', $cart_item ) ); ?>">

						<td class="course-remove">
							<?php
							echo apply_filters( 'learn_press_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-course_id="%s">&times;</a>',
								esc_url( add_query_arg( 'remove-cart-item', $_course_id ) ),
								esc_html__( 'Remove this course', 'coaching' ),
								esc_attr( $_course_id )
							), $cart_item );
							?>
						</td>

						<td class="course-thumbnail">
							<?php
							$thumbnail = apply_filters( 'learn_press_cart_item_thumbnail', $_course->get_image(), $cart_item );

							if ( !$_course->is_visible() ) {
								echo ent2ncr( $thumbnail );
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $_course->get_permalink( $cart_item ) ), $thumbnail );
							}
							?>
						</td>

						<td class="course-name">
							<?php
							if ( !$_course->is_visible() ) {
								echo apply_filters( 'learn_press_cart_item_name', $_course->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'learn_press_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_course->get_permalink( $cart_item ) ), $_course->get_title() ), $cart_item );
							}
							?>&nbsp;

						</td>

						<td class="course-price">
							<?php
							echo learn_press_format_price( apply_filters( 'learn_press_cart_item_price', $_course->price, $cart_item ), true );
							?>
						</td>

						<td class="course-quantity">
							<?php echo apply_filters( 'learn_press_cart_item_quantity', $cart_item['quantity'], $cart_item ); ?>
						</td>

						<td class="course-total">
							<?php
							echo learn_press_format_price( apply_filters( 'learn_press_cart_item_subtotal', $cart_item['subtotal'], $cart_item ), true );
							?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'learn_press_cart_contents' );
			?>

			<?php do_action( 'learn_press_after_cart_contents' ); ?>
			</tbody>
		</table>
		<div class="cart_totals">
			<h2><?php esc_html_e( 'Cart Totals', 'coaching' ); ?></h2>
			<table>
				<tbody>
				<tr>
					<th class="subtotal"><?php esc_html_e( 'Subtotal', 'coaching' ); ?></th>
					<td class="subtotal-price"><?php echo esc_html( $cart->get_subtotal() ); ?></td>
				</tr>
				<tr>
					<th class="total"><?php esc_html_e( 'Total', 'coaching' ); ?></th>
					<td class="total-price"><?php echo esc_html( $cart->get_total() ); ?></td>
				</tr>
				</tbody>
			</table>
			<button class="checkout-button"><?php esc_html_e( 'Checkout', 'coaching' ); ?></button>
		</div>

		<?php do_action( 'learn_press_after_cart_table' ); ?>
	</form>

<?php do_action( 'learn_press_after_cart' ); ?>