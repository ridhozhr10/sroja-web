<?php

if ( ! function_exists( 'makao_core_fullscreen_menu_options' ) ) {
	function makao_core_fullscreen_menu_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fullscreen-menu',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Fullscreen Menu', 'makao-core' ),
				'description' => esc_html__( 'Global Fullscreen Menu Options', 'makao-core' )
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_fullscreen_menu_in_grid',
					'title'         => esc_html__( 'Fullscreen Menu in Grid', 'makao-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_fullscreen_menu_icon_source',
					'title'         => esc_html__( 'Icon Source', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'icon_source', false ),
					'default_value' => 'icon_pack'
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_fullscreen_menu_icon_pack',
					'title'         => esc_html__( 'Icon Pack', 'makao-core' ),
					'options'       => qode_framework_icons()->get_icon_packs( array( 'linea-icons', 'dripicons', 'simple-line-icons' ) ),
					'default_value' => 'elegant-icons',
					'dependency'    => array(
						'show' => array(
							'qodef_fullscreen_menu_icon_source' => array(
								'values'        => 'icon_pack',
								'default_value' => 'icon_pack'
							)
						)
					)
				)
			);

            $page->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_fullscreen_menu_background_image',
                    'title'       => esc_html__( 'Fullscreen Menu Background Image', 'makao-core' ),
                    'description' => esc_html__( 'Set background image for Fullscreen Menu', 'makao-core' )
                )
            );
			
			$section_svg_path = $page->add_section_element(
				array(
					'title'      => esc_html__( 'SVG Path', 'makao-core' ),
					'name'       => 'qodef_fullscreen_menu_svg_path_section',
					'dependency' => array(
						'show' => array(
							'qodef_fullscreen_menu_icon_source' => array(
								'values'        => 'svg_path',
								'default_value' => 'icon_pack'
							)
						)
					)
				)
			);
			
			$section_svg_path->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_fullscreen_menu_icon_svg_path',
					'title'       => esc_html__( 'Fullscreen Menu Open Icon SVG Path', 'makao-core' ),
					'description' => esc_html__( 'Enter your full screen menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'makao-core' )
				)
			);
			
			$section_svg_path->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_fullscreen_menu_close_icon_svg_path',
					'title'       => esc_html__( 'Fullscreen Menu Close Icon SVG Path', 'makao-core' ),
					'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'makao-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_fullscreen_menu_options_map', $page );
		}
	}
	
	add_action( 'makao_core_action_default_options_init', 'makao_core_fullscreen_menu_options', makao_core_get_admin_options_map_position( 'fullscreen-menu' ) );
}