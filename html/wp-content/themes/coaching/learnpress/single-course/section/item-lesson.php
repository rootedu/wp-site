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
$viewable = learn_press_user_can_view_lesson( $item->ID, $course->id );
$class    = $viewable ? 'viewable' : '';
$tag      = $viewable ? 'a' : 'span';
$target   = apply_filters( 'learn_press_section_item_link_target', '_blank', $item );

$is_enrolled = LP()->user->has( 'enrolled-course', $course->id );
$is_required = get_post_meta( $course->id, '_lp_required_enroll', true );

?>

<li <?php learn_press_course_lesson_class( $item->ID, $class ); ?> data-type="<?php echo esc_attr( $item->post_type ); ?>">

	<?php do_action( 'learn_press_before_section_item_title', $item, $section, $course ); ?>
	<span class="index"><?php echo esc_html__( 'Lecture', 'coaching' ) . ' ' . $index; ?></span>

	<<?php echo ent2ncr( $tag ); ?> class="lesson-title" target="<?php echo esc_attr( $target ); ?>" <?php echo ( $viewable ) ? 'href="' . $course->get_item_link( $item->ID ) . '"' : ''; ?> data-id="<?php echo esc_attr( $item->ID ); ?>">

	<?php echo apply_filters( 'learn_press_section_item_title', get_the_title( $item->ID ), $item ); ?>

</<?php echo ent2ncr( $tag ); ?>>
<?php if ( !$is_enrolled && $is_required !== 'no' && $viewable && get_post_meta( $item->ID, '_lp_preview', true ) == 'yes' ) : ?>
	<a class="lesson-preview" href="<?php echo esc_url( $course->get_item_link( $item->ID ) ); ?>" lesson-id="<?php echo esc_attr( $item->ID ); ?>" data-id="<?php echo esc_attr( $item->ID ); ?>">
		<?php esc_html_e( 'Preview', 'coaching' ); ?>
	</a>
<?php endif; ?>

<?php if ( LP()->user->has_completed_lesson( $item->ID ) ) {
	echo '<span class="completed-button">' . esc_html__( 'Completed', 'coaching' ) . '</span>';
}
?>

<?php
if ( !$viewable ) {
	echo '<span class="locked">' . esc_html__( 'Locked', 'coaching' ) . '</span>';
}
?>

<span class="meta"><?php echo thim_lesson_duration( $item->ID ); ?></span>

<?php do_action( 'learn_press_after_section_item_title', $item, $section, $course ); ?>

</li>
