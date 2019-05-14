<?php

class Thim_Gallery_Post_Widget extends Thim_Widget {
	function __construct() {
		$categories = get_terms( 'category', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
		$cate       = array();
		$cate[0]    = esc_html__( 'All', 'coaching' );
		if ( is_array( $categories ) ) {
			foreach ( $categories as $cat ) {
				$cate[ $cat->term_id ] = $cat->name;
			}
		}
		parent::__construct(
			'gallery-posts',
			esc_attr__( 'Thim: Gallery Posts ', 'coaching' ),
			array(
				'description'   => esc_attr__( 'Display gallery posts', 'coaching' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'cat'     => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Select Category', 'coaching' ),
					'options' => $cate
				),
				'columns' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Columns', 'coaching' ),
					'options' => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'default' => '4'
				),
				'filter'  => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show Filter', 'coaching' ),
					'default' => true,
				),
                'limit'    => array(
                    'type'    => 'number',
                    'label'   => esc_html__( 'Limit', 'coaching' ),
                    'default' => '8'
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

function thim_gallery_posts_widget() {
	register_widget( 'Thim_Gallery_Post_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_posts_widget' );