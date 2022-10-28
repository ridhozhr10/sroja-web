<?php

if ( ! function_exists( 'makao_core_add_vertical_sliding_header_meta' ) ) {
	function makao_core_add_vertical_sliding_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_sliding_header_section',
				'title'      => esc_html__( 'Vertical Sliding Header', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'vertical-sliding',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_sliding_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'makao-core' ),
				'description' => esc_html__( 'Enter header background color', 'makao-core' )
			)
		);
	}

	add_action( 'makao_core_action_after_page_header_meta_map', 'makao_core_add_vertical_sliding_header_meta' );
}

if ( ! function_exists( 'makao_core_add_vertical_sliding_header_logo_meta_options' ) ) {
	function makao_core_add_vertical_sliding_header_logo_meta_options( $page, $header_tab ) {

		if ( $header_tab ) {
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_vertical_sliding',
					'title'       => esc_html__( 'Logo - Vertical Sliding', 'makao-core' ),
					'description' => esc_html__( 'Choose vertical sliding area logo image', 'makao-core' ),
					'multiple'    => 'no'
				)
			);
		}
	}

	add_action( 'makao_core_action_after_page_logo_meta_map', 'makao_core_add_vertical_sliding_header_logo_meta_options', 10, 2 );
}