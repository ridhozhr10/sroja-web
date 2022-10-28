<?php

if ( ! function_exists( 'makao_core_filter_portfolio_list_info_below_zoom_out' ) ) {
	function makao_core_filter_portfolio_list_info_below_zoom_out( $variations ) {
		$variations['zoom-out'] = esc_html__( 'Zoom Out', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_list_info_below_animation_options', 'makao_core_filter_portfolio_list_info_below_zoom_out' );
}