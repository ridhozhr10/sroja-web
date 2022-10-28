<?php

if ( ! function_exists( 'makao_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'makao-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'makao-core' ),
					'description' => esc_html__( 'Set background color', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'makao-core' ),
					'description' => esc_html__( 'Set background image', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Image Repeat', 'makao-core' ),
					'description' => esc_html__( 'Set background image repeat', 'makao-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'makao-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'makao-core' ),
						'repeat'    => esc_html__( 'Repeat', 'makao-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'makao-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'makao-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Image Size', 'makao-core' ),
					'description' => esc_html__( 'Set background image size', 'makao-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'makao-core' ),
						'contain' => esc_html__( 'Contain', 'makao-core' ),
						'cover'   => esc_html__( 'Cover', 'makao-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Image Attachment', 'makao-core' ),
					'description' => esc_html__( 'Set background image attachment', 'makao-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'makao-core' ),
						'fixed'  => esc_html__( 'Fixed', 'makao-core' ),
						'scroll' => esc_html__( 'Scroll', 'makao-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'makao-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'makao-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (768px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'makao-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'makao-core' ),
					'default_value' => 'no'
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'makao-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'makao-core' ),
					'description' => esc_html__( 'Set boxed background color', 'makao-core' )
				)
			);

            $boxed_section->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_boxed_background_pattern',
                    'title'       => esc_html__( 'Boxed Background Pattern', 'makao-core' ),
                    'description' => esc_html__( 'Set boxed background pattern', 'makao-core' )
                )
            );

            $boxed_section->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_boxed_background_pattern_behavior',
                    'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'makao-core' ),
                    'description' => esc_html__( 'Set boxed background pattern behavior', 'makao-core' ),
                    'options'     => array(
                        'fixed'  => esc_html__( 'Fixed', 'makao-core' ),
                        'scroll' => esc_html__( 'Scroll', 'makao-core' )
                    ),
                )
            );

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'makao-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'makao-core' ),
					'default_value' => 'no'
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'makao-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'makao-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'makao-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'makao-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'makao-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'makao-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'makao-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'makao-core' )
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'makao-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'makao-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'makao-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'makao-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100'
				)
			);

			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_general_options_map', $page );
			
			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'makao-core' ),
					'description' => esc_html__( 'Enter your custom Javascript here', 'makao-core' )
				)
			);
		}
	}

	add_action( 'makao_core_action_default_options_init', 'makao_core_add_general_options', makao_core_get_admin_options_map_position( 'general' ) );
}