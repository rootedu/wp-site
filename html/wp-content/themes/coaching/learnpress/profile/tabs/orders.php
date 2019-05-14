<?php
/**
 * Template for displaying user's orders
 *
 * @author  ThimPress
 * @package LearnPress/Template
 * @version 1.0
 */
defined( 'ABSPATH' ) || exit();
?>
<?php if ( $orders = $user->get_orders() ): ?>

	<table class="table-orders">
		<thead>
		<th><?php esc_html_e( 'Order', 'coaching' ); ?></th>
		<th><?php esc_html_e( 'Date', 'coaching' ); ?></th>
		<th><?php esc_html_e( 'Status', 'coaching' ); ?></th>
		<th><?php esc_html_e( 'Total', 'coaching' ); ?></th>
		<th><?php esc_html_e( 'Action', 'coaching' ); ?></th>
		</thead>
		<tbody>
		<?php foreach ( $orders as $order ): $order = learn_press_get_order( $order ); ?>
			<tr>
				<td><?php echo esc_html( $order->get_order_number() ); ?></td>
				<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
				<td><?php echo esc_html( $order->get_order_status() ); ?></td>
				<td><?php echo esc_html( $order->get_formatted_order_total() ); ?></td>
				<td>
					<?php
					$actions['view'] = array(
						'url'  => $order->get_view_order_url(),
						'text' => esc_html__( 'View', 'coaching' )
					);
					$actions         = apply_filters( 'learn_press_user_profile_order_actions', $actions, $order );

					foreach ( $actions as $slug => $option ) {
						printf( '<a href="%s">%s</a>', $option['url'], $option['text'] );
					}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php else: ?>
	<?php learn_press_display_message( esc_html__( 'No records.', 'coaching' ), 'notice' ); ?>
<?php endif; ?>
