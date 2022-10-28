<?php

if ( ! function_exists( 'makao_core_add_page_sidebar_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_page_sidebar_meta_box( $page ) {
		
		if ( $page ) {
			
			$sidebar_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-sidebar',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Sidebar Settings', 'makao-core' ),
					'description' => esc_html__( 'Sidebar layout settings', 'makao-core' )
				)
			);
			
			$sidebar_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'makao-core' ),
					'description'   => esc_html__( 'Choose a sidebar layout', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'sidebar_layouts' )
				)
			);
			
			$custom_sidebars = makao_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$sidebar_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'makao-core' ),
						'description' => esc_html__( 'Choose a custom sidebar', 'makao-core' ),
						'options'     => $custom_sidebars
					)
				);
			}
			
			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'makao-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_page_sidebar_meta_box_map', $sidebar_tab );
		}
	}
	
	add_action( 'makao_core_action_after_general_meta_box_map', 'makao_core_add_page_sidebar_meta_box' );
}