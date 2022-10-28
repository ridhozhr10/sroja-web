<?php

if ( ! function_exists( 'makao_core_add_team_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_team_options() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = makao_core_team_has_single();

		if ( $has_single ) {

			$page = $qode_framework->add_options_page( array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'team',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Team', 'makao-core' ),
				'description' => esc_html__( 'Global Team Options', 'makao-core' )
			) );

			if ( $page ) {
				$archive_tab = $page->add_tab_element( array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Archive Settings', 'makao-core' ),
					'description' => esc_html__( 'Settings related to team archive pages', 'makao-core' )
				) );

				do_action( 'makao_core_action_after_team_options_archive', $archive_tab );

				$single_tab = $page->add_tab_element( array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Single Settings', 'makao-core' ),
					'description' => esc_html__( 'Settings related to team single pages', 'makao-core' )
				) );

				$single_tab->add_field_element( array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_layout',
					'title'       => esc_html__( 'Single Layout', 'makao-core' ),
					'description' => esc_html__( 'Choose default layout for team single', 'makao-core' ),
					'options'     => array(
						'' => esc_html__( 'Default', 'makao-core' )
					)
				) );

				do_action( 'makao_core_action_after_team_options_single', $single_tab );

				// Hook to include additional options after module options
				do_action( 'makao_core_action_after_team_options_map', $page );
			}
		}
	}

	add_action( 'makao_core_action_default_options_init', 'makao_core_add_team_options', makao_core_get_admin_options_map_position( 'team' ) );
}