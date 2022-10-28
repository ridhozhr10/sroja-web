<?php

if ( ! function_exists( 'makao_core_add_sticky_header_options' ) ) {
	function makao_core_add_sticky_header_options( $page, $section ) {
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'makao-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'makao-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_side_padding',
				'title'       => esc_html__( 'Sticky Header Side Padding', 'makao-core' ),
				'description' => esc_html__( 'Enter side padding for sticky header area', 'makao-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'makao-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_sticky_header_background_color',
				'title'       => esc_html__( 'Sticky Header Background Color', 'makao-core' ),
				'description' => esc_html__( 'Enter sticky header background color', 'makao-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
	}
	
	add_action( 'makao_core_action_after_header_scroll_appearance_options_map', 'makao_core_add_sticky_header_options', 10, 2 );
}

if ( ! function_exists( 'makao_core_add_sticky_header_logo_options' ) ) {
	function makao_core_add_sticky_header_logo_options( $page, $header_tab ) {
		
		if ( $header_tab ) {
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'makao-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'makao-core' ),
					'multiple'    => 'no'
				)
			);
		}
	}
	
	add_action( 'makao_core_action_after_header_logo_options_map', 'makao_core_add_sticky_header_logo_options', 10, 2 );
}