<?php
/**
 * The template for display the content of single course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
$theme_options_data = get_theme_mods();
$course = LP()->global['course'];
$user   = learn_press_get_current_user();

$is_enrolled      = $user->has( 'enrolled-course', $course->id );
$require_enrolled = $course->is_require_enrollment();


?>

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php do_action( 'learn_press_before_single_course' ); ?>

<?php
the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' );
?>

<div class="course-meta">
	<?php learn_press_course_instructor(); ?>
	<?php learn_press_course_categories(); ?>
	<?php thim_course_forum_link(); ?>
	<?php thim_course_ratings(); ?>
	<?php learn_press_course_progress(); ?>
</div>

<?php
if ( !$is_enrolled  ) {
	?>
	<div class="course-payment">
		<?php
		learn_press_course_price();
		learn_press_course_buttons();
		?>
	</div>
	<?php
}

?>



<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>

<div class="course-summary">
	<?php //do_action( 'learn_press_before_single_course_summary' ); ?>

	<?php if ( $is_enrolled || $user->has_course_status( $course->id, array( 'enrolled', 'finished-course' ) ) || !$require_enrolled ) { ?>

		<?php learn_press_get_template( 'single-course/content-learning.php' ); ?>

	<?php } else { ?>

		<?php learn_press_get_template( 'single-course/content-landing.php' ); ?>

	<?php } ?>

	<?php //do_action( 'learn_press_after_single_course_summary' ); ?>
</div>

<?php
if ( isset( $theme_options_data['thim_learnpress_single_hide_related'] ) && $theme_options_data['thim_learnpress_single_hide_related'] == '0' ) {
	thim_related_courses();
}
?>

<?php do_action( 'learn_press_after_single_course' ); ?>

<?php do_action( 'learn_press_after_main_content' ); ?>
