<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_custom' ) ) {
	function makao_core_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_custom' );
}