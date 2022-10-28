<?php

if ( ! function_exists( 'makao_core_add_image_with_text_variation_text_below' ) ) {
	function makao_core_add_image_with_text_variation_text_below( $variations ) {
		
		$variations['text-below'] = esc_html__( 'Text Below', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_image_with_text_layouts', 'makao_core_add_image_with_text_variation_text_below' );
}
