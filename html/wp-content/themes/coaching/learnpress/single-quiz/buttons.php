<?php
/**
 * Template for displaying the buttons of a quiz
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$quiz = LP()->quiz;
$user = LP()->user;
if ( !$quiz ) {
	return;
}
$status       = $user->get_quiz_status( $quiz->id );
$retake_class = $status != 'completed' ? ' hide-if-js' : '';
?>
<div class="quiz-buttons">

	<?php if ( !$user->has( 'started-quiz', $quiz->id ) ): ?>
		<button class="button-start-quiz" data-id="<?php echo esc_attr( $quiz->id ); ?>" data-start-quiz-nonce="<?php echo esc_attr( wp_create_nonce( 'start-quiz-' . $quiz->id ) ); ?>"><?php esc_html_e( "Start Quiz", "coaching" ); ?></button>
	<?php endif; ?>

	<button class="button-finish-quiz<?php echo !$status ? ' hide-if-js' : ''; ?>" data-id="<?php echo esc_attr( $quiz->id ); ?>" data-finish-quiz-nonce="<?php echo esc_attr( wp_create_nonce( 'finish-quiz-' . $quiz->id ) ); ?>"><?php esc_html_e( "Finish Quiz", "coaching" ); ?></button>

	<?php if ( $remain = $user->can( 'retake-quiz', $quiz->id ) ): ?>
		<button class="button-retake-quiz<?php echo esc_attr( $retake_class ); ?>" data-id="<?php echo esc_attr( $quiz->id ); ?>" data-retake-quiz-nonce="<?php echo esc_attr( wp_create_nonce( 'retake-quiz-' . $quiz->id ) ); ?>"><?php echo sprintf( '%s (+%d)', esc_html__( 'Retake', 'coaching' ), $remain ); ?></button>
	<?php endif; ?>

</div>