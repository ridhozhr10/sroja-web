<?php

if ( ! function_exists( 'makao_core_add_portfolio_list_variation_info_bottom_left' ) ) {
	function makao_core_add_portfolio_list_variation_info_bottom_left( $variations ) {
		
		$variations['info-bottom-left'] = esc_html__( 'Info Bottom Left', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_list_layouts', 'makao_core_add_portfolio_list_variation_info_bottom_left' );
}