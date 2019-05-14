<?php
/**
 * Created by: Khoapq
 * Date: 15/10/2015
 */
class Thim_Accordion_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'accordion',
			esc_html__( 'Thim: Accordion', 'coaching' ),
			array(
				'description' => esc_html__( 'Add Accordion', 'coaching' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
                'panels_icon'   => 'thim-widget-icon thim-widget-icon-accordion'
			),
			array(),
			array(
				'title' => array(
					'type' => 'text',
					'label' => esc_html__('Title', 'coaching'),
					'default' => ''
				),

				'panel' => array(
					'type' => 'repeater',
					'label' => esc_html__('Panel List', 'coaching'),
					'item_name' => esc_html__('Panel', 'coaching'),
					'fields' => array(
						'panel_title' => array(
							'type' => 'text',
							'label' => esc_html__('Panel Title', 'coaching'),
						),

						'panel_body' => array(
							'type' => 'textarea',
							'allow_html_formatting' => true,
							'label' => esc_html__('Panel Body', 'coaching'),
						),
					),
				),
				'show_first_panel' => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show First Panel', 'coaching' ),
					'default' => false
				),
			),
			THIM_DIR . 'inc/widgets/accordion/'
		);

		
	}


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_accordion_register_widget() {
	register_widget( 'Thim_Accordion_Widget' );
}

add_action( 'widgets_init', 'thim_accordion_register_widget' );