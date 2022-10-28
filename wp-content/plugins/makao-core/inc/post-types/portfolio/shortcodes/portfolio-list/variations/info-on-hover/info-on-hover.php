<?php

if ( ! function_exists( 'makao_core_add_portfolio_list_variation_info_on_hover' ) ) {
	function makao_core_add_portfolio_list_variation_info_on_hover( $variations ) {
		
		$variations['info-on-hover'] = esc_html__( 'Info On Hover', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_list_layouts', 'makao_core_add_portfolio_list_variation_info_on_hover' );
}