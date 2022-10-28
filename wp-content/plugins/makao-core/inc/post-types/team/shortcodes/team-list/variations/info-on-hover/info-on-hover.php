<?php

if ( ! function_exists( 'makao_core_add_team_list_variation_info_on_hover' ) ) {
	function makao_core_add_team_list_variation_info_on_hover( $variations ) {
		
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_team_list_layouts', 'makao_core_add_team_list_variation_info_on_hover' );
}