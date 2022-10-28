<?php

if ( ! function_exists( 'makao_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'makao-core' ),
				'description' => esc_html__( 'General page layout settings', 'makao-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'makao-core' ),
				'description' => esc_html__( 'Set background color', 'makao-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'makao-core' ),
				'description' => esc_html__( 'Set background image', 'makao-core' )
			)
		);

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'makao-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'makao-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'makao-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (768px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'makao-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'makao-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'makao-core' ),
				'default_value' => '',
				'options'       => makao_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$boxed_section = $general_tab->add_section_element(
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
                    ''       => esc_html__( 'Default', 'makao-core' ),
                    'fixed'  => esc_html__( 'Fixed', 'makao-core' ),
                    'scroll' => esc_html__( 'Scroll', 'makao-core' )
                ),
            )
        );

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'makao-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'makao-core' ),
				'default_value' => '',
				'options'       => makao_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
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

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'makao-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'makao-core' ),
				'options'     => makao_core_get_select_type_options_pool( 'content_width' )
			)
		);

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_content_behind_header',
			'title'         => esc_html__( 'Always put content behind header', 'makao-core' ),
			'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'makao-core' ),
		) );

		// Hook to include additional options after module options
		do_action( 'makao_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'makao_core_action_after_general_meta_box_map', 'makao_core_add_general_page_meta_box', 9 );
	add_action( 'makao_core_action_after_portfolio_meta_box_map', 'makao_core_add_general_page_meta_box' );
}