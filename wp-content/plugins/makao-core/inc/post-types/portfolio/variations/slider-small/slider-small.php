<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_slider_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function makao_core_add_portfolio_single_variation_slider_small( $variations ) {
		$variations['slider-small'] = esc_html__( 'Slider - Small', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_slider_small' );
}