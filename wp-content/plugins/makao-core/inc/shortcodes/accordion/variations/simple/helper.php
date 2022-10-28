<?php

if ( ! function_exists( 'makao_core_add_accordion_variation_simple' ) ) {
	function makao_core_add_accordion_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_accordion_layouts', 'makao_core_add_accordion_variation_simple' );
}
