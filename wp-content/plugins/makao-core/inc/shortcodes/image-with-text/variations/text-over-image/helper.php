<?php

if ( ! function_exists( 'makao_core_add_image_with_text_variation_text_over_image' ) ) {
	function makao_core_add_image_with_text_variation_text_over_image( $variations ) {
		
		$variations['text-over-image'] = esc_html__( 'Text Over Image', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_image_with_text_layouts', 'makao_core_add_image_with_text_variation_text_over_image' );
}
