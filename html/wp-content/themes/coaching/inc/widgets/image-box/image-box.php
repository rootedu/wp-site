<?php

class Thim_Image_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'image-box',
			esc_html__( 'Thim: Image Box', 'coaching' ),
			array(
				'description'   => esc_html__( 'Add Image box', 'coaching' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'title'                   =>  array(
					'type'                =>  'text',
					'label'               =>  esc_html__( 'Title', 'coaching' ),
					'default'             =>  '',
                    'allow_html_formatting' => true
				),
                'subtitle'                   =>  array(
                    'type'                =>  'text',
                    'label'               =>  esc_html__( 'Sub Title', 'coaching' ),
                    'default'             =>  '',
                    'allow_html_formatting' => true
                ),
				'image_box'     =>  array(
					'type'        =>  'media',
					'label'       =>  esc_html__( 'Image Of Box', 'coaching' ),
					'description' =>  esc_html__( 'Select image from media library.', 'coaching' )
				),
                'link'                   => array(
                    "type"        => "text",
                    "label"       => esc_html__( "Add Link", 'coaching' ),
                    "description" => esc_html__( "Provide the link that will be applied to this icon box.", 'coaching' )
                ),
			)
		);
	}
	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_image_box_register_widget() {
	register_widget( 'Thim_Image_Box_Widget' );
}

add_action( 'widgets_init', 'thim_image_box_register_widget' );