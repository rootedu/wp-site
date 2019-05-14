<?php
/**
 * Template for displaying the list of course is in wishlist
 *
 * @author ThimPress
 */

defined( 'ABSPATH' ) || exit();
global $post;
$course      = LP_Course::get_course( $post->ID );
$is_required = $course->is_required_enroll();
?>
<div class="course-item">
	<?php
	echo '<div class="course-thumbnail">';
	echo '<a href="' . esc_url( get_the_permalink() ) . '" >';
	echo thim_get_feature_image( get_post_thumbnail_id( $post->ID ), 'full', 450, 450, get_the_title() );
	echo '</a>';
	echo '<a class="course-readmore" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Read More', 'coaching' ) . '</a>';
	echo '</div>';
	?>
	<div class="thim-course-content">
		<h2 class="course-title">
			<a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>"> <?php echo get_the_title( $post->ID ); ?></a>
		</h2>

		<div class="middle">
			<div class="course-author" itemscope itemtype="http://schema.org/Person">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
				<div class="author-contain">
					<label itemprop="jobTitle"><?php esc_html_e( 'Teacher', 'coaching' ); ?></label>

					<div class="value" itemprop="name">
						<a href="<?php echo esc_url( learn_press_user_profile_link( $post->post_author ) ); ?>">
							<?php echo the_author_meta( 'user_nicename' , $course->post->post_author ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php
			$count = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;
			?>
			<div class="course-students">
				<label><?php esc_html_e( 'Students', 'coaching' ); ?></label>
				<?php do_action( 'learn_press_begin_course_students' ); ?>

				<div class="value"><i class="fa fa-group"></i>
					<?php echo esc_html( $count ); ?>
				</div>
				<?php do_action( 'learn_press_end_course_students' ); ?>

			</div>
		</div>

		<div class="course-meta">
			<div class="course-review">
				<?php thim_print_rating( $post->ID ); ?>
			</div>

			<div class="course-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
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