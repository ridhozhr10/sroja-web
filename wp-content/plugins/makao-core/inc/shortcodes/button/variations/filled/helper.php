<?php

if ( ! function_exists( 'makao_core_add_button_variation_filled' ) ) {
	function makao_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_button_layouts', 'makao_core_add_button_variation_filled' );
}
