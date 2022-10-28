<?php

if ( ! function_exists( 'makao_core_add_team_title_options' ) ) {
	/**
	 * Function that add title options for team module
	 */
	function makao_core_add_team_title_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_team_title',
					'title'         => esc_html__( 'Enable Title on Team Single', 'makao-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable team single title', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'yes_no' )
				)
			);
			
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_team_title_area_in_grid',
					'title'         => esc_html__( 'Team Title in Grid', 'makao-core' ),
					'description'   => esc_html__( 'Enabling this option will set team title area to be in grid', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'makao_core_action_after_team_options_single', 'makao_core_add_team_title_options' );
}