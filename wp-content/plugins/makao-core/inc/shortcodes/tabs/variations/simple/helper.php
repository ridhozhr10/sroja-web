<?php

if ( ! function_exists( 'makao_core_add_tabs_variation_simple' ) ) {
	function makao_core_add_tabs_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_tabs_layouts', 'makao_core_add_tabs_variation_simple' );
}
