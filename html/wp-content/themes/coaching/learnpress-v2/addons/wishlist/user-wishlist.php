<?php
/**
 * Template for displaying the list of course is in wishlist
 *
 * @author ThimPress
 */

defined( 'ABSPATH' ) || exit();

global $post;

$has_courses = $wishlist ? true : false;
?>
<div id="learn-press-profile-tab-course-wishlist" class="<?php echo $has_courses ? 'has-courses' : '';?>">

<?php if ( $has_courses ) : ?>

	<h3 class="box-title"><?php esc_html_e( 'Favorite Courses', 'coaching' ); ?></h3>

	<div class="thim-course-grid">

		<div class="row">

			<?php foreach( $wishlist as $post ) { ?>

			<div class="col-md-4 col-sm-6 col-xs-12">

					<?php learn_press_course_wishlist_template( 'wishlist-content.php' ); ?>

			</div>

			<?php } ?>

		</div>


	</div>

<?php else: ?>

	<?php learn_press_display_message( apply_filters( 'learn_press_wishlist_empty_course', esc_html__( 'No records.', 'coaching' ) ), 'notice' ); ?>

<?php endif; ?>

</div>

<?php
wp_reset_postdata();