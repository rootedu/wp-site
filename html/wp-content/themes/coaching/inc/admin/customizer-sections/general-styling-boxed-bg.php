<?php
/**
 * Section Background Boxed Mode
 *
 * @package Hair_Salon
 */

// Body Background Group
thim_customizer()->add_group( array(
	'id'       => 'general_boxed_background_group',
	'section'  => 'general_styling',
	'priority' => 50,
	'groups'   => array(
		array(
			'id'     => 'thim_boxed_background_group',
			'label'  => esc_html__( 'Boxed Background', 'coaching' ),
			'fields' => array(
				array(
					'type'     => 'radio-buttonset',
					'id'       => 'thim_bg_boxed_type',
					'label'    => esc_html__( 'Select Background Type', 'coaching' ),
					'tooltip'  => esc_html__( 'Allows you to select a background for body content when you selected box layout in General Layouts', 'coaching' ),
					'default'  => 'image',
					'priority' => 10,
					'choices'  => array(
						'image'   => esc_html__( 'Image', 'coaching' ),
						'pattern' => esc_html__( 'Pattern', 'coaching' ),
					),
				),
				array(
					'type'            => 'image',
					'id'              => 'thim_bg_upload',
					'label'           => esc_html__( 'Background image', 'coaching' ),
					'priority'        => 30,
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-image',
							'function' => 'css',
							'property' => 'background-image',
						),
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'thim_bg_repeat',
					'label'           => esc_html__( 'Background Repeat', 'coaching' ),
					'default'         => 'no-repeat',
					'priority'        => 40,
					'choices'         => array(
						'repeat'    => esc_html__( 'Tile', 'coaching' ),
						'repeat-x'  => esc_html__( 'Tile Horizontally', 'coaching' ),
						'repeat-y'  => esc_html__( 'Tile Vertically', 'coaching' ),
						'no-repeat' => esc_html__( 'No Repeat', 'coaching' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-image',
							'function' => 'css',
							'property' => 'background-repeat',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'thim_bg_position',
					'label'           => esc_html__( 'Background Position', 'coaching' ),
					'default'         => 'center',
					'priority'        => 50,
					'choices'         => array(
						'left'   => esc_html__( 'Left', 'coaching' ),
						'center' => esc_html__( 'Center', 'coaching' ),
						'right'  => esc_html__( 'Right', 'coaching' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-image',
							'function' => 'css',
							'property' => 'background-position',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'thim_bg_attachment',
					'label'           => esc_html__( 'Background Attachment', 'coaching' ),
					'default'         => 'inherit',
					'priority'        => 60,
					'choices'         => array(
						'scroll'  => esc_html__( 'Scroll', 'coaching' ),
						'fixed'   => esc_html__( 'Fixed', 'coaching' ),
						'inherit' => esc_html__( 'Inherit', 'coaching' ),
						'initial' => esc_html__( 'Initial', 'coaching' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-image',
							'function' => 'css',
							'property' => 'background-attachment',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),

				array(
					'type'            => 'select',
					'id'              => 'thim_bg_size',
					'label'           => esc_html__( 'Background Size', 'coaching' ),
					'default'         => 'inherit',
					'priority'        => 60,
					'choices'         => array(
						'contain' => esc_html__( 'Contain', 'coaching' ),
						'cover'   => esc_html__( 'Cover', 'coaching' ),
						'initial' => esc_html__( 'Initial', 'coaching' ),
						'inherit' => esc_html__( 'Inherit', 'coaching' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-image',
							'function' => 'css',
							'property' => 'background-size',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),


				array(
					'type'            => 'radio-image',
					'id'              => 'thim_bg_pattern',
					'label'           => esc_html__( 'Select a Background Pattern', 'coaching' ),
					'section'         => 'background',
					'default'         => THIM_URI . 'images/patterns/pattern1.png',
					'priority'        => 70,
					'choices'         => array(
						THIM_URI . 'images/patterns/pattern1.png'  => THIM_URI . 'images/patterns/pattern1_icon.png',
						THIM_URI . 'images/patterns/pattern2.png'  => THIM_URI . 'images/patterns/pattern2_icon.png',
						THIM_URI . 'images/patterns/pattern3.png'  => THIM_URI . 'images/patterns/pattern3_icon.png',
						THIM_URI . 'images/patterns/pattern4.png'  => THIM_URI . 'images/patterns/pattern4_icon.png',
						THIM_URI . 'images/patterns/pattern5.png'  => THIM_URI . 'images/patterns/pattern5_icon.png',
						THIM_URI . 'images/patterns/pattern6.png'  => THIM_URI . 'images/patterns/pattern6_icon.png',
						THIM_URI . 'images/patterns/pattern7.png'  => THIM_URI . 'images/patterns/pattern7_icon.png',
						THIM_URI . 'images/patterns/pattern8.png'  => THIM_URI . 'images/patterns/pattern8_icon.png',
						THIM_URI . 'images/patterns/pattern9.png'  => THIM_URI . 'images/patterns/pattern9_icon.png',
						THIM_URI . 'images/patterns/pattern10.png' => THIM_URI . 'images/patterns/pattern10_icon.png',
						THIM_URI . 'images/patterns/pattern11.png' => THIM_URI . 'images/patterns/pattern11_icon.png',
						THIM_URI . 'images/patterns/pattern12.png' => THIM_URI . 'images/patterns/pattern12_icon.png',
						THIM_URI . 'images/patterns/pattern13.png' => THIM_URI . 'images/patterns/pattern13_icon.png',
						THIM_URI . 'images/patterns/pattern14.png' => THIM_URI . 'images/patterns/pattern14_icon.png',
						THIM_URI . 'images/patterns/pattern15.png' => THIM_URI . 'images/patterns/pattern15_icon.png',
						THIM_URI . 'images/patterns/pattern16.png' => THIM_URI . 'images/patterns/pattern16_icon.png',
						THIM_URI . 'images/patterns/pattern17.png' => THIM_URI . 'images/patterns/pattern17_icon.png',
						THIM_URI . 'images/patterns/pattern18.png' => THIM_URI . 'images/patterns/pattern18_icon.png',
						THIM_URI . 'images/patterns/pattern19.png' => THIM_URI . 'images/patterns/pattern19_icon.png',
						THIM_URI . 'images/patterns/pattern20.png' => THIM_URI . 'images/patterns/pattern20_icon.png',
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body.boxed-area.bg-boxed-pattern',
							'function' => 'css',
							'property' => 'background-image',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'thim_bg_boxed_type',
							'operator' => '===',
							'value'    => 'pattern',
						),
					),
				),
			),
		),
	)
) );