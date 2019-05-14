<?php
/**
 * Template for displaying the list of questions for the quiz
 *
 * @author  ThimPress
 * @package LearnPress
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
$status = $user->get_quiz_status( $quiz->id );

$heading      = apply_filters( 'learn_press_list_questions_heading', ( 'completed' == $status ) ? esc_html__( 'Review Your Answer', 'coaching' ) : esc_html__( 'List of questions', 'coaching' ) );
$no_permalink = !LP()->user->has( 'started-quiz', $quiz->id );

?>

<?php if ( $heading ) { ?>
	<h4 class="list-question-title"><?php echo esc_html( $heading ); ?></h4>
<?php } ?>

<?php if ( $quiz->has( 'questions' ) ): ?>

	<div class="quiz-questions list-quiz-questions<?php echo 'completed' == $status ? ' completed-questions' : ''; ?>" id="learn-press-quiz-questions">

		<?php do_action( 'learn_press_before_quiz_questions' ); ?>

		<ul class="quiz-questions-list">
			<?php if ( $questions = $quiz->get_questions() ) foreach ( $questions as $question ) { ?>
				<li data-id="<?php echo esc_attr( $question->ID ); ?>" <?php learn_press_question_class( $question->ID, array( 'user' => $user, 'quiz' => $quiz ) ); ?>>

					<?php do_action( 'learn_press_before_quiz_question_title', $question->ID, $quiz->id ); ?>

					<?php if ( $no_permalink ) { ?>
						<?php printf( '<h4 class="question-title">%s</h4>', get_the_title( $question->ID ) ); ?>
					<?php } else { ?>
						<?php printf( '<h4 class="question-title"><a href="%s">%s</a></h4>', $quiz->get_question_link( $question->ID ), get_the_title( $question->ID ) ); ?>
					<?php } ?>

					<?php do_action( 'learn_press_after_quiz_question_title', $question->ID, $quiz->id ); ?>

				</li>
			<?php } ?>
		</ul>

		<?php do_action( 'learn_press_after_quiz_questions' ); ?>

	</div>

<?php else: ?>

	<?php learn_press_display_message( apply_filters( 'learn_press_quiz_no_questions_notice', esc_html__( 'This quiz hasn\'t got any questions', 'coaching' ) ), 'notice' ); ?>

<?php endif; ?>





