<?php

if ( ! function_exists( 'makao_core_add_blog_list_variation_metro' ) ) {
	function makao_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_blog_list_layouts', 'makao_core_add_blog_list_variation_metro' );
}