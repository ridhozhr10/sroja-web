<?php

if ( ! function_exists( 'makao_core_add_minimal_mobile_header_options' ) ) {
	function makao_core_add_minimal_mobile_header_options( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'makao-core' ),
				'description' => esc_html__( 'Enter header height', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'makao-core' ),
				'description' => esc_html__( 'Enter header background color', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				)
			)
		);
	}
	
	add_action( 'makao_core_action_after_mobile_header_options_map', 'makao_core_add_minimal_mobile_header_options' );
}