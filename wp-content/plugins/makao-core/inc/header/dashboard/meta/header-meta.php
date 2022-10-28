<?php

if ( ! function_exists( 'makao_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'makao-core' ),
					'description' => esc_html__( 'Header layout settings', 'makao-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'makao-core' ),
					'description' => esc_html__( 'Choose a header layout to set for your website', 'makao-core' ),
					'args'        => array( 'images' => true ),
					'options'     => makao_core_header_radio_to_select_options( apply_filters( 'makao_core_filter_header_layout_option', $header_layout_options = array() ) )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'makao-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'makao-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'makao-core' ),
						'none'  => esc_html__( 'None', 'makao-core' ),
						'light' => esc_html__( 'Light', 'makao-core' ),
						'dark'  => esc_html__( 'Dark', 'makao-core' )
					)
				)
			);

            $header_tab->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_header_in_grid',
                    'title'       => esc_html__( 'Header in grid', 'makao-core' ),
                    'description' => esc_html__( 'Choose this to display header in grid', 'makao-core' ),
                    'options'     => makao_core_get_select_type_options_pool( 'no_yes', true ),
                    'dependency'  => array(
                        'show'    => array(
                            'qodef_header_layout' => array(
                                'values'        => 'centered',
                                'default_value' => 'default'
                            )
                        )
                    )
                )
            );

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'makao-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'makao-core' ),
					'default_value' => 'yes'
				)
			);

			$custom_sidebars = makao_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes'
								)
							)
						)
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'makao-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'makao-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'makao-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'makao-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				// Hook to include additional options after module options
				do_action( 'makao_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'makao_core_action_after_general_meta_box_map', 'makao_core_add_page_header_meta_box' );
	add_action( 'makao_core_action_after_portfolio_meta_box_map', 'makao_core_add_page_header_meta_box' );
}