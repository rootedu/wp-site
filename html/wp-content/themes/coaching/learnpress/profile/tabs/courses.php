<?php
/**
 * User Courses tab
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$subtabs = array(
	'learning'  => esc_html__( 'Learning Courses', 'coaching' ),
	'purchased' => esc_html__( 'Purchased Courses', 'coaching' ),
	'finished'  => esc_html__( 'Finished Courses', 'coaching' ),
	'own'       => esc_html__( 'Own Courses', 'coaching' )
);
$subtabs = apply_filters( 'learn_press_profile_tab_courses_subtabs', $subtabs );
if ( !$subtabs ) {
	return;
}
?>
<?php foreach ( $subtabs as $subid => $subtitle ) { ?>
	<?php
	//echo '<h3 class="box-title">'.$subtitle.'</h3>';
	do_action( 'learn_press_profile_tab_courses_' . $subid, $user, $subid ); ?>
<?php } ?>