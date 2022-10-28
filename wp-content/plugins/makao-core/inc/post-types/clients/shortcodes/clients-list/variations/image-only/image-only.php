<?php

if ( ! function_exists( 'makao_core_add_clients_list_variation_image_only' ) ) {
	function makao_core_add_clients_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_clients_list_layouts', 'makao_core_add_clients_list_variation_image_only' );
}