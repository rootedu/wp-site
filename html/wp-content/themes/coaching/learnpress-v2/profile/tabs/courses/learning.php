<?php
/**
 * User Courses enrolled
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<h3 class="box-title"><?php echo esc_html__( 'Enrolled Courses', 'coaching' ); ?></h3>

<?php if ( $courses ) : ?>

	<div class="thim-carousel-wrapper thim-course-carousel thim-course-grid" data-visible="3" data-pagination="0" data-navigation="1">

		<?php foreach( $courses as $post ){ setup_postdata( $post );?>
			<?php setup_postdata($post);?>
			<?php learn_press_get_template( 'profile/tabs/courses/loop.php', array( 'subtab' => 'learning', 'user' => $user, 'course_id' => $post->ID ) ); ?>

		<?php } ?>
	</div>

<?php else: ?>

	<?php learn_press_display_message( esc_html__( 'No enrolled courses.', 'coaching' ), 'notice' ); ?>

<?php endif ?>

<?php wp_reset_postdata(); // do not forget to call this function here! ?>