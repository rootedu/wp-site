<?php
/**
 * Section Footer Settings
 *
 */

// Add Section Footer Options
thim_customizer()->add_section(
	array(
		'id'       => 'footer_options',
		'title'    => esc_html__( 'Settings', 'coaching' ),
		'panel'    => 'footer',
		'priority' => 10,
	)
);

// Feature: Body custom class
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'thim_footer_custom_class',
        'label'    => esc_html__( 'Footer Custom Class', 'coaching' ),
        'tooltip'  => esc_html__( 'Enter footer custom class.', 'coaching' ),
        'section'  => 'footer_options',
        'priority' => 10,
    )
);

// Footer Background Color
thim_customizer()->add_field(
	array(
		'type'      => 'color',
		'id'        => 'thim_footer_bg_color',
		'label'     => esc_html__( 'Background Color', 'coaching' ),
		'section'   => 'footer_options',
		'default'   => '#111',
		'priority'  => 40,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer#colophon .footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Footer Text Color
thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'thim_footer_color',
		'label'     => esc_html__( 'Colors', 'coaching' ),
		'section'   => 'footer_options',
		'priority'  => 50,
		'choices'   => array(
			'title' => esc_html__( 'Title', 'coaching' ),
			'text'  => esc_html__( 'Text', 'coaching' ),
			'link'  => esc_html__( 'Link', 'coaching' ),
			'hover' => esc_html__( 'Hover', 'coaching' ),
		),
		'default'   => array(
			'title' => '#fff',
			'text'  => '#999',
			'link'  => '#eee',
			'hover' => '#ffb606',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'title',
				'function' => 'css',
				'element'  => 'footer#colophon .footer .widget-title',
				'property' => 'color',
			),
			array(
				'choice'   => 'text',
				'function' => 'css',
				'element'  => '
								footer#colophon .footer .thim-footer-location .social a,
								footer#colophon .footer,
								footer#colophon .footer .thim-footer-location .info .fa,
								footer#colophon .footer a,
								.thim-social li a
								',
				'property' => 'color',
			),
			array(
				'choice'   => 'link',
				'function' => 'css',
				'element'  => 'footer#colophon .footer .thim-footer-location .info a',
				'property' => 'color',
			),
			array(
				'choice'   => 'hover',
				'function' => 'style',
				'element'  => 'footer#colophon .footer a:hover',
				'property' => 'color',
			),
		),
	)
);


// Body Background Group
thim_customizer()->add_group( array(
	'id'       => 'footer_background_group',
	'section'  => 'footer_options',
	'priority' => 150,
	'groups'   => array(
		array(
			'id'     => 'thim_footer_background_group',
			'label'  => esc_html__( 'Footer Background Image', 'coaching' ),
			'fields' => array(

				array(
					'type'      => 'image',
					'id'        => 'thim_footer_background_img',
					'label'     => esc_html__( 'Background image', 'coaching' ),
					'priority'  => 30,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'footer#colophon',
							'function' => 'css',
							'property' => 'background-image',
						),
					),
				),
				array(
					'type'      => 'select',
					'id'        => 'thim_footer_bg_repeat',
					'label'     => esc_html__( 'Background Repeat', 'coaching' ),
					'default'   => 'no-repeat',
					'priority'  => 40,
					'choices'   => array(
						'repeat'    => esc_html__( 'Repeat', 'coaching' ),
						'repeat-x'  => esc_html__( 'Repeat X', 'coaching' ),
						'repeat-y'  => esc_html__( 'Repeat Y', 'coaching' ),
						'no-repeat' => esc_html__( 'No Repeat', 'coaching' ),
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'footer#colophon',
							'function' => 'css',
							'property' => 'background-repeat',
						),
					),
				),

				array(
					'type'      => 'select',
					'id'        => 'thim_footer_bg_position',
					'label'     => esc_html__( 'Background Position', 'coaching' ),
					'default'   => 'center',
					'priority'  => 50,
					'choices'   => array(
						'left'   => esc_html__( 'Left', 'coaching' ),
						'center' => esc_html__( 'Center', 'coaching' ),
						'right'  => esc_html__( 'Right', 'coaching' ),
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'footer#colophon',
							'function' => 'css',
							'property' => 'background-position',
						),
					),
				),

				array(
					'type'      => 'select',
					'id'        => 'thim_footer_bg_attachment',
					'label'     => esc_html__( 'Background Attachment', 'coaching' ),
					'default'   => 'inherit',
					'priority'  => 60,
					'choices'   => array(
						'scroll'  => esc_html__( 'Scroll', 'coaching' ),
						'fixed'   => esc_html__( 'Fixed', 'coaching' ),
						'inherit' => esc_html__( 'Inherit', 'coaching' ),
						'initial' => esc_html__( 'Initial', 'coaching' ),
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'footer#colophon',
							'function' => 'css',
							'property' => 'background-attachment',
						),
					),
				),

				array(
					'type'      => 'select',
					'id'        => 'thim_footer_bg_size',
					'label'     => esc_html__( 'Background Size', 'coaching' ),
					'default'   => 'inherit',
					'priority'  => 60,
					'choices'   => array(
						'contain' => esc_html__( 'Contain', 'coaching' ),
						'cover'   => esc_html__( 'Cover', 'coaching' ),
						'initial' => esc_html__( 'Initial', 'coaching' ),
						'inherit' => esc_html__( 'Inherit', 'coaching' ),
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'footer#colophon',
							'function' => 'css',
							'property' => 'background-size',
						),
					),
				),
			),
		),
	)
) );