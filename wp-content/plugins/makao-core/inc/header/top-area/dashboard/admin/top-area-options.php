<?php

if ( ! function_exists( 'makao_core_add_top_area_options' ) ) {
	function makao_core_add_top_area_options( $page, $general_header_tab ) {

		$top_area_section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_top_area_section',
				'title'       => esc_html__( 'Top Area', 'makao-core' ),
				'description' => esc_html__( 'Options related to top area', 'makao-core' ),
				'dependency'  => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => makao_core_dependency_for_top_area_options(),
							'default_value' => apply_filters( 'makao_core_filter_header_layout_default_option_value', '' )
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_top_area_header',
				'title'         => esc_html__( 'Top Area', 'makao-core' ),
				'description'   => esc_html__( 'Enable top area', 'makao-core' )
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'makao-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'makao-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'makao-core' ),
				'description' => esc_html__( 'Choose top area background color', 'makao-core' )
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'makao-core' ),
				'description' => esc_html__( 'Enter top area height (default is 30px)', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'makao-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'makao-core' )
				)
			)
		);
	}

	add_action( 'makao_core_action_after_header_options_map', 'makao_core_add_top_area_options', 20, 2 );
}