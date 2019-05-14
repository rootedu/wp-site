<?php
/**
 * Displaying the description of single course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->course;

?>

<div class="course-description" id="learn-press-course-description">

	<?php do_action( 'learn_press_begin_single_course_description' ); ?>

	<?php the_content(); ?>

	<?php do_action( 'learn_press_end_single_course_description' ); ?>

</div>