<?php

if ( ! function_exists( 'makao_core_add_blog_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_blog_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'blog',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Blog', 'makao-core' ),
				'description' => esc_html__( 'Global Blog Options', 'makao-core' ),
				'layout'      => 'tabbed'
			)
		);
		
		if ( $page ) {
			$custom_sidebars = makao_core_get_custom_sidebars();
			
			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog List', 'makao-core' ),
					'description' => esc_html__( 'Settings related to blog list', 'makao-core' )
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_blog_list_excerpt_number_of_characters',
					'title'       => esc_html__( 'Number of Characters in Excerpt', 'makao-core' ),
					'description' => esc_html__( 'Fill a number of characters in excerpt for post summary. Default value is 180', 'makao-core' ),
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'makao-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for blog archive', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'sidebar_layouts' ),
					'default_value' => ''
				)
			);
			
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_blog_archive_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'makao-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on blog archive', 'makao-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_archive_grid_gutter',
					'title'         => esc_html__( 'Set Grid Gutter', 'makao-core' ),
					'description'   => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog archive', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => ''
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_blog_list_options_map', $list_tab );
			
			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog Single', 'makao-core' ),
					'description' => esc_html__( 'Settings related to blog single', 'makao-core' )
				)
			);

			// Hook to include additional options first in single blog options
			do_action( 'makao_core_action_first_blog_single_options_map', $single_tab );
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'makao-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on blog single', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_set_post_title_in_title_area',
					'title'         => esc_html__( 'Show Post Title in Title Area', 'makao-core' ),
					'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'hide' => array(
							'qodef_blog_single_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'makao-core' ),
					'description' => esc_html__( 'Choose default sidebar layout for blog single', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'sidebar_layouts' )
				)
			);
			
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$single_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_blog_single_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'makao-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on blog single', 'makao-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'makao-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog single', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_blog_single_options_map', $single_tab );
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_blog_options_map', $page );
		}
	}
	
	add_action( 'makao_core_action_default_options_init', 'makao_core_add_blog_options', makao_core_get_admin_options_map_position( 'blog' ) );
}