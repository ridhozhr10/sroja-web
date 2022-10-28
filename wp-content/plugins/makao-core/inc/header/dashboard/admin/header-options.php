<?php

if ( ! function_exists( 'makao_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function makao_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'makao-core' ),
				'description' => esc_html__( 'Global Header Options', 'makao-core' )
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'makao-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'makao-core' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'makao-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'makao_core_filter_header_layout_option', $header_layout_options = array() ),
					'default_value' => apply_filters( 'makao_core_filter_header_layout_default_option_value', '' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'makao-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'makao-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'makao-core' ),
						'light' => esc_html__( 'Light', 'makao-core' ),
						'dark'  => esc_html__( 'Dark', 'makao-core' )
					)
				)
			);

            $general_tab->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_header_in_grid',
                    'title'       => esc_html__( 'Header in grid', 'makao-core' ),
                    'description' => esc_html__( 'Choose this to display header in grid', 'makao-core' ),
                    'options'       => makao_core_get_select_type_options_pool( 'no_yes', false ),
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


			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'makao_core_action_default_options_init', 'makao_core_add_header_options', makao_core_get_admin_options_map_position( 'header' ) );
}