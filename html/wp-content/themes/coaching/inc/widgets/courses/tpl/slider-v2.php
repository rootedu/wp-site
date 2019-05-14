<?php

global $post;
$limit        = $instance['limit'];
$item_visible = $instance['slider-options']['item_visible'];
$view_all_course = ( $instance['view_all_courses'] && '' != $instance['view_all_courses'] ) ? $instance['view_all_courses'] : false;
$pagination   = $instance['slider-options']['show_pagination'] ? $instance['slider-options']['show_pagination'] : 0;
$navigation   = $instance['slider-options']['show_navigation'] ? $instance['slider-options']['show_navigation'] : 0;
$thumb_w = ( !empty($instance['thumbnail_width']) && '' != $instance['thumbnail_width'] ) ? $instance['thumbnail_width'] : apply_filters('thim_course_thumbnail_width', 400);
$thumb_h = ( !empty($instance['thumbnail_height']) && '' != $instance['thumbnail_height'] ) ? $instance['thumbnail_height'] : apply_filters('thim_course_thumbnail_height', 300);
$condition    = array(
	'post_type'           => 'lp_course',
	'posts_per_page'      => $limit,
	'ignore_sticky_posts' => true,
);
$sort         = $instance['order'];

if ( $sort == 'category' && $instance['cat_id'] && $instance['cat_id'] != 'all' ) {
	if ( get_term( $instance['cat_id'], 'course_category' ) ) {
		$condition['tax_query'] = array(
			array(
				'taxonomy' => 'course_category',
				'field'    => 'term_id',
				'terms'    => $instance['cat_id']
			),
		);
	}
}

if ( $sort == 'popular' ) {
	global $wpdb;
	$query = $wpdb->prepare( "
	  SELECT ID, a+IF(b IS NULL, 0, b) AS students FROM(
		SELECT p.ID as ID, IF(pm.meta_value, pm.meta_value, 0) as a, (
	SELECT COUNT(*)
  FROM (SELECT COUNT(item_id), item_id, user_id FROM {$wpdb->prefix}learnpress_user_items GROUP BY item_id, user_id) AS Y
  GROUP BY item_id
  HAVING item_id = p.ID
) AS b
FROM {$wpdb->posts} p
LEFT JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id  AND pm.meta_key = %s
WHERE p.post_type = %s AND p.post_status = %s
GROUP BY ID
) AS Z
ORDER BY students DESC
	  LIMIT 0, $limit
 ", '_lp_students', 'lp_course', 'publish' );

	$post_in = $wpdb->get_col($query);

	$condition['post__in'] = $post_in;
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
            <?php _learn_press_count_users_enrolled_courses( array( $post->ID ) ); ?>
			<div class="course-item">
				<?php
				echo '<div class="course-thumbnail">';
				echo '<a href="' . esc_url( get_the_permalink() ) . '" >';
				echo thim_get_feature_image( get_post_thumbnail_id( $post->ID ), 'full', $thumb_w, $thumb_h, get_the_title() );
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
							<?php thim_course_ratings(); ?>
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
							<?php else:
								$price = $course->get_price_html();
								$origin_price = $course->get_origin_price_html();
								?>
								<div class="value " itemprop="price" content="<?php echo esc_attr( $price ); ?>">
									<?php
									echo esc_html( $price );
									if ( $price != $origin_price ) {
										echo '<span class="course-origin-price">' . $origin_price . '</span>';
									}
									?>
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
