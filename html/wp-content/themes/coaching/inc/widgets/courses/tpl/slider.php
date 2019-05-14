<?php

global $post;
$limit        = $instance['limit'];
$item_visible = $instance['slider-options']['item_visible'];
$view_all_course = ( $instance['view_all_courses'] && '' != $instance['view_all_courses'] ) ? $instance['view_all_courses'] : false;
$pagination   = $instance['slider-options']['show_pagination'] ? $instance['slider-options']['show_pagination'] : 0;
$navigation   = $instance['slider-options']['show_navigation'] ? $instance['slider-options']['show_navigation'] : 0;
$condition    = array(
	'post_type'           => 'lp_course',
	'posts_per_page'      => $limit,
	'ignore_sticky_posts' => true,
);
$sort         = $instance['order'];



if ( $sort == 'popular' ) {
	global $wpdb;
	$the_query = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT pm.post_id, pm.meta_value + COUNT(pm.post_id) - IF (uc.course_id, 0, 1) as students
		FROM `$wpdb->postmeta` AS pm
		LEFT JOIN `$wpdb->learnpress_user_courses` AS uc ON pm.post_id = uc.course_id
		WHERE pm.meta_key = %s
		GROUP BY pm.post_id
		ORDER BY students DESC",
		'_lp_students'
	) );

	$condition['post__in'] = $the_query;
	$condition['orderby']  = 'post__in';
}

$the_query = new WP_Query( $condition );

if ( $the_query->have_posts() ) :
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}


	?>
	<div class="thim-carousel-wrapper thim-course-carousel thim-course-grid" data-visible="<?php echo esc_attr( $item_visible ); ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-navigation="<?php echo esc_attr( $navigation ); ?>">
		<?php
		//$index = 1;
		while ( $the_query->have_posts() ) : $the_query->the_post();


			?>
			<div class="course-item">
				<?php
				echo '<div class="course-thumbnail">';
				echo '<a href="' . esc_url( get_the_permalink() ) . '" >';
				echo thim_get_feature_image( get_post_thumbnail_id( $post->ID ), 'full', 450, 450, get_the_title() );
				echo '</a>';
				thim_course_wishlist_button( $post->ID );
				echo '<a class="course-readmore" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Read More', 'coaching' ) . '</a>';
				echo '</div>';
				?>
				<div class="thim-course-content">
					<h2 class="course-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php echo get_the_title(); ?></a>
					</h2>

					<div class="middle">
						<?php learn_press_course_instructor(); ?>
						<?php learn_press_course_students(); ?>
					</div>

					<div class="course-meta">
						<div class="course-review">
							<?php thim_print_rating(); ?>
						</div>

						<div class="course-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<?php
							$course = LP_Course::get_course( $post->ID );
							$is_required = $course->is_required_enroll();
							?>
							<?php if ( $course->is_free() || !$is_required ) : ?>
								<div class="value free-course" itemprop="price" content="<?php esc_attr_e( 'Free', 'coaching' ); ?>">
									<?php esc_html_e( 'Free', 'coaching' ); ?>
								</div>
							<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
								<div class="value " itemprop="price" content="<?php echo esc_attr( $price ); ?>">
									<?php echo esc_html( $price ); ?>
								</div>
							<?php endif; ?>
							<meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />

						</div>
					</div>
				</div>
			</div>
			<?php
			//$index++ ;
		endwhile;
		?>
	</div>
	<?php
	if ( $view_all_course ) {
		echo '<div class="view-all"><a class="view-all-courses thim-button" href="' . get_post_type_archive_link( 'lp_course' ) . '">' . esc_attr( $view_all_course ) . '</a></div>';
	}
endif;
wp_reset_postdata();

?>
