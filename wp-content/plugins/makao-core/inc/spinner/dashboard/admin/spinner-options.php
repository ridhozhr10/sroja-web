<?php

if ( ! function_exists( 'makao_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_page_spinner_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'makao-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'makao-core' ),
					'default_value' => 'no'
				)
			);
			
			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'makao-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'makao-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'makao-core' ),
					'options'       => apply_filters( 'makao_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'makao_core_filter_page_spinner_default_layout_option', '' ),
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'makao-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'makao-core' )
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'makao-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'makao-core' )
				)
			);

            $spinner_section->add_field_element(
                array(
                    'field_type'  => 'text',
                    'name'        => 'qodef_page_spinner_text',
                    'title'       => esc_html__( 'Spinner Text', 'makao-core' ),
                    'description' => esc_html__( 'Choose the spinner text', 'makao-core' ),
                    'dependency'  => array(
                        'show' => array(
                            'qodef_page_spinner_type' => array(
                                'values'        => 'makao-text',
                                'default_value' => ''
                            )
                        )
                    )
                )
            );

            $spinner_section->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_page_spinner_image',
                    'title'       => esc_html__( 'Spinner Image', 'makao-core' ),
                    'description' => esc_html__( 'Choose the spinner image', 'makao-core' ),
                    'dependency'  => array(
                        'show' => array(
                            'qodef_page_spinner_type' => array(
                                'values'        => 'makao-image',
                                'default_value' => ''
                            )
                        )
                    )
                )
            );
		}
	}
	
	add_action( 'makao_core_action_after_general_options_map', 'makao_core_add_page_spinner_options' );
}