<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $course;
$viewable = learn_press_user_can_view_quiz( $item->ID, $course->id );
$tag      = $viewable ? 'a' : 'span';
$target   = apply_filters( 'learn_press_section_item_link_target', '_blank', $item );
?>

<li <?php learn_press_course_quiz_class( $item->ID ); ?> data-type="<?php echo esc_attr( $item->post_type ); ?>">

	<?php do_action( 'learn_press_before_section_item_title', $item, $section, $course ); ?>
	<span class="index"><?php echo esc_html__( 'Quiz', 'coaching' ) . ' ' . $index; ?></span>

	<<?php echo esc_attr( $tag ); ?> class="quiz-title" target="<?php echo esc_attr( $target ); ?>" <?php echo ( $viewable ) ? 'href="' . get_the_permalink( $item->ID ) . '"' : ''; ?> data-id="<?php echo esc_attr( $item->ID ); ?>">

	<?php echo apply_filters( 'learn_press_section_item_title', get_the_title( $item->ID ), $item ); ?>

</<?php esc_attr( $tag ); ?>>

<?php
if ( !$viewable ) {
	echo '<span class="locked">' . esc_html__( 'Locked', 'coaching' ) . '</span>';
}
?>

<span class="meta"><?php echo thim_quiz_questions( $item->ID ) . ' ' . esc_html__( 'questions', 'coaching' ); ?></span>

<?php do_action( 'learn_press_after_section_item_title', $item, $section, $course ); ?>

</li>