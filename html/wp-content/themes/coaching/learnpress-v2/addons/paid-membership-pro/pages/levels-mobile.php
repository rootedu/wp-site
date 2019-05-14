<?php
global $current_user;
$levels       = lp_pmpro_get_all_levels();
$list_courses = lp_pmpro_list_courses( $levels );
?>
<?php do_action( 'learn_press_pmpro_before_levels' ); ?>
<div class="lp-membership-list-mobile">
	<div class="lp-pmpro-membership-list">
		<?php foreach ( $levels as $index => $level ): ?>
			<div class="item_level">
				<div class="header-item list-item<?php echo ' position-' . $index; ?>">
					<h2 class="lp-title"><?php echo esc_html( $level->name ); ?></h2>
					<?php
					if ( !empty( $level->description ) ) {
						echo '<div class="lp-desc">' . $level->description . '</div>';
					}
					?>
					<div class="lp-price">
						<?php if ( pmpro_isLevelFree( $level ) ): ?>
							<?php esc_html_e( 'Free', 'coaching' ); ?>
						<?php else: ?>
							<?php
							$cost_text = pmpro_getLevelCost( $level, true, true );
							echo ent2ncr( $cost_text );
							?>
						<?php endif; ?>
					</div>
				</div>
				<div class="list_courses">
					<?php
					if ( !empty( $list_courses ) ) {
						foreach ( $list_courses as $key => $course_item ) {
							//var_dump($course_item['level']);
							if ( in_array( $level->id, $course_item['level'] ) ) {
								echo '<div class="item-td">';
								echo $course_item['link'];
								echo '</div>';
							}
						}
					}
					?>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>
<?php do_action( 'learn_press_pmpro_after_levels' ); ?>

