<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_images_big' ) ) {
	function makao_core_add_portfolio_single_variation_images_big( $variations ) {
		$variations['images-big'] = esc_html__( 'Images - Big', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_images_big' );
}

if ( ! function_exists( 'makao_core_set_default_portfolio_single_variation_compact' ) ) {
	function makao_core_set_default_portfolio_single_variation_compact() {
		return 'images-big';
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_default_value', 'makao_core_set_default_portfolio_single_variation_compact' );
}