<?php
if ( ! function_exists( 'makao_core_filter_clients_list_image_only_fade_in' ) ) {
	function makao_core_filter_clients_list_image_only_fade_in( $variations ) {
		
		$variations['fade-in'] = esc_html__( 'Fade In', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_clients_list_image_only_animation_options', 'makao_core_filter_clients_list_image_only_fade_in' );
}