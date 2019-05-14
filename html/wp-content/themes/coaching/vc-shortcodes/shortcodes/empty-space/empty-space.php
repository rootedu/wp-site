<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode Daily Support
 *
 * @param $atts
 *
 * @return string
 */
function thim_shortcode_empty_space( $atts ) {

    $instance = shortcode_atts( array(
        'title' => '',
        'height' => 30,
        'el_class' => '',
    ), $atts );

    $args                 = array();
    $args['before_title'] = '<h3 class="widget-title">';
    $args['after_title']  = '</h3>';

    $widget_template       = THIM_DIR . 'inc/widgets/empty-space/tpl/base.php';
    $child_widget_template = THIM_CHILD_THEME_DIR . 'inc/widgets/empty-space/base.php';
    if ( file_exists( $child_widget_template ) ) {
        $widget_template = $child_widget_template;
    }

    ob_start();
    if($instance['el_class']) echo '<div class="'.$instance['el_class'].'">';
    echo '<div class="thim-widget-round-slider">';
    include $widget_template;
    echo '</div>';
    if($instance['el_class']) echo '</div>';
    $html_output = ob_get_contents();
    ob_end_clean();

    return $html_output;
}

add_shortcode( 'thim-empty-space', 'thim_shortcode_empty_space' );
