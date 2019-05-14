<?php
/**
 * Template for displaying the content of current question
 *
 * @author  ThimPress
 * @package LearnPress
 * @version 2.0.7
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$user   = learn_press_get_current_user();
$course = LP()->global['course'];
$quiz   = LP()->global['course-item'];
if ( !$user->has( 'completed-quiz', $quiz->id ) ) {
	return;
}

if ( !is_user_logged_in() ) {
	learn_press_display_message( sprintf( __( 'You are not logged in! Please <a href="%s">login</a> to save the results. The results will be deleted after your session destroyed', 'coaching' ), learn_press_get_login_url() ), 'error' );
}

$history = $user->get_quiz_results( $quiz->id );
?>
<div class="lp-group-content-wrap quiz-results">
	<h3 class="result-title"><?php echo esc_html( sprintf( __( 'You have reached %d of %d points (%s)', 'coaching' ), $history->mark, $quiz->get_mark(), round( $history->mark_percent ) . '%' ) ); ?></h3>
	<?php
	$fields = array(
		'correct' => sprintf( apply_filters( 'learn_press_quiz_result_correct_text', __( 'Correct %d (%0.0f%%)', 'coaching' ) ), $history->correct, $history->correct_percent ),
		'wrong'   => sprintf( apply_filters( 'learn_press_quiz_result_wrong_text', __( 'Wrong %d (%0.0f%%)', 'coaching' ) ), $history->wrong, $history->wrong_percent ),
		'empty'   => sprintf( apply_filters( 'learn_press_quiz_result_empty_text', __( 'Empty %d (%0.0f%%)', 'coaching' ) ), $history->empty, $history->empty_percent )
	)
	?>
	<div class="result-summary">
		<?php foreach ( $fields as $class => $text ):
			?>
			<?php $value = apply_filters( 'learn_press_quiz_result_' . $class . '_value', $history->{$class}, $history, $quiz, $course ); ?>
			<div class="result-field <?php echo $class; ?>">
				<span><?php echo esc_html( $class ); ?></span>
				<span class="value"><?php echo esc_html( $value ); ?></span>
			</div>
		<?php endforeach; ?>
		<div class="result-field points">
			<span><?php esc_html_e( 'Points', 'coaching' ); ?></span>
			<span class="value"><?php echo esc_html( $history->mark . '/' . $quiz->get_mark() ); ?></span>
		</div>
		<?php if ( $quiz->duration > 0 ): ?>
			<div class="result-field time">
				<span><?php esc_html_e( 'Time', 'coaching' ) ?></span>
				<span class="value"><?php echo learn_press_seconds_to_time( $history->time ) ?></span>
			</div>
		<?php endif; ?>
	</div>

	<div class="clearfix"></div>

	<?php

	if ( $grade = $user->get_quiz_graduation( $quiz->id, $course->id ) ) {
		if ( 'point' == $quiz->passing_grade_type ) {
			$pass_point = $quiz->passing_grade;
		} else {
			$pass_point = round( $quiz->passing_grade ) . '%';
		}

		if ( $grade == 'passed' ) {
			learn_press_display_message( sprintf ( __( 'Your quiz grade <b>%s</b>. Quiz requirement <b>%s</b>', 'coaching') , $grade, $pass_point ) , 'success' );
		}else{
			learn_press_display_message( sprintf ( __( 'Your quiz grade <b>%s</b>. Quiz requirement <b>%s</b>', 'coaching') , $grade, $pass_point ) , 'error' );
		}
	}


	?>

	<div class="clearfix"></div>

</div>
