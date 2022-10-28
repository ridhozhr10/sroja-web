<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_gallery_small' ) ) {
	function makao_core_add_portfolio_single_variation_gallery_small( $variations ) {
		$variations['gallery-small'] = esc_html__( 'Gallery - Small', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_gallery_small' );
}