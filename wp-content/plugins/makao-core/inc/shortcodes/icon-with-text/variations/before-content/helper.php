<?php

if ( ! function_exists( 'makao_core_add_icon_with_text_variation_before_content' ) ) {
	function makao_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_icon_with_text_layouts', 'makao_core_add_icon_with_text_variation_before_content' );
}
