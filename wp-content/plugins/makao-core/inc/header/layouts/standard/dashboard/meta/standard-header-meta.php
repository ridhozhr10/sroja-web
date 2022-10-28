<?php

if ( ! function_exists( 'makao_core_add_standard_header_meta' ) ) {
	function makao_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'makao-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'makao-core' ),
				'default_value' => '',
				'options'       => makao_core_get_select_type_options_pool( 'no_yes' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
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
				'name'        => 'qodef_standard_header_side_padding',
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
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'makao-core' ),
				'description' => esc_html__( 'Enter header background color', 'makao-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'makao-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'makao-core' ),
					'left'   => esc_html__( 'Left', 'makao-core' ),
					'center' => esc_html__( 'Center', 'makao-core' ),
					'right'  => esc_html__( 'Right', 'makao-core' ),
				)
			)
		);

	}
	
	add_action( 'makao_core_action_after_page_header_meta_map', 'makao_core_add_standard_header_meta' );
}