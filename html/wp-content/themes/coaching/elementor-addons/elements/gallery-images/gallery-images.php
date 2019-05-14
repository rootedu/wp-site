<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Gallery_Images_El extends Widget_Base {

	public function get_name() {
		return 'thim-gallery-images';
	}

	public function get_title() {
		return esc_html__( 'Thim: Gallery Images', 'coaching' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-gallery-images';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Gallery image', 'coaching' )
			]
		);

		$this->add_control(
			'image',
			[
				'label'      => __( 'Add Images', 'coaching' ),
				'type'       => Controls_Manager::GALLERY,
				'show_label' => false
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude'   => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'       => esc_html__( 'Image Link', 'coaching' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'coaching' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'Add your links here', 'coaching' )
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'       => esc_html__( 'Link Target', 'coaching' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'_self'  => [
						'title' => esc_html__( 'Same window', 'coaching' ),
						'icon'  => 'fa fa-window-maximize',
					],
					'_blank' => [
						'title' => esc_html__( 'New window', 'coaching' ),
						'icon'  => 'fa fa-window-restore',
					],
				],
				'default'     => '_self',
				'toggle'      => false,
				'label_block' => false
			]
		);

		$this->add_responsive_control(
			'item',
			[
				'label'           => esc_html__( 'Visible Items', 'coaching' ),
				'type'            => Controls_Manager::NUMBER,
				'min'             => 1,
				'step'            => 1,
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 4,
				'tablet_default'  => 2,
				'mobile_default'  => 1
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'   => esc_html__( 'Show Pagination?', 'coaching' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => ''
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'       => esc_html__( 'Auto Play Speed (in ms)', 'coaching' ),
				'description' => esc_html__( 'Set 0 to disable auto play.', 'coaching' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 0,
				'min'         => 0,
				'step'        => 100
			]
		);

        $this->add_control(
            'autoplayTimeout',
            [
                'label' => esc_html__('Autoplay Timeout', 'coaching'),
                'description' => esc_html__( 'Set time out for slide auto play (millisecond).', 'coaching' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'image'           => array_map( function ( $ar ) { return $ar['id']; }, $settings['image'] ),
			'image_size'      => $settings['image_size'],
			'image_link'      => $settings['image_link'],
			'link_target'     => $settings['link_target'],
			'number'          => $settings['item'],
			'item_tablet'     => $settings['item_tablet'],
			'item_mobile'     => $settings['item_mobile'],
			'show_pagination' => $settings['show_pagination'],
			'autoplay '       => $settings['autoplay'],
			'autoplayTimeout' => $settings['autoplayTimeout'],
			'css_animation'   => '',
		);

		$args                 = array();
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title']  = '</h3>';

		thim_get_widget_template( $this->get_base(), array(
			'instance' => $instance,
			'args'     => $args
		) );
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Gallery_Images_El() );
