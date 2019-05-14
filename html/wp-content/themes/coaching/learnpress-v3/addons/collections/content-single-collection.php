<?php
/**
 * Template for displaying single collection content.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/collection/content-single-collection.php.
 *
 * @author  ThimPress
 * @package LearnPress/Collections/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php do_action( 'learn_press_collections_before_single_collection' ); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/CreativeWork">

		<?php do_action( 'learn_press_collections_before_single_summary' ); ?>

		<div class="entry-content">
			<div id="lp-archive-courses" class="lp-single-collection">
				<div id="thim-course-archive" class="thim-course-grid">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

		<?php do_action( 'learn_press_after_single_collection_summary' ); ?>

	</div><!-- #post-## -->

<?php do_action( 'learn_press_collections_after_single_collection' ); ?>