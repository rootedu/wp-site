<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

vc_map( array(
    'name'        => esc_html__( 'Thim: Image Box', 'coaching' ),
    'base'        => 'thim-image-box',
    'category'    => esc_html__( 'Thim Shortcodes', 'coaching' ),
    'description' => esc_html__( 'Add Image box', 'coaching' ),
    'icon'        => 'thim-widget-icon thim-widget-icon-icon-box',
    'params'      => array(
        array(
            'type'        => 'textfield',
            'admin_label' => true,
            'heading'     => esc_html__( 'Title', 'coaching' ),
            'param_name'  => 'title',
            'description' => esc_html__( 'Provide the title for this box.', 'coaching' ),
        ),
        array(
            'type'        => 'textfield',
            'admin_label' => true,
            'heading'     => esc_html__( 'Sub Title', 'coaching' ),
            'param_name'  => 'subtitle',
            'description' => esc_html__( 'Provide the sub title for this box.', 'coaching' ),
        ),
        array(
            'type'        => 'attach_image',
            'admin_label' => false,
            'heading'     => esc_html__( 'Image Of Box', 'coaching' ),
            'description' => esc_html__( 'Select image from media library.', 'coaching' ),
            'param_name'  => 'image',
        ),
	    array(
		    'type'        => 'textfield',
		    'heading'     => esc_html__( 'Add Link', 'coaching' ),
		    'param_name'  => 'link',
		    'description' => esc_html__( 'Provide the link that will be applied to this icon box.', 'coaching' ),
	    ),
        // Extra class
        array(
            'type'        => 'textfield',
            'admin_label' => false,
            'heading'     => esc_html__( 'Extra class', 'coaching' ),
            'param_name'  => 'el_class',
            'value'       => '',
            'description' => esc_html__( 'Add extra class name that will be applied to the box, and you can use this class for your customizations.', 'coaching' ),
        ),
    )
) );