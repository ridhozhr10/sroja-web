<?php

if ( ! function_exists( 'makao_core_add_portfolio_list_variation_info_follow' ) ) {
	function makao_core_add_portfolio_list_variation_info_follow( $variations ) {
		
		$variations['info-follow'] = esc_html__( 'Info Follow', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_list_layouts', 'makao_core_add_portfolio_list_variation_info_follow' );
}