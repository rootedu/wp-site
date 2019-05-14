<?php
/**
 * @author        ThimPress
 * @package       LearnPress/Templates
 * @version       1.0
 */

defined( 'ABSPATH' ) || exit();

$course = LP()->course;
if ( !$course ) {
	return;
}
$status = LP()->user->get( 'course-status', $course->id );
if ( !$status ) {
	return;
}

$num_of_decimal    = 0;
$result            = $course->evaluate_course_results();
$current           = round( $result * 100, $num_of_decimal );
$passing_condition = round( $course->passing_condition, $num_of_decimal );
$passed            = $current >= $passing_condition;
$heading           = apply_filters( 'learn_press_course_progress_heading', $status == 'finished' ? esc_html__( 'Your result', 'coaching' ) : esc_html__( 'Learning progress', 'coaching' ) );
?>
<div class="lp-course-progress<?php echo ( $passed ) ? ' passed' : ''; ?>" data-value="<?php echo esc_attr( $current ); ?>" data-passing-condition="<?php echo esc_attr( $passing_condition ); ?>">
	<?php if ( $heading !== false ): ?>
		<label class="lp-course-progress-heading"><?php echo esc_html( $heading ); ?>
			<span class="value result"><?php echo sprintf( esc_html__( '%s%%', 'coaching' ), $current ); ?></span></label>
	<?php endif; ?>
	<div class="lp-progress-bar value">
		<div class="lp-progress-value" style="width: <?php echo esc_attr( $result * 100 ); ?>%;">
		</div>
	</div>
</div>