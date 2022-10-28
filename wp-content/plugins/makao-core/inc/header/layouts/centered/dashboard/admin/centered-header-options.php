<?php

if ( ! function_exists( 'makao_core_add_centered_header_options' ) ) {
	function makao_core_add_centered_header_options( $page, $general_header_tab ) {
		
		$section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_centered_header_section',
				'title'      => esc_html__( 'Centered Header', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'centered',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_centered_header_height',
				'title'       => esc_html__( 'Header Height', 'makao-core' ),
				'description' => esc_html__( 'Enter header height', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				)
			)
		);

        $section->add_field_element(
            array(
                'field_type'  => 'text',
                'name'        => 'qodef_centered_header_side_padding',
                'title'       => esc_html__( 'Header Side Padding', 'makao-core' ),
                'description' => esc_html__( 'Enter side padding for header area', 'makao-core' ),
                'args'        => array(
                    'suffix' => esc_html__( 'px or %', 'makao-core' )
                )
            )
        );
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_centered_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'makao-core' ),
				'description' => esc_html__( 'Enter header background color', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				)
			)
		);
	}
	
	add_action( 'makao_core_action_after_header_options_map', 'makao_core_add_centered_header_options', 10, 2 );
}