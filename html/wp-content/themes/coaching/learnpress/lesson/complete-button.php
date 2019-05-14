<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */


if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$course = LP()->course;
if ( !$course ) {
	return;
}
if ( !( $lesson = $course->current_lesson ) ) {
	return;
}

if ( LP()->user->has( 'finished-course', $course->id ) ) {
	return;
}

$nonce = wp_create_nonce(
		sprintf(
				'learn-press-complete-%s-%d-%d-%d',
				$lesson->post->post_type,
				$lesson->id,
				$course->id,
				get_current_user_id()
		)
);
?>

<?php if ( LP()->user->has( 'completed-lesson', $lesson->id ) ) { ?>

	<?php
	echo apply_filters(
			'learn_press_user_completed_lesson_button',
			sprintf(
					'<button class="complete-lesson-button completed" data-id="%s" disabled="disabled">%s</button>',
					esc_attr( $lesson->id ),
					esc_html__( 'Completed', 'coaching' )
			)
	);
	?>

<?php } else { ?>

	<?php if ( !LP()->user->has( 'finished-course', $course->id ) && LP()->user->has( 'enrolled-course', $course->id ) ) { ?>
		<?php
		echo apply_filters(
				'learn_press_user_completed_lesson_button',
				sprintf(
						'<button class="complete-lesson-button" data-id="%d" data-course_id="%d" data-nonce="%s" data-completed-text="'.esc_attr('Completed','coaching').'">%s</button>',
						$lesson->id,
						$course->id,
						$nonce,
						esc_html__( 'Complete Lesson', 'coaching' )
				)
		);
		?>
	<?php } ?>

<?php } ?>
