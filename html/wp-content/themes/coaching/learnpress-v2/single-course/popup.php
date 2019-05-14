<?php
/**
 * Template for displaying popup course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.1.5
 */

$course = learn_press_get_course( get_the_ID() );
$user   = learn_press_get_current_user();
?>
<script type="text/template" id="learn-press-template-curriculum-popup">
	<div id="course-curriculum-popup" class="sidebar-hide">
		<div id="popup-header" class="fefeee">
			<div class="courses-searching">
				<input type="text" value="" name="s" placeholder="<?php esc_attr_e( 'Search courses', 'coaching' ) ?>" class="thim-s form-control courses-search-input" autocomplete="off" />
				<input type="hidden" value="course" name="ref" />
				<button type="submit"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
				<ul class="courses-list-search"></ul>
			</div>
			<a class="popup-close"><i class="fa fa-close"></i></a>
		</div>
		<div id="popup-main" class="efe">
			<div id="popup-content">
				<div id="popup-content-inner">
				</div>
			</div>
		</div>
		<div id="popup-sidebar">
			<?php

			$args = wp_parse_args( $args, apply_filters( 'learn_press_breadcrumb_defaults', array(
				'delimiter'   => '<i class="fa-angle-right fa"></i>',
				'wrap_before' => '<nav class="thim-font-heading learn-press-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
			) ) );

			$breadcrumbs = new LP_Breadcrumb();


			$args['breadcrumb'] = $breadcrumbs->generate();

			learn_press_get_template( 'global/breadcrumb.php', $args );

			?>
		</div>
	</div>
</script>

<script type="text/template" id="learn-press-template-course-prev-item">
	<div class="course-content-lesson-nav course-item-prev prev-item">
		<a class="footer-control prev-item button-load-item" data-id="{{data.id}}" href="{{data.url}}">{{data.title}}</a>
	</div>
</script>

<script type="text/template" id="learn-press-template-course-next-item">
	<div class="course-content-lesson-nav course-item-next next-item">
		<a class="footer-control next-item button-load-item" data-id="{{data.id}}" href="{{data.url}}">{{data.title}}</a>
	</div>
</script>

<script type="text/template" id="learn-press-template-block-content">
	<div id="learn-press-block-content" class="popup-block-content">
		<div class="thim-box-loading-container">
			<div class="cssload-container">
				<div id="preload">
					<div class="cssload-loader">
						<div class="cssload-inner cssload-one"></div>
						<div class="cssload-inner cssload-two"></div>
						<div class="cssload-inner cssload-three"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</script>