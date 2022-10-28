<?php

if ( ! function_exists( 'makao_core_filter_portfolio_list_info_on_hover_fade_in' ) ) {
	function makao_core_filter_portfolio_list_info_on_hover_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_list_info_on_hover_animation_options', 'makao_core_filter_portfolio_list_info_on_hover_fade_in' );
}