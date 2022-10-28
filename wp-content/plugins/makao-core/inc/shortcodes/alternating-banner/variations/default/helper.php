<?php

if ( ! function_exists( 'makao_core_add_alternating_banner_variation_default' ) ) {
	function makao_core_add_alternating_banner_variation_default( $variations ) {
		
		$variations['default'] = esc_html__( 'Default', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_alternating_banner_layouts', 'makao_core_add_alternating_banner_variation_default' );
}
