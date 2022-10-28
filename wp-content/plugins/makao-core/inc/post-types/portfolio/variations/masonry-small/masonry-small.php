<?php

if ( ! function_exists( 'makao_core_add_portfolio_single_variation_masonry_small' ) ) {
	function makao_core_add_portfolio_single_variation_masonry_small( $variations ) {
		$variations['masonry-small'] = esc_html__( 'Masonry - Small', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_portfolio_single_layout_options', 'makao_core_add_portfolio_single_variation_masonry_small' );
}

if ( ! function_exists( 'makao_core_include_masonry_for_portfolio_single_variation_masonry_small' ) ) {
	function makao_core_include_masonry_for_portfolio_single_variation_masonry_small( $post_type ) {
		$portfolio_template = makao_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		
		if ( $portfolio_template === 'masonry-small' ) {
			$post_type = 'portfolio-item';
		}
		
		return $post_type;
	}
	
	add_filter( 'makao_filter_allowed_post_type_to_enqueue_masonry_scripts', 'makao_core_include_masonry_for_portfolio_single_variation_masonry_small' );
}