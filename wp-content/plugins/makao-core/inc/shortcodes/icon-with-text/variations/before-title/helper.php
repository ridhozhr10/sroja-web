<?php

if ( ! function_exists( 'makao_core_add_icon_with_text_variation_before_title' ) ) {
	function makao_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_icon_with_text_layouts', 'makao_core_add_icon_with_text_variation_before_title' );
}
