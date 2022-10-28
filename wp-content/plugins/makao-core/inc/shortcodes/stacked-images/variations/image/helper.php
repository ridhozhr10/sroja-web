<?php

if ( ! function_exists( 'makao_core_add_stacked_images_variation_image' ) ) {
	function makao_core_add_stacked_images_variation_image( $variations ) {
		$variations['image'] = esc_html__( 'Image', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_stacked_images_layouts', 'makao_core_add_stacked_images_variation_image' );
}
