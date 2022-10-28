<?php

if ( ! function_exists( 'makao_core_add_stacked_images_variation_box_with_text' ) ) {
	function makao_core_add_stacked_images_variation_box_with_text( $variations ) {
		$variations['box-with-text'] = esc_html__( 'Box with Text', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_stacked_images_layouts', 'makao_core_add_stacked_images_variation_box_with_text' );
}
