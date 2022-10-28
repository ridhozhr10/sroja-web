<?php

if ( ! function_exists( 'makao_core_add_text_marquee_variation_default' ) ) {
	function makao_core_add_text_marquee_variation_default( $variations ) {
		
		$variations['default'] = esc_html__( 'Default', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_text_marquee_layouts', 'makao_core_add_text_marquee_variation_default' );
}