<?php
/**
 * @author        ThimPress
 * @package       LearnPress/Templates
 * @version       1.0
 */
defined( 'ABSPATH' ) || exit();
?>
<div class="course-content-lesson-nav course-item-next">
	<span><?php esc_html_e( 'Next', 'coaching' ); ?></span>
	<a data-id="<?php echo esc_attr( $item ); ?>" href="<?php echo esc_url( $course->get_item_link( $item ) ); ?>"><?php echo get_the_title( $item ); ?></a>
</div>