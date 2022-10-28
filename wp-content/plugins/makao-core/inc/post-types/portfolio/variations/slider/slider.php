<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_slider' ) ) {
	function makao_core_add_portfolio_single_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_slider' );
}

if ( ! function_exists( 'makao_core_add_portfolio_single_slider' ) ) {
	function makao_core_add_portfolio_single_slider() {
		if ( makao_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' ) == 'slider' ) {
			makao_core_template_part( 'post-types/portfolio', 'variations/slider/layout/parts/slider' );
		}
	}
	
	add_action( 'makao_action_inside_portfolio', 'makao_core_add_portfolio_single_slider' );
}