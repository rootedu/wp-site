<?php
/**
 * Template for displaying archive course content
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */


if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $wp_query;

$show_description = get_theme_mod( 'thim_learnpress_cate_show_description' );
$show_desc   = !empty( $show_description ) ? $show_description : '';
$cat_desc = term_description();

if ( is_tax() ) {
	$total = get_queried_object();
	$total = $total->count;
} elseif ( !empty( $_REQUEST['s'] ) ) {
	$total = $wp_query->found_posts;
} else {
	$total = wp_count_posts( 'lp_course' );
	$total = $total->publish;
}

if ( $total == 0 ) {
	echo '<p class="message message-error">' . esc_html__( 'There are no available courses!', 'coaching' ) . '</p>';
	return;
} elseif ( $total == 1 ) {
	$index = esc_html__( 'Showing only one result', 'coaching' );
} else {
	$courses_per_page = absint( LP()->settings->get( 'archive_course_limit' ) );
	$paged            = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

	$from = 1 + ( $paged - 1 ) * $courses_per_page;
	$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

	if ( $from == $to ) {
		$index = sprintf(
			esc_html__( 'Showing last course of %s results', 'coaching' ),
			$total
		);
	} else {
		$index = sprintf(
			esc_html__( 'Showing %s-%s of %s results', 'coaching' ),
			$from,
			$to,
			$total
		);
	}
}

?>

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php do_action( 'learn_press_archive_description' ); ?>

<?php if ( $wp_query->have_posts() ) : ?>

	<div class="thim-course-top">
		<div class="thim-course-switch-layout">
			<a href="#" class="list switchToGrid "><i class="fa fa-th-large"></i></a>
			<a href="#" class="grid switchToList"><i class="fa fa-list-ul"></i></a>
		</div>
		<div class="course-index">
			<span><?php echo( $index ); ?></span>
		</div>
		<div class="courses-searching">
			<form method="get" action="<?php echo esc_url( get_post_type_archive_link('lp_course') ); ?>">
				<input type="text" value="" name="s" placeholder="<?php esc_html_e( 'Search our courses', 'coaching' ) ?>" class="thim-s form-control courses-search-input" autocomplete="off" />
				<input type="hidden" value="course" name="ref" />
				<button type="submit"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
			</form>
			<ul class="courses-list-search list-unstyled"></ul>
		</div>
	</div>

	<?php do_action( 'learn_press_before_courses_loop' ); ?>

	<?php if( $show_desc && $cat_desc ) {?>
		<div class="desc_cat">
			<?php echo $cat_desc;?>
		</div>
	<?php }?>

	<div id="thim-course-archive" class="thim-course-grid">
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<?php learn_press_get_template_part( 'content', 'course' ); ?>

		<?php endwhile; ?>
	</div>

	<?php do_action( 'learn_press_after_courses_loop' ); ?>

<?php endif; ?>

<?php do_action( 'learn_press_after_main_content' ); ?>


