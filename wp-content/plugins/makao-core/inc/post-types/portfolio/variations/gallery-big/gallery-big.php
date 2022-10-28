<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_gallery_big' ) ) {
	function makao_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_gallery_big' );
}