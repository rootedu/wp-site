<?php
/**
 * Template for displaying the list of course is in wishlist
 *
 * @author ThimPress
 */

defined( 'ABSPATH' ) || exit();

global $post;

$has_courses = $wishlist ? true : false;
$class = $has_courses ? 'has-courses' : ''
?>
	<div id="learn-press-profile-tab-course-wishlist" class="<?php echo esc_attr( $class ); ?>">

		<?php if ( $has_courses ) : ?>

			<h3 class="box-title"><?php esc_html_e( 'Favorite Courses', 'coaching' ); ?></h3>

			<div class="thim-carousel-wrapper thim-course-carousel thim-course-grid" data-visible="3" data-pagination="0" data-navigation="1">

				<?php foreach ( $wishlist as $post ) { ?>

					<?php learn_press_course_wishlist_template( 'wishlist-content.php' ); ?>

				<?php } ?>
			</div>

		<?php else: ?>

			<?php learn_press_display_message( apply_filters( 'learn_press_wishlist_empty_course', esc_html__( 'No records.', 'coaching' ) ), 'notice' ); ?>

		<?php endif; ?>

	</div>

<?php
wp_reset_postdata();