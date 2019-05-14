<?php

class Thim_Gallery_Video_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'gallery-videos',
			esc_attr__( 'Thim: Gallery Videos ', 'coaching' ),
			array(
				'description'   => esc_attr__( 'Display gallery posts', 'coaching' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'cad_id'       => array(
					'type'    => 'select',
					'label'   => esc_attr( 'Select Category', 'coaching' ),
					'default' => 'none',
					'options' => $this->thim_get_categories(),
				),
				'orderby'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Order By', 'coaching' ),
					'options' => array(
						'popular' => esc_html__( 'Popular', 'coaching' ),
						'recent'  => esc_html__( 'Recent', 'coaching' ),
						'title'   => esc_html__( 'Title', 'coaching' ),
						'random'  => esc_html__( 'Random', 'coaching' ),
					),
				),
				'link'         => array(
					'type'  => 'text',
					'label' => esc_html__( 'Link All', 'coaching' ),
					'lable' => esc_html__( 'Link All Video', 'coaching' )
				),
				'text_link'    => array(
					'type'  => 'text',
					'label' => esc_html__( 'Text Of Link', 'coaching' ),
					'lable' => esc_html__( 'Text Of Link All Video', 'coaching' )
				),
				'number_posts' => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Number Posts', 'coaching' ),
					'default' => '3'
				),
                'style' => array(
                    "type"    => "select",
                    "label"   => esc_html__( "Videos Style", 'coaching' ),
                    "options" => array(
                        "" => esc_html__( "Normal", 'coaching' ),
                        "slider"  => esc_html__( "Slider", 'coaching' ),
                    ),
                    'default' => ''
                ),
			)
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
        if ( isset($instance['style']) && $instance['style'] != '' ) {
            return $instance['style'];
        }
        else {
            return 'base';
        }
	}

	function get_style_name( $instance ) {
		return false;
	}

	/**
	 * Function to get list categories
	 */
	function thim_get_categories() {
		$args         = array(
			'orderby' => 'id',
			'parent'  => 0
		);
		$items        = array();
		$items['all'] = esc_html__( 'All', 'coaching' );
		$categories   = get_categories( $args );
		if ( isset( $categories ) ) {
			foreach ( $categories as $key => $cat ) {
				$items[$cat->cat_ID] = $cat->cat_name;
				$childrens           = get_term_children( $cat->term_id, $cat->taxonomy );
				if ( $childrens ) {
					foreach ( $childrens as $key => $children ) {
						$child                  = get_term_by( 'id', $children, $cat->taxonomy );
						$items[$child->term_id] = esc_html__( '--', 'coaching' ) . $child->name;

					}
				}
			}
		}
		return $items;
	}

}

function thim_gallery_videos_widget() {
	register_widget( 'Thim_Gallery_Video_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_videos_widget' );