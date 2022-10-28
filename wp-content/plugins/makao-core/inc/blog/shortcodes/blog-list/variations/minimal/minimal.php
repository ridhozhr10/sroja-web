<?php

if ( ! function_exists( 'makao_core_add_blog_list_variation_minimal' ) ) {
	function makao_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_blog_list_layouts', 'makao_core_add_blog_list_variation_minimal' );
}